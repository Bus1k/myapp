<?php

namespace App\Models;

use PDO;
use Core\Model;

class Post extends Model
{
    public static function getAll()
    {
        try
        {
            $db = static::getDB();

            $stmt = $db->query('SELECT id, title, content FROM posts');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        }
        catch(\PDOException $exception)
        {
            echo $exception->getMessage();
        }
    }
}