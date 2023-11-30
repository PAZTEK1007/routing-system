<?php 
namespace App\Router;

class Route
{
    private $path;
    private $action;
    private $matches;
    private $params;
 
    public function __construct($path, $action) 
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }
 
    public function match($url) {
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
        $regex = "#^$path$#i";
        if (!preg_match($regex, $url, $matches)) 
        {
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }
 
    private function paramMatch($match) 
    {
        if (isset($this->params[$match[1]])) 
        {
            return '(' . $this->params[$match[1]] . ')';
        }
        return '([^/]+)';
    }
 
    public function setParams($params) 
    {
        $this->params = $params;
    }
 
    public function getUrl($params) 
    {
        $path = $this->path;

        foreach ($params as $k => $v) 
        {
            $path = str_replace(":$k", $v, $path);
        }

        return $path;
    }

    public function getMatches() 
    {
        return $this->matches;
    }
 
    public function call() 
    {
        if (is_string($this->action)) 
        {
            $params = explode('#', $this->action);
            $controller = "App\\Controller\\" . $params[0] . "Controller";
            $controller = new $controller();
            return call_user_func_array([$controller, $params[1]], $this->matches);
        } 
        else 
        {
            return call_user_func_array($this->action, $this->matches);
        }
    }
}

