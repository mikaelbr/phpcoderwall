<?php

namespace PhpCoderwall\Entity;

class CoderwallUser extends CoderwallEntity {

    public $username;
    public $name;
    public $location;
    public $endorsements;
    public $team;
    public $accounts = array();
    public $badges = array();
    public $badgesCount;

    public function __construct($username) 
    {
        $this->username = $username;
    }

    public static function fromJSON($obj) {
        $class = __CLASS__;
        $user = new $class($obj->username);

        $user->name = $obj->name;
        $user->location = $obj->location;
        $user->endorsements = $obj->endorsements;
        $user->team = $obj->team;

        foreach (get_object_vars($obj->accounts) as $k => $v)
        {
            $user->accounts[] = new Account($k, $v);
        }

        foreach ($obj->badges as $v) {
            $user->badges[] = CoderwallBadge::fromJSON($v);
        }

        $user->badgesCount = count($user->badges);

        
        return $user;
    }

}