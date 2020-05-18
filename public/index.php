<?php

use Core\Router;


require_once dirname(__DIR__) . '/vendor/autoload.php';

//Errors and Exceptions
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

//Start Session
session_start();

$router = new Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('login', ['controller' => 'Login', 'action' => 'new']);
$router->add('logout', ['controller' => 'Login', 'action' => 'destroy']);
$router->add('{controller}/{action}');
$router->add('{controller}/{action}/{id:\d+}');

$router->dispatch($_SERVER['QUERY_STRING']);