<?php
namespace App\Controller;

use App\Data\DataBaseManager;
use App\Model\Author;
use App\Model\Article;

class AuthorController
{
    protected $PDO;

    const ERROR_DB_CONNECTION = "Database connection is not initialized.";
    const ERROR_QUERY_EXECUTION = "Error executing the query.";
    const ERROR_AUTHOR_NOT_FOUND = "Author not found.";
    const ERROR_ARTICLE_NOT_FOUND = "Article not found.";
    const ERROR_AUTHOR_ID_MISSING = "Author ID is missing.";

    public function __construct()
    {
        $bdd = new DataBaseManager('localhost', 'mvc', 'root', 'root');
        $this->PDO = $bdd->connect();
    }

    public function index()
    {
        // Load all required data
        $authors = $this->getAuthorsData();
        // Load the view
        require 'View/authors/index.php';
    }

    private function getAuthorsData()
    {
        if (!$this->PDO) {
            throw new Exception(self::ERROR_DB_CONNECTION);
        }

        $sql = "SELECT * FROM authors";
        $result = $this->PDO->query($sql);

        if (!$result) {
            throw new Exception(self::ERROR_QUERY_EXECUTION);
        }

        $rawAuthors = $result->fetchAll();
        $authors = [];

        foreach ($rawAuthors as $rawAuthor) {
            // We are converting an author from a "dumb" array to a much more flexible class
            $authors[] = new Author(
                $rawAuthor['id'],
                $rawAuthor['username'],
                $rawAuthor['Name'],
                $rawAuthor['Lastname'],
                $rawAuthor['Picture'],
                $rawAuthor['DateOfBirth'],
                $rawAuthor['Description'],
            );
        }

        return $authors;
    }

    private function getAuthorById($authorId)
    {
        if (!$this->PDO) {
            throw new Exception(self::ERROR_DB_CONNECTION);
        }

        $sql = "SELECT * FROM authors WHERE id = :id";
        $result = $this->PDO->prepare($sql);
        $result->execute(['id' => $authorId]);

        if (!$result) {
            throw new Exception(self::ERROR_QUERY_EXECUTION);
        }

        $rawAuthor = $result->fetch();

        if (!$rawAuthor) {
            throw new Exception(self::ERROR_AUTHOR_NOT_FOUND);
        }

        return new Author(
            $rawAuthor['id'],
            $rawAuthor['username'],
            $rawAuthor['Name'],
            $rawAuthor['Lastname'],
            $rawAuthor['Picture'],
            $rawAuthor['DateOfBirth'],
            $rawAuthor['Description'],
        );
        return $authors;
    }

    private function getArticlesByAuthor($authorId)
    {
        if (!$this->PDO) {
            throw new Exception(self::ERROR_DB_CONNECTION);
        }

        $sql = "SELECT * FROM articles
        WHERE authorId = :id"; 
        $result = $this->PDO->prepare($sql);
        $result->execute(['id' => $authorId]);

        if (!$result) {
            throw new Exception(self::ERROR_QUERY_EXECUTION);
        }

        $rawArticles = $result->fetchAll();
        $articles = [];

        foreach ($rawArticles as $rawArticle) {
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

    public function show()
    {
        // TODO: this can be used for a detail page

        $authorId = $_GET['id'] ?? null;

        if ($authorId === null) {
            throw new Exception(self::ERROR_AUTHOR_ID_MISSING);
        }

        $author = $this->getAuthorById($authorId); // Fixed variable name
        $articles = $this->getArticlesByAuthor($authorId); // Fixed method name
        require 'View/authors/show.php';
    }
}
?>
