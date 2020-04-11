<?php

namespace Core;


class Router
{
    protected $routes = [];

    protected $params = [];


    public function add($route, $params = [])
    {
        //Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        //Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        //Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        //Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    public function match($url)
    {
        //URL: controller/action - posts/index
        //$reg_exp = '/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/';

        foreach($this->routes as $route => $params)
        {
            if(preg_match($route, $url, $matches))
            {
                foreach($matches as $key => $match)
                {
                    if(is_string($key))
                    {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function dispatch($url)
    {
        if($this->match($url))
        {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = "App\Controllers\\$controller";

            if(class_exists($controller))
            {
                $controller_object = new $controller();

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if(is_callable([$controller_object, $action]))
                {
                    $controller_object->$action();
                }
                else
                {
                    echo "Method $action (in controller $controller) not found";
                }
            }
            else
            {
                echo "Controller class $controller not found";
            }
        }
        else
        {
            echo "No route matched";
        }
    }

    protected function convertToStudlyCaps($string)
    {
        //post-authors => PostAuthors
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    protected function convertToCamelCase($string)
    {
        //add-new => addNew
        return lcfirst($this->convertToStudlyCaps($string));
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}