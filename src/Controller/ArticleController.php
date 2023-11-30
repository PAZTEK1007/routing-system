<?php
namespace App\Controller;

use App\Data\DataBaseManager;
use App\Model\Article;

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
    private function createArticle()
    {
        if(isset($_POST['submit'])){

            $title = $_POST['title'];
            $description = $_POST['description'];
            $author = $_POST['author'];
            $authorId = $_POST['authorId'];
            $imgSrc = $_POST['imgSrc'];
            $dateTime = new \DateTime();
            $date = $dateTime->format('Y-m-d H:i:s');

            $sql = "INSERT INTO articles (title, description, author, authorId, img_src, publish_date) VALUES (:title, :description, :author, :authorId, :img_src, :publish_date)";
            $result = $this->PDO->prepare($sql);
            $result->execute(['title' => $title, 'description' => $description, 'author' => $author, 'authorId' => $authorId, 'img_src' => $imgSrc, 'publish_date' => $date]);

            if (!$result) {
                throw new Exception(self::ERROR_QUERY_EXECUTION);
            }
        }
    }
    public function updateArticle($articleId)
    {
        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $author = $_POST['author'] ?? '';
            $authorId = $_POST['authorId'] ?? '';
            $imgSrc = $_POST['imgSrc'] ?? '';

            // Perform the update operation
            $sql = "UPDATE articles SET title = :title, description = :description, author = :author, img_src = :img_src WHERE id = :id";
            $result = $this->PDO->prepare($sql);
            $result->execute([
                'title' => $title,
                'description' => $description,
                'author' => $author,
                'img_src' => $imgSrc,
                'id' => $articleId
            ]);

            if (!$result) {
                throw new Exception(self::ERROR_QUERY_EXECUTION);
            }
        }

        // Retrieve the updated article
        $updatedArticle = $this->getArticleById($articleId);

        return $updatedArticle;
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

    public function create()
    {
        $article = $this->createArticle();

        require 'View/articles/create.php';
    }
    public function update()
    {
        $articleId = $_GET['id'] ?? null;
        
        if ($articleId === null) {
            throw new Exception(self::ERROR_ARTICLE_ID_MISSING);
        }

        $updatedArticle = $this->updateArticle($articleId);

        // Pass the updated article to the update.php view
        require 'View/articles/update.php';

    }
    public function delete()
    {
        $articleId = $_GET['id'] ?? null;
        
        if ($articleId === null) {
            throw new Exception(self::ERROR_ARTICLE_ID_MISSING);
        }

        $sql = "DELETE FROM articles WHERE id = :id";
        $result = $this->PDO->prepare($sql);
        $result->execute(['id' => $articleId]);

        if (!$result) {
            throw new Exception(self::ERROR_QUERY_EXECUTION);
        }

        header('Location: ?page=articles');
    }
}
?>
