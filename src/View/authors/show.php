<?php require 'View/includes/header.php'?>

<?php
    $authorId = $author->getId();
    $authorUserName = $author->getUsername();
    $authorName = $author->getName();  
    $authorLastName = $author->getLastname(); 
    $authorDescription = $author->getDescription();
    $authorDateOfBirth = $author->getDateOfBirth();
    $authorPicture = $author->getPicture();

    $authorPrevious = $authorId - 1;
    $authorNext = $authorId + 1;
    
    if ($authorPrevious < 1) {
        $authorPrevious = 1;
    }
    if ($authorNext > 5) {
        $authorNext = 5;
    }

?>

<section>
    <h1><?php echo $authorUserName; ?></h1>
    <figure>
        <img width="150px" src="<?php echo $authorPicture; ?>" alt="<?php echo $authorName; ?>">
        <figcaption><?php echo $authorName . ' ' . $authorLastName; ?></figcaption>
    </figure>
    <p><?php echo $authorDescription; ?></p>
    <p>Date Of Birth: <time><?php echo $authorDateOfBirth; ?></time></p>

    <h2>Articles by <?php echo $authorUserName; ?>:</h2>

    <?php if (!empty($articles)) : ?>
        <ul>
            <?php foreach ($articles as $article) : ?>
                <li>
                    <a href="?page=articles-show&id=<?php echo $article->getId(); ?>">
                        <?php echo $article->getTitle(); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No articles found for this author.</p>
    <?php endif; ?>

    <a href="?page=authors-show&id=<?php echo $authorPrevious; ?>">Previous authors</a>
    <a href="?page=authors-show&id=<?php echo $authorNext; ?>">Next authors</a>
</section>

<?php require 'View/includes/footer.php'?>
