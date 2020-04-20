<?php

namespace App\Models;

use Core\Model;
use PDO;

class Bill extends Model
{
    public $shop;
    public $date;
    public $image;
    public $whoPay;
    public $cost;
    public $notes;

    public function __construct($data = [])
    {
        $this->shop = $data['shopName'];
        $this->date = $data['billDate'];
        $this->whoPay = $data['whoPay'];
        $this->cost = $data['billCost'];
        $this->notes = $data['billNotes'];
    }


    public function save()
    {
        $query = 'INSERT INTO bills (shop, date, who_pay, cost, notes) VALUES (:shop, :date, :who_pay, :cost, :notes)';

        $db = static::getDB();
        $stmt = $db->prepare($query);

        $stmt->bindValue(':shop', $this->shop, PDO::PARAM_STR);
        $stmt->bindValue(':date', $this->date, PDO::PARAM_STR);
        $stmt->bindValue(':who_pay', $this->whoPay, PDO::PARAM_STR);
        $stmt->bindValue(':cost', $this->cost, PDO::PARAM_STR);
        $stmt->bindValue(':notes', $this->notes, PDO::PARAM_STR);

        return $stmt->execute();
    }
}