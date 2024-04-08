<?php error_reporting(0); ?>
<?php session_start();

include('./config/db.php');

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $sql = "DELETE FROM users WHERE id = $id";
    $query = $conn->query($sql);
    if ($query) {
        header("location:admin.php");
    }
}
?>