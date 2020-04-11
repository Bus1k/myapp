<?php

use Core\Router;

//AUTOLOADER
spl_autoload_register(function ($class)
{
    $root = dirname(__DIR__); //get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if(is_readable($file))
    {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});

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