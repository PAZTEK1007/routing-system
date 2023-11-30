<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
// Include all your model files here
use App\Model\Article;
use App\Model\Author;


// Include all your controllers here

use App\Controller\ArticleController;
use App\Controller\AuthorController;
use App\Controller\HomepageController;


// Start the session once
session_start();

// Get the current page to load
// If nothing is specified, it will remain empty (home should be loaded)
$page = $_GET['page'] ?? null;

// Load the controller
// It will *control* the rest of the work to load the page
switch ($page) 
{
    case 'articles':
        $articleController = new ArticleController();
        $articleController->index();
        break;
   
    case 'articles-show':
        $articleController = new ArticleController();
        $articleController->show();
        break;

    case 'articles-create':
        $articleController = new ArticleController();
        $articleController->create();
        break;
        
    case 'articles-update':
        $articleController = new ArticleController();
        $articleController->update();
        break;

    case 'articles-delete':
        $articleController = new ArticleController();
        $articleController->delete();
        break;

    case 'authors':
        $authorController = new AuthorController();
        $authorController->index();
        break;

    case 'authors-show':
        $authorController = new AuthorController();
        $authorController->show();
        break;

    case 'home':
        $homepageController = new HomepageController();
        $homepageController->index();
        break;
}
