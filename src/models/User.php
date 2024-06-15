<?php

class User {

    public $name;
    public $password;
    public $photo_url;
    public $id;

    public function __construct() {
    }

    public function getName() : string {
        return $this->name;
    }

    public function getPassword() : string {
        return $this->password;
    }

    public function getPhotoUrl() : string {
        return $this->photo_url;
    }

    public function getId() : string {
        return $this->id;
    }
}