<?php
declare(strict_types=1);

require_once '../vendor/autoload.php';

use App\Router\Router;
use App\Http\Request;

use App\Controller\HomepageController;
use App\Controller\ArticleController;


$request = new Request();
$router = new Router($request);

require 'Router/routes.php';

try {
    $router->resolve();
} catch (Exception $e) {

    require 'View/404.php';
}
