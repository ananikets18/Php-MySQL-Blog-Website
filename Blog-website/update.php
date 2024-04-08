<?php session_start(); ?>
<?php error_reporting(0); ?>
<?php include('./inc/header.php'); ?>
<?php
include("config/db.php");

if (isset($_FILES['post_img'])) {
    $post_id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['editor1'];
    $category = $_POST['category'];
    $post_img = $_POST['post_img'];
    $data = array(
        'id' => $post_id,
        'title' => $title,
        'category' => $category,
        'description' => $description,
        'img_url' => $post_img
    );
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

                $image = $image_path[6];
                $full_url = $path . '/' . 'assets/featuredPost_img/' . $file_name;
                $id = $_SESSION['id'];
                $sql = "UPDATE posts 
                set title = '$title' , category = '$category', description = '$description', img_url = '$full_url' WHERE id='$post_id'";
                unlink("assets/featuredPost_img/" . $image);

                $query = $conn->query($sql);
                if ($query) {
                    $success = "Post Updated Succesfully ! 🎉";
                    header('Refresh: 2; url=dashboard.php');
                } else {
                    $msg = "Unable to Update Post ! Please Try again";
                }
            }
        }
    } else {
        $error =  'Please Fill all the Details !';
    }
}
?>
<?php include('./inc/footer.php'); ?>