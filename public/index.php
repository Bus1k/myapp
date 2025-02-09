<?php

use Core\Router;


require_once dirname(__DIR__) . '/vendor/autoload.php';

//Errors and Exceptions
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

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