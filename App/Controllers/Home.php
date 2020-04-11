<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Home extends Controller
{
    public function indexAction()
    {
        View::renderTemplate('Home/index.html',[
            'name' => 'Busik',
            'colors' => ['red', 'green', 'blue']
        ]);
    }
}