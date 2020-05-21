<?php

namespace App\Controllers;

use App\Models\Shop;
use Core\FlashMessage;
use Core\View;


class Shops extends Authenticated
{
    protected $shop;

    public function before()
    {
        parent::before();
        $this->shop = new Shop();
    }

    public function indexAction()
    {
        View::renderTemplate('Shops/index.html',[
            'shops' => $this->shop->getAllShops()
        ]);
    }

    public function addAction()
    {
        View::renderTemplate('Shops/add.html');
    }

    public function saveAction()
    {
        $shop = new Shop($_POST);
        if($shop->save())
        {
            $this->redirect('/shops/index');
        }
    }

    public function deleteAction()
    {
        if($this->shop->delete($this->route_params['id']))
        {
            FlashMessage::addMessage('Shop successfully deleted', FlashMessage::INFO);
            $this->redirect('/shops/index');
        }
    }
}