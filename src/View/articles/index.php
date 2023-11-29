<?php require 'View/includes/header.php' ?>

<section>
    <h1>Articles</h1>
    <ul>
        <?php foreach ($articles as $article): ?>
            <li>
                <a href="?page=articles-show&id=<?php echo $article->getId(); ?>">
                    <p><?php echo $article->getTitle(); ?> - Publish Date: <?php echo $article->getPublishDate(); ?></p>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>


<?php require 'View/includes/footer.php'?>