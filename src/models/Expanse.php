<?php

class Expanse {

    public $name;
    public $paid_by;
    public $amount;

    public function __construct() {
    }

    public function getName() : string {
        return $this->name;
    }

    public function getPaidBy() : string {
        return $this->paid_by;
    }

    public function getAmount() : string {
        return $this->amount;
    }
}