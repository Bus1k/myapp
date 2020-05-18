<?php

namespace App\Controllers;

use Core\FlashMessage;
use Core\View;
use App\Models\Bill;


class Bills extends Authenticated
{
    protected $bill;

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

    public function deleteAction()
    {
        $bill = new Bill();
        if($bill->delete($this->route_params['id']))
        {
            FlashMessage::addMessage('Bill successfully deleted', FlashMessage::INFO);
            $this->redirect('/bills/index');
        }

    }

    public function editAction()
    {
        $bill = (new Bill())->getBillById($this->route_params['id']);
        View::renderTemplate('Bills/edit.html',[
            'bill' => $bill
        ]);
    }

    public function updateAction()
    {

    }

}