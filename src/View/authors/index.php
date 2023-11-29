<?php require 'View/includes/header.php' ?>

<section>
    <h1>Authors</h1>
    <ul>
        <?php foreach ($authors as $author): ?>
            <li>
                <a href="?page=authors-show&id=<?php echo $author->getId(); ?>">
                    <p><?php echo $author->getName(); ?></p>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
