<?php

namespace App\Controllers;


use App\Models\Post;
use Core\Controller;
use Core\View;

class Posts extends Controller
{
    public function indexAction()
    {
        $posts = Post::getAll();

        View::renderTemplate('Posts/index.html',[
            'posts' => $posts
        ]);
    }

    public function addNewAction()
    {
        echo 'Post Controller - test addNew';
    }

    public function editAction()
    {
        echo 'Post Controller - test edit <br>';
        echo 'TEST PARAMS: <pre>'. htmlspecialchars(print_r($this->route_params, true)) . '</pre>';
    }
}