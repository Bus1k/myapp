<?php

namespace App\Controllers;

use Core\View;
use App\Models\Bill;


class Bills extends Authenticated
{
    public function indexAction()
    {
        $bills = (new Bill())->getAllBills();
        View::renderTemplate('Bills/index.html',[
            'bills' => $bills
        ]);
    }

    public function addAction()
    {
        View::renderTemplate('Bills/add.html');
    }

    public function saveAction()
    {
        $bill = new Bill($_POST);

        if($bill->save())
        {
            $this->redirect('/bills/index');
        }
    }

}