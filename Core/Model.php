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
            $db = new PDO('mysql:host=' . Config::DB_HOST .';dbname=' . Config::DB_NAME . ';charset=' . Config::DB_CHARSET .'', Config::DB_USER, Config::DB_PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $db;
    }
}