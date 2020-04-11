<?php

namespace App\Controllers;


use Core\Controller;

class Posts extends Controller
{
    public function indexAction()
    {
        echo 'Post Controller - test index <br>';
        echo 'TEST PARAMS: <pre>'. htmlspecialchars(print_r($_GET, true)) . '</pre>';
    }

    public function addNewAction()
    {
        echo 'Post Controller - test addNew';
    }

    public function editAction()
    {
        echo 'Post Controller - test edit <br>';
        echo 'TEST PARAMS: <pre>'. htmlspecialchars(print_r($this->route_params, true)) . '</pre>';
    }
}