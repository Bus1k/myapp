<?php

namespace App\Controllers;


use Core\Controller;
use Core\View;

class Test extends Authenticated
{
    public function indexAction()
    {
        View::renderTemplate('Test/Test.html');
    }
}