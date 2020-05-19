<?php

namespace App\Models;

use Core\Model;
use PDO;

class Bill extends Model
{
    public $shop;
    public $payer;
    public $description;
    public $price;
    public $date;

    public function __construct($data = [])
    {
        if(!empty($data))
        {
            $this->shop = $data['shopName'];
            $this->payer = $data['payer'];
            $this->description = $data['description'];
            $this->price = $data['price'];
            $this->date = $data['billDate'];
        }
    }

    public function save()
    {
        $query = 'INSERT INTO bills (shop, payer, description, price, date) VALUES (:shop, :payer, :description, :price, :billDate)';

        $db = static::getDB();
        $stmt = $db->prepare($query);

        $stmt->bindValue(':shop', $this->shop, PDO::PARAM_STR);
        $stmt->bindValue(':payer', $this->payer, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':price', $this->price, PDO::PARAM_STR);
        $stmt->bindValue(':billDate', $this->date, PDO::PARAM_STR);

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

    public function getBillById($id)
    {
        $query = 'SELECT * FROM bills WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();

        return $stmt->fetch();
    }

    public function delete($id)
    {
        $query = 'DELETE FROM bills WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($query);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function update($data, $id)
    {
        $this->shop = $data['shopName'];
        $this->payer = $data['payer'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        $this->date = $data['billDate'];

        $query = 'UPDATE bills SET shop = :shop, payer = :payer, description = :description, price = :price, date = :date WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($query);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':shop', $this->shop, PDO::PARAM_STR);
        $stmt->bindValue(':payer', $this->payer, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':price', $this->price, PDO::PARAM_STR);
        $stmt->bindValue(':date', $this->date, PDO::PARAM_STR);

        return $stmt->execute();
    }

}