<?php

namespace App\Router;

class Router 
{

    private $routes = [];
    private $request;

    public function __construct($request) 
    {
        $this->request = $request;
    }

    public function get($route, $action) 
    {
        $this->routes['GET'][$route] = $action;
    }

    public function post($route, $action) 
    {
        $this->routes['POST'][$route] = $action;
    }

    public function resolve() 
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();
        $action = $this->routes[$method][$path] ?? null;
    
        if ($action instanceof \Closure) 
        {
            return $action();
        }
    
        if (is_string($action)) 
        {
            require $action;
            return;
        }
    
        if (is_array($action) && count($action) === 2 && is_callable($action)) 
        {
            list($controller, $method) = $action;
            $controllerInstance = new $controller();
            return call_user_func_array([$controllerInstance, $method], []);
        }
    
        require './View/404.php';
    }
}
