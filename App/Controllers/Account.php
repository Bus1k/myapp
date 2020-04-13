<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;

class Account extends Controller
{

    public function validateEmailAction()
    {
        $is_valid = ! User::emailExist($_GET['email']);

        header('Content-Type: application/json');
        echo json_encode($is_valid);
    }
}