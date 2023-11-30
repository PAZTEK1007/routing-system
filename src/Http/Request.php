<?php

namespace App\Http;

class Request
{
    private $method;
    private $path;
    private $params;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->params = $_REQUEST;
    }

    public function getMethod()
    {
        return $this->method;
    }
    public function getPath()
    {
        return $this->path;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getParam($key)
    {
        return $this->params[$key] ?? null;
    }
}
