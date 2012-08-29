<?php

namespace PhpCoderwall;

class PhpCoderwall {

    const SERVICE_BASE_URL = "http://coderwall.com/";

    // Holds instance
    private static $_instance;

    private function __construct() 
    {

    }

    /**
     * Get new instance of this object.
     */
    public static function getInstance()
    {
        if (!isset(self::$_instance))
        {
            $class = __CLASS__;
            self::$_instance = new $class;
        }

        return self::$_instance;
    }

    /**
     * Prevents cloning
     * Cloning not allowed in a singelton patterned class
     */
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }


    public function getUser($username, $fullInfo = false)
    {
        if (empty($username) || !isset($username))
        {
            throw new \Exception("Illegal argument passed. Username is not set.");
        }

        $url = self::SERVICE_BASE_URL . $username . ".json";

        if ($fullInfo) 
        {
            $url .= "?full=true";
        }

        $contents = json_decode(Utils\WebRequestor::request($url));

        if ($fullInfo && !empty($contents->team)) 
        {
            $contents->team = $this->getTeamById($contents->team);
        }

        return Entity\CoderwallUser::fromJSON($contents);
    }

    public function getTeam($team)
    {
        if (empty($team) || !isset($team))
        {
            throw new \Exception("Illegal argument passed. Team name is not set.");
        }

        $contents = json_decode(Utils\WebRequestor::request(self::SERVICE_BASE_URL . "team/" . $team . ".json"));
        return Entity\CoderwallTeam::fromJSON($contents);
    }

    public function getTeamById($teamId)
    {
        if (empty($teamId) || !isset($teamId))
        {
            throw new \Exception("Illegal argument passed. Team ID is not set.");
        }

        $contents = json_decode(Utils\WebRequestor::request(self::SERVICE_BASE_URL . "teams/" . $teamId . ".json"));
        return Entity\CoderwallTeam::fromJSON($contents);
    }
}
