<?php

namespace App\Controllers;


use Core\Controller;
use Core\View;

class Posts extends Controller
{
    public function indexAction()
    {
        View::renderTemplate('Posts/index.html');
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