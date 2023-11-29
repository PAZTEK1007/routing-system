<?php require 'View/includes/header.php'?>

<?php
    $articleId = $article->getId();
    $articleTitle = $article->getTitle();
    $articleDescription = $article->getDescription();
    $articlePublishDate = $article->getPublishDate();
    $articleAuthor = $article->getAuthor();
    $articleAuthorID = $article->getAuthorId();	
    $articleImgSrc = $article->getImgSrc();
    $articlePrevious = $articleId - 1;
    $articleNext = $articleId + 1;
    
    if ($articlePrevious < 1) {
        $articlePrevious = 1;
    }
    if ($articleNext > 6) {
        $articleNext = 6;
    }
    
?>


<section>
    <h1><?php echo $articleTitle; ?> Par : <a href="?page=authors-show&id=<?php echo $articleAuthorID ?>" ><?php echo $articleAuthor?></a></h1>
    <img src="<?php echo $articleImgSrc; ?>" alt="<?php echo $articleTitle; ?>">
    <p><?php echo $articleDescription; ?></p>
    <p>Publish Date: <?php echo $articlePublishDate; ?></p>
    <a href="?page=articles-show&id=<?php echo $articlePrevious; ?>">Previous article</a>
    <a href="?page=articles-show&id=<?php echo $articleNext; ?>">Next article</a>
</section>

<?php require 'View/includes/footer.php'?>