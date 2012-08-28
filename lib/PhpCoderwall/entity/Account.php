<?php

namespace PhpCoderwall\Entity;

class Account {

    public $type;
    public $username;

    public function __construct($type, $username) 
    {
        $this->type = $type;
        $this->username = $username;
    }

}