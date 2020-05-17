<?php

namespace App\Models;

use Core\Model;
use PDO;

class Bill extends Model
{
    public $shop;
    public $description;
    public $billDate;

    public function __construct($data = [])
    {
        if(!empty($data))
        {
            $this->shop = $data['shopName'];
            $this->description = $data['description'];
            $this->billDate = $data['billDate'];
        }
    }

    public function save()
    {
        $query = 'INSERT INTO bills (shop, description, date) VALUES (:shop, :description, :billDate)';

        $db = static::getDB();
        $stmt = $db->prepare($query);

        $stmt->bindValue(':shop', $this->shop, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':billDate', $this->billDate, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function getAllBills()
    {
        $query = 'SELECT * FROM bills';

        $db = static::getDB();
        $stmt = $db->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();

        return $stmt->fetchAll();
    }
}