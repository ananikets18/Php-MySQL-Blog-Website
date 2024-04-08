<?php error_reporting(0); ?>
<?php session_start();

include('./config/db.php');

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $posting_img = $_POST['post_img'];
    $seg = explode('/', $posting_img);
    $image = $seg[6];
    $sql = "DELETE FROM posts WHERE  id = $id";
    $query = $conn->query($sql);
    if ($query) {
        header("location:index.php");
    }
}

?>