<?php

namespace App\Controller;

use App\Data\DataBaseManager;

class ArticleController
{
    protected $PDO;

    const ERROR_DB_CONNECTION = "Database connection is not initialized.";
    const ERROR_QUERY_EXECUTION = "Error executing the query.";
    const ERROR_ARTICLE_NOT_FOUND = "Article not found.";
    const ERROR_ARTICLE_ID_MISSING = "Article ID is missing.";

    public function __construct()
    {
        $bdd = new DataBaseManager('localhost', 'mvc', 'root', 'root');
        $this->PDO = $bdd->connect();
    }

    public function index()
    {
        // Load all required data
        $articles = $this->getArticles();

        // Load the view
        require 'View/articles/index.php';
    }

    private function getArticles()
    {
        if (!$this->PDO) {
            throw new Exception(self::ERROR_DB_CONNECTION);
        }

        $sql = "SELECT * FROM articles";
        $result = $this->PDO->query($sql);

        if (!$result) {
            throw new Exception(self::ERROR_QUERY_EXECUTION);
        }

        $rawArticles = $result->fetchAll();
        $articles = [];

        foreach ($rawArticles as $rawArticle) {
            // We are converting an article from a "dumb" array to a much more flexible class
            $articles[] = new Article(
                $rawArticle['id'],
                $rawArticle['title'],
                $rawArticle['description'],
                $rawArticle['author'],
                $rawArticle['authorId'],
                $rawArticle['img_src'],
                $rawArticle['publish_date']
            );
        }

        return $articles;
    }

    private function getArticleById($articleId)
    {
        if (!$this->PDO) {
            throw new Exception(self::ERROR_DB_CONNECTION);
        }

        $sql = "SELECT * FROM articles WHERE id = :id";
        $result = $this->PDO->prepare($sql);
        $result->execute(['id' => $articleId]);

        if (!$result) {
            throw new Exception(self::ERROR_QUERY_EXECUTION);
        }

        $rawArticle = $result->fetch();

        if (!$rawArticle) {
            throw new Exception(self::ERROR_ARTICLE_NOT_FOUND);
        }

        return new Article(
            $rawArticle['id'],
            $rawArticle['title'],
            $rawArticle['description'],
            $rawArticle['author'],
            $rawArticle['authorId'],
            $rawArticle['img_src'],
            $rawArticle['publish_date']
        );
    }

    public function show()
    {
        // TODO: this can be used for a detail page

        $articleId = $_GET['id'] ?? null;

        if ($articleId === null) {
            throw new Exception(self::ERROR_ARTICLE_ID_MISSING);
        }

        $article = $this->getArticleById($articleId);

        require 'View/articles/show.php';
    }
}
?>
