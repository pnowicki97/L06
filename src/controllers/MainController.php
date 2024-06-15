<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/GroupRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';


class MainController extends AppController { 

    public function __construct()
    {
        parent::__construct();
        $this->groupRepository = new GroupRepository();
        $this->userRepository = new UserRepository();
    }

    public function main() {

        if($this->isGet()) {
            return $this->render('main', [
                "title"=> "LOGIN | WDPAI",
                "message"=>""
            ]);
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        if(!empty($_POST["login"])):
            foreach($this->userRepository->getUsers() as $user):
                if($user->getName() == $username):
                    if($user->getPassword() == $password):
                        session_start();
                        $_SESSION["user_id"] = $user->getId();

                        $url = "http://$_SERVER[HTTP_HOST]";
                        header("Location: {$url}/desktopUserPage");
                        return;
                    endif;
                endif;
            endforeach;    
            return $this->render('main', [
                "title"=> "LOGIN | WDPAI",
                "message"=>"Nie można się zalogować"
            ]);
        endif;
        
        if(!empty($_POST["signup"])):

            $username = $_POST["username"];
            if(!empty($username)):
                foreach($this->userRepository->getUsers() as $user):
                    if($user->getName() == $username):
                        return $this->render('main', [
                            "title"=> "LOGIN | WDPAI",
                            "message"=>"Użytkownik o takiej nazwie istnieje"
                        ]);
                    endif;
                endforeach;    

                $this->userRepository->saveUser($_POST);

                return $this->render('main', [
                    "title"=> "LOGIN | WDPAI",
                    "message"=>"Konto utworzone"
                ]);
            endif;
            return $this->render('main', [
                "title"=> "LOGIN | WDPAI",
                "message"=>"Nie można utworzyć pustego użytkownika"
            ]);
        endif;
    }
}