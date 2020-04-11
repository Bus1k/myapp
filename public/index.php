<?php

require '../Core/Router.php';

$router = new Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}');

echo '<pre>';
var_dump($router->getRoutes());
echo '<pre>';

$url = $_SERVER['QUERY_STRING'];

if($router->match($url))
{
    echo '<pre>';
    var_dump($router->getParams());
    echo '<pre>';
}
else
{
    echo 'No found route URL: '.$url;
}