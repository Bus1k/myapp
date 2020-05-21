<?php

namespace App\Models;

use Core\Model;
use PDO;

class Shop extends Model
{
    public $name;

    public function __construct($data = [])
    {
        if(!empty($data))
        {
            $this->name = $data['shopName'];
        }
    }

    public function save()
    {
        $query = 'INSERT INTO shops (name) VALUES (:name)';

        $db = static::getDB();
        $stmt = $db->prepare($query);

        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function getAllShops()
    {
        $query = 'SELECT * FROM shops';

        $db = static::getDB();
        $stmt = $db->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function delete($id)
    {
        $query = 'DELETE FROM shops WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}