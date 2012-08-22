<?php

namespace PhpCoderwall\Entity;

class CoderwallUser {

    private $username;
    private $badges = array();

    public function __constructor($username) 
    {
        $this->username = $username;
    }

    public static function fromJSON($obj) {
        $user = new __CLASS__($obj["username"]);
        
        echo "<pre>";
        var_dump($obj);
    }
}