<?php

namespace PhpCoderwall\Entity;

class CoderwallTeam extends CoderwallEntity {

    public $name;
    public $id;
    public $score;
    public $rank;
    public $size;
    public $slug;
    public $avatar;
    public $country;
    public $neighbors = array();
    public $teamMembers = array();

    public function __construct($name, $id) 
    {
        $this->name = $name;
        $this->id = $id;
    }

    public static function fromJSON($obj) {
        $class = __CLASS__;
        $team = new $class($obj->name, $obj->id);

        $team->score  = $obj->score;
        $team->rank   = $obj->rank;
        $team->size   = $obj->size;
        $team->slug   = $obj->slug;
        $team->avatar = $obj->avatar;
        $team->country = $obj->country;

        if (isset($obj->team_members))
        {
            foreach ($obj->team_members as $m) 
            {
                $member = new CoderwallUser($m->username);
                $member->name = $m->name;
                $member->badgesCount = $m->badges_count;
                $member->endorsements = $m->endorsements_count;
                $member->team = $team;
                $team->teamMembers[] = $member;
            }
        }

        if (isset($obj->neighbors))
        {
            foreach ($obj->neighbors as $n) 
            {
                $team->neighbors[] = self::fromJSON($n);
            }
        }

        return $team;
    }
}