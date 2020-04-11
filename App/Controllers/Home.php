<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Home extends Controller
{
    public function indexAction()
    {
        echo 'Home Controller - index';

        View::renderTemplate('Home/index.php',[
            'name' => 'Busik',
            'colors' => ['red', 'green', 'blue']
        ]);
    }

    protected function before()
    {
        echo '(BEFORE FILTER)<br>';
    }

    protected function after()
    {
        echo '<br>(AFTER FILTER)';
    }
}