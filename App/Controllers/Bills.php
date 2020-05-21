<?php

namespace App\Controllers;

use App\Models\Shop;
use Core\Auth;
use Core\FlashMessage;
use Core\View;
use App\Models\Bill;


class Bills extends Authenticated
{
    protected $bill;
    protected $user;
    protected $shop;

    public function before()
    {
        parent::before();
        $this->bill = new Bill();
        $this->user = Auth::getUser();
        $this->shop = new Shop();
    }

    public function indexAction()
    {
        View::renderTemplate('Bills/index.html',[
            'bills' => $this->bill->getAllBills(),
            'summary' => $this->bill->getSummary()
        ]);
    }

    public function addAction()
    {
        View::renderTemplate('Bills/add.html', [
            'user' => $this->user,
            'shops' => $this->shop->getAllShops()
        ]);
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
        if($this->bill->delete($this->route_params['id']))
        {
            FlashMessage::addMessage('Bill successfully deleted', FlashMessage::INFO);
            $this->redirect('/bills/index');
        }

    }

    public function editAction()
    {
        View::renderTemplate('Bills/edit.html',[
            'bill' => $this->bill->getBillById($this->route_params['id'])
        ]);
    }

    public function updateAction()
    {
        if($this->bill->update($_POST, $this->route_params['id']))
        {
            FlashMessage::addMessage('Bill successfully updated', FlashMessage::INFO);
            $this->redirect('/bills/index');
        }
    }

}