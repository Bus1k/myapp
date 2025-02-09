<?php

namespace Core;

/*
 * Base Controller
 */
abstract class Controller
{
    protected $route_params = [];

    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    public function __call($name, $arguments)
    {
        $method = $name . 'Action';

        if(method_exists($this, $method))
        {
            if($this->before() !== false)
            {
                call_user_func_array([$this, $method], $arguments);
                $this->after();
            }
            else
            {
                throw new \Exception("Method $method not found in controller ". get_class($this));
            }
        }
    }

    //Before Filter - Called before an action method
    //False return stops further execution
    protected function before()
    {
        //return false
    }

    //After Filter - Called after an action method
    protected function after()
    {

    }
}