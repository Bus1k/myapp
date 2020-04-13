<?php

namespace App\Controllers;


use App\Models\User;
use Core\Auth;
use Core\Controller;
use Core\View;


class Login extends Controller
{

    public function newAction()
    {
        View::renderTemplate('Login/new.html');
    }

    public function createAction()
    {
        $user = User::authenticate($_POST['email'], $_POST['password']);

        if($user)
        {
            Auth::login($user);

            $this->redirect('/');
        }
        else
        {
            View::renderTemplate('Login/new.html', [
                'email' => $_POST['email']
            ]);
        }
    }

    public function destroyAction()
    {
        Auth::logout();

        $this->redirect('/');
    }
}