<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/GroupRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';


class DesktopUserPageController extends AppController { 

    public function __construct()
    {
        parent::__construct();
        $this->groupRepository = new GroupRepository();
        $this->userRepository = new UserRepository();
        session_start();
    }

    public function desktopUserPage() {
        return $this->render('desktop-user-page', [
            "title"=> "User | WDPAI", 
            "items" => $this->groupRepository->getGroupsByUser($_SESSION["user_id"])
        ]);
    }

    public function desktopAddGroup() {
        return $this->render('desktop-add-group', [
            "title"=> "Add group | WDPAI",
            "items" => $this->userRepository->getUsers()

        ]);
    }

    public function addGroup() {

        if($this->isPost()) {

            $this->groupRepository->saveGroup($_POST);

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/desktopUserPage");
            return;
        }
    }
}