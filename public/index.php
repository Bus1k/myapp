<?php

require '../App/Controllers/Posts.php';
require '../Core/Router.php';

$router = new Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

//echo '<pre>';
//var_dump($router->getRoutes());
//echo '<pre>';

$url = $_SERVER['QUERY_STRING'];

//if($router->match($url))
//{
//    echo '<pre>';
//    var_dump($router->getParams());
//    echo '<pre>';
//}
//else
//{
//    echo 'No found route URL: '.$url;
//}

$router->dispatch($url);