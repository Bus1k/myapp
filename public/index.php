<?php

use Core\Router;


error_reporting(-1);
ini_set('display_errors', 'On');

//TWIG
require_once dirname(__DIR__) . '/vendor/autoload.php';

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
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

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