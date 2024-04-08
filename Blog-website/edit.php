<?php session_start(); ?>
<?php if (!isset($_SESSION['username'])) : ?>
<?php header('Location:dashboard.php'); ?>
<?php else : ?>
<?php include('./inc/header.php'); ?>
<?php
    include("config/db.php");
    $id = $_GET['id'];
    $all_post_query = "SELECT * FROM posts WHERE id ='$id'";
    $post_result = mysqli_query($conn, $all_post_query) or die("Error");
    if (mysqli_num_rows($post_result) > 0) {
        while ($posts = mysqli_fetch_assoc($post_result)) {
            $id = $posts['id'];
            $title = $posts['title'];
            $category = $posts['category'];
            $description = $posts['description'];
            $img_url = $posts['img_url'];
            $user_id = $posts['user_id'];
        }
    }
    ?>
<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="add_post_wrapper col-lg-10">
            <h4><img src="./img/party-popper.png" alt="add_post" class="emoji"> Update Post</h4>

            <form action="update.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <input type="hidden" name="post_img" value="<?php echo $img_url; ?>">
                <div class="post_title my-4">
                    <label for="post_title" class="pb-2">Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
                </div>
                <div class="post_category  my-4">
                    <label for="category" class="pb-2">Category</label>
                    <select name="category" class="form-control">
                        <option value="education">Education</option>
                        <option value="technology">Technology</option>
                    </select>
                </div>
                <div class="post_featured_img my-4">
                    <label for="featured_img" class="pb-2">Upload Image</label>
                    <input class="form-control" type="file" name="post_img">
                </div>
                <div class="post_description my-4">
                    <label for="post_description" class="pb-2">Description</label>
                    <textarea name="editor1" class="form-control"><?php echo $description; ?></textarea>
                </div>
                <div class="submit_btn_wrapper w-100 d-grid">
                    <input type="submit" class="btn btn-success" name="post_submit" value="Submit">
                </div>
            </form>
        </div>
    </div>

</div>

<br><br><br><br><br>
<footer class="footer mt-auto py-3 border-top">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <span class="text-muted">&copy; 2021 - BLog Project </span>
            <span class="text-muted">218714</span>
        </div>
    </div>
</footer>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js">
</script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('editor1');
</script>
</body>

</html>
<?php endif; ?>