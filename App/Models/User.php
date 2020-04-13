<?php

namespace App\Models;

use Core\Model;
use PDO;

class User extends Model
{
    public $errors = [];

    public function __construct($data = [])
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
    }

    public function save()
    {
        $this->validate();

        if(empty($this->errors))
        {
            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (name, email, password_hash) VALUES (:name, :email, :password_hash)";

            $db = static::getDB();
            $stmt = $db->prepare($query);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

            return $stmt->execute();
        }
        return false;
    }

    public function validate()
    {
        //Name
        if($this->name == '')
        {
            $this->errors[] = 'Name is required';
        }

        //Email Adress
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL) === false)
        {
            $this->errors[] = 'Invalid email';
        }

        if(static::emailExist($this->email))
        {
            $this->errors[] = 'Email Address already taken';
        }

        //Password length
        if(strlen($this->password) < 6)
        {
            $this->errors[] = 'Please eneter at least 6 characters for the password';
        }

        //Password one number contain
        if(preg_match('/.*\d+.*/i', $this->password) == 0)
        {
            $this->errors[] = 'Password needs at least one number';
        }
    }

    public static function emailExist($email)
    {
        return static::findByEmail($email) !== false;
    }

    public static function findByEmail($email)
    {
        $query = 'SELECT * FROM users WHERE email = :email';

        $db = static::getDB();
        $stmt = $db->prepare($query);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();

        return $stmt->fetch();
    }

    public static function authenticate($email, $password)
    {
        $user = static::findByEmail($email);

        if($user)
        {
            if(password_verify($password, $user->password_hash))
            {
                return $user;
            }
        }
        return false;
    }

}