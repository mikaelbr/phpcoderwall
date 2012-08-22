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


    public function get($username)
    {
        if (empty($username) || !isset($username))
        {
            throw new \Exception("Illegal argument passed. Username is not set.")
        }

        $contents = json_decode(Utils\WebRequestor::get(self::SERVICE_BASE_URL . $username . ".json"));

        
    }
}
