<?php

namespace App\Controllers;


use App\Models\Bill;
use Core\View;

class Bills extends Authenticated
{
    public function showAction()
    {
        View::renderTemplate('Bills/show.html');
    }

    public function addAction()
    {
        View::renderTemplate('Bills/add.html');
    }

    public function saveAction()
    {
        var_dump($_FILES);
        die();
        $bill = new Bill($_POST);
        if($bill->save())
        {
            $this->redirect('/bills/show');
        }
    }
}