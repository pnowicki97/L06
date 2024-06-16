<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/ExpanseRepository.php';
require_once __DIR__ . '/../repository/GroupRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';


class DesktopGroupPageController extends AppController { 

    public function __construct()
    {
        parent::__construct();
        $this->expanseRepository = new ExpanseRepository();
        $this->groupRepository = new GroupRepository();
        $this->userRepository = new UserRepository();
        session_start();
    }

    public function desktopGroupPage() {
    $id = array_keys($_POST)[0];

        return $this->render('desktop-group-page', [
            "title"=> "Groups | WDPAI", 
            "group" => $this->groupRepository->getGroupById($id),
            "items" => $this->expanseRepository->getExpansesByGroup($id)
        ]);
    }

    public function desktopAddExpanse() {
    $id = array_keys($_POST)[0];
            return $this->render('desktop-add-expanse', [
                "title"=> "Add Expanse | WDPAI",
                "group" => $this->groupRepository->getGroupById($id),
                "items" => $this->userRepository->getUsersByGroup($id)

            ]);
        }


    public function addExpanse() {

        $id = $_POST["groupId"];
        if($this->isPost()) {

            $this->expanseRepository->saveExpanse($_POST);

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/desktopUserPage");
            return;

            return $this->render('desktop-group-page', [
                "title"=> "Groups | WDPAI", 
                "group" => $this->groupRepository->getGroupById($id),
                "items" => $this->expanseRepository->getExpansesByGroup($id)
            ]);
        }
    }
}