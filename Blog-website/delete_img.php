<?php session_start();
include('./config/db.php');
if (isset($_POST['delete'])) {
    echo $id = $_POST['id'];
    $sql = "UPDATE users SET user_img_url = '' WHERE id = '$id'";
    $query = $conn->query($sql);
    if ($query) {
        header("location:profile_img.php");
    } else {
        echo "Can't Delete image";
    }
}