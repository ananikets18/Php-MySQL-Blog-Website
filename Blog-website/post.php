<?php session_start(); ?>
<?php error_reporting(0); ?>
<?php if (!$_SESSION['username']) :  ?>
    <?php header('Location:login.php') ?>
<?php else : ?>
    <?php include('./inc/header.php'); ?>
    <?php
    include("config/db.php");
    if (isset($_FILES['post_img'])) {
        $id = $_SESSION['id'];
        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_query($conn, $query) or die('Error');
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['id'];
                $user_name = $row['name'];
                $user_img_url = $row['user_img_url'];
            }
        }
        $title = $_POST['title'];
        $description = $_POST['editor1'];
        $category = $_POST['category'];
        if ($title != '' && $description != '' && $category != '') {
            $file_name = $_FILES['post_img']['name'];
            $file_size = $_FILES['post_img']['size'];
            $file_tmp = $_FILES['post_img']['tmp_name'];
            $file_type = $_FILES['post_img']['type'];
            $target_dir = "assets/featuredPost_img";
            $target_file = $target_dir . basename($_FILES['post_img']['name']);
            $check = getimagesize($_FILES['post_img']['tmp_name']);
            $file_ext = strtolower(end(explode('.', $_FILES['post_img']['name'])));

            $extensions = array("jpeg", "jpg", "png");
            if (in_array($file_ext, $extensions) == false) {
                $msg = "Image file is not supported ! Please Upload another !";
            }
            if (file_exists($target_file)) {
                $msg = "Sorry ! file already Exists";
            }
            if ($check = false) {
                $msg = "File is not an image !";
            }
            if (empty($msg) == true) {
                move_uploaded_file($file_tmp, "assets/featuredPost_img/" . $file_name);
                if (isset($_SERVER['HTTP_REFERER'])) {
                    $url = $_SERVER['HTTP_REFERER'];
                    $seg = explode('/', $url);
                    $path = $seg[0] . '/' . $seg[1] . '/' . $seg[2] . '/' . $seg[3];
                    $full_url = $path . '/' . 'assets/featuredPost_img/' . $file_name;
                    $sql = "INSERT INTO posts (title, category, description, img_url, user_id, user_name,user_img_url) VALUES ('$title', '$category', '$description', '$full_url', '$user_id', '$user_name', '$user_img_url')";
                    $query = $conn->query($sql);
                    if ($query) {
                        $success = "Post added Succesfully ! 🎉";
                        header('Refresh: 2; url=dashboard.php');
                    } else {
                        $msg = "Unable to Create Post ! Please Try again";
                    }
                }
            }
        } else {
            $error =  'Please Fill all the Details !';
        }
    }
    ?>

    <div class="container">
        <div class="row d-flex justify-content-center mt-5 mb-5">
            <div class="add_post_wrapper col-lg-10">
                <h4><img src="./img/party-popper.png" alt="add_post" class="emoji"> Add Post</h4>

                <div class="my-4">
                    <?php if (isset($_FILES['post_img']) === true) : ?>
                        <p class="alert alert-success text-center"> <?php echo $success; ?></p>
                    <?php elseif ((isset($_FILES['post_img'])) === false) : ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <img src="./img/guidelines_.png" alt="emoji" class="emoji"> <strong><a href="guidelines.php" class="text-black">Always Remember guidelines !</a></strong> while creating Posts. <img src="./img/guidelines.png" alt="emoji" class="emoji">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    <?php else :
                        echo $error;
                    ?>
                    <?php endif; ?>
                </div>

                <form action="post.php" method="POST" enctype="multipart/form-data">
                    <div class="post_title my-4">
                        <label for="post_title" class="pb-2">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter your Post title">
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
                        <textarea name="editor1" class="form-control" placeholder="Enter Post Description">
                </textarea>
                    </div>
                    <div class="submit_btn_wrapper w-100 d-grid">
                        <input type="submit" class="btn btn-success" name="post_submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br><br><br>
    <footer class="footer mt-auto py-3 border-top">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <span class="text-muted">&copy; 2021 - BLog Project </span>
                <span class="text-muted">218714</span>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script>
    </body>
    </html>
<?php endif; ?>