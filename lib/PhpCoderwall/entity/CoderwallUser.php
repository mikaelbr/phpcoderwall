<?php

namespace PhpCoderwall\Entity;

class CoderwallUser extends CoderwallEntity {

    public $username;
    public $name;
    public $location;
    public $endorsements;
    public $team;
    public $badgesCount;

    public $accounts = array();
    public $badges = array();

    // Full information
    public $title;
    public $company;
    public $thumbnail;

    public $specialities = array();
    public $accomplishments = array();

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


        // Check for full version..
        if (isset($obj->title))
        {
            $user->title = $obj->title;
            $user->company = $obj->company;
            $user->thumbnail = $obj->thumbnail;
            $user->specialities = $obj->specialities;
            $user->accomplishments = $obj->accomplishments;
        }
        
        return $user;
    }

}