<?php

namespace Matrix\Database;

use Dotenv\Dotenv;

class DB
{
    protected static $instance = null;

    protected function __construct(){}

    public static function getInstance()
    {
        $env = Dotenv::create(ROOTDIR);
        $env->load();

        $provider = getenv('DB_CONNECTION');
        $host = getenv('DB_HOST');
        $dbname = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');

        if (is_null(self::$instance)) {
            self::$instance = new \PDO("{$provider}:host={$host};dbname={$dbname}", $user, $password);
        }
        
        return self::$instance;
    }

    public static function query($sql)
    {
        
        return self::getInstance()->query($sql);
    }

    private function __clone(){}


}