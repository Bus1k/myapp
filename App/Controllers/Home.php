<?php

namespace App\Controllers;

use Core\Controller;

class Home extends Controller
{
    public function indexAction()
    {
        echo 'Home Controller - index';
    }

    protected function before()
    {
        echo '(BEFORE FILTER)<br>';
        return false;
    }

    protected function after()
    {
        echo '<br>(AFTER FILTER)';
    }
}