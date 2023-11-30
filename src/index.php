<?php
declare(strict_types=1);

require_once '../vendor/autoload.php';

use App\Router\Router;
use App\Http\Request;

use App\Controller\HomepageController;
use App\Controller\ArticleController;

$request = new Request($_GET['url'] ?? '/');
$router = new Router($request);

// Inclure vos routes depuis routes.php
require 'Router/routes.php';

try {
    $router->resolve();
} catch (Exception $e) {
    // Gérer les erreurs de routage ici, par exemple, rediriger vers une page d'erreur 404
    require 'View/404.php';
}
