<?php

namespace Core;

use PDO;
use App\Config\Config;


abstract class Model
{

    protected static function getDB()
    {
        static $db = null;

        if($db === null)
        {
            try
            {
                $db = new PDO('mysql:host=' . Config::DB_HOST .';dbname=' . Config::DB_NAME . ';charset=' . Config::DB_CHARSET .'', Config::DB_USER, Config::DB_PASSWORD);
            }
            catch(\PDOException $exception)
            {
                echo $exception->getMessage();
            }
        }
        return $db;
    }
}