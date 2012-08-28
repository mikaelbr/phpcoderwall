<?php

namespace PhpCoderwall\Entity;

class CoderwallBadge extends CoderwallEntity {

    public $name;
    public $description;
    public $created;
    public $badge;

    public function __construct($name, $description, $created, $badge) 
    {
        $this->name = $name;
        $this->description = $description;
        $this->created = $created;
        $this->badge = $badge;
    }

    public static function fromJSON($obj) {
        $class = __CLASS__;
        return new $class($obj->name, $obj->description, $obj->created, $obj->badge);
    }
}