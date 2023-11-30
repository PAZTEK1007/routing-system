<?php require 'View/includes/header.php'?>

<form method="post" action="">
    <h1>Create Article</h1>
    <label for="title">Title</label>
    <input type="text" name="title" placeholder="Title">
    <label for="description">Description</label>
    <input type="text" name="description" placeholder="Description">
    <label for="author">Author</label>
    <input type="text" name="author" placeholder="Author">
    <label for="authorId">Author ID</label>
    <input type="text" name="authorId" placeholder="Author ID">
    <label for="imgSrc">Image Source</label>
    <input type="text" name="imgSrc" placeholder="Image Source">
    <input type="submit" name="submit" value="Submit">
</form>

<?php require 'View/includes/footer.php'?>