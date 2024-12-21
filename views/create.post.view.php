<?php require "partials/head.php";  ?>
<?php require "partials/nav.php";  ?>
<div class="container">
    <div class="row">
        <h2>Upload Image for Your Post</h2>
        <div class="col-8 offset-2">
            <form action="/user/create-post" method="POST" enctype="multipart/form-data">
                <label for="title"></label>
                <input type="text" name="title" id="title" placeholder="Title" class="form-control"  >
                     <p class="text-danger"><?= $errors_array['title_err'] ?? "" ?></p>
                <label for="image">Choose an image:</label>
                <input type="file" name="image" id="image" class="form-control" ><br><br>
                <label for="body">Description</label>
                <textarea name="body" cols="30" rows="10" class="form-control" ></textarea>
                     <p class="text-danger"><?= $errors_array['body_err'] ?? "" ?></p>
                <select name="category" class="form-control"  >
                    <?php foreach ($categories as $category ) : ?>
                        <option value="<?= $category->id  ?>"><?= $category->name ?></option>
                    <?php endforeach; ?>
                </select><br>
                <select name="visibility" class="form-control"  >
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                    <option value="friends">Friends</option>

                </select><br>

                <input type="submit" value="Publish" name="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>


<?php require "partials/bottom.php";  ?>



