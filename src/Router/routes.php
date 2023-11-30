<?php

declare(strict_types=1);

use App\Controller\HomepageController;
use App\Controller\ArticleController;

$homepageController = new HomepageController();
$articleController = new ArticleController();

$router->get('/', [$homepageController, 'index']);
$router->get('/articles', [$articleController, 'index']);
$router->get('/articles/:id', [$articleController, 'show']);
$router->post('/articles/create', [$articleController, 'create']);
$router->get('/articles/:id/update', [$articleController, 'update']);
