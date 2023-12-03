<?php
require '../vendor/autoload.php';

use App\Router\Router;


$router = new Router();

$router->addRoutes('GET', '/', function() {
    echo 'Hello World';
});

$router->addRoutes('GET', '/pizza', function() {
    echo 'Hello Pizza';
});

$router->addRoutes('GET', '/hello/:name', function($name) {
    echo 'Hello ' . $name;
});

$router->matchRoute();
echo '<pre>';
var_dump($router);
echo '</pre>';