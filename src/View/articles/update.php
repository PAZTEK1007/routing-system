<?php require 'View/includes/header.php' ?>

<form method="post" action="">
    <h1>Update Article</h1>
    <label for="title">Title</label>
    <input type="text" name="title" placeholder="Title" value="<?php echo $updatedArticle->getTitle(); ?>">
    
    <label for="description">Description</label>
    <input type="text" name="description" placeholder="Description" value="<?php echo $updatedArticle->getDescription(); ?>">
    
    <label for="author">Author</label>
    <input type="text" name="author" placeholder="Author" value="<?php echo $updatedArticle->getAuthor(); ?>">
    
    <label for="authorId">Author ID</label>
    <input type="text" name="authorId" placeholder="Author ID" value="<?php echo $updatedArticle->getAuthorId(); ?>">
    
    <label for="imgSrc">Image Source</label>
    <input type="text" name="imgSrc" placeholder="Image Source" value="<?php echo $updatedArticle->getImgSrc(); ?>">
    
    <input type="submit" name="submit" value="Update">
</form>

<?php require 'View/includes/footer.php' ?>
