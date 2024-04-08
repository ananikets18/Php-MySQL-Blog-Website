<?php session_start(); ?>
<?php error_reporting(0); ?>
<?php
$url = $_SERVER['PHP_SELF'];
$seg = explode('/', $url);
$path =  "http://localhost" . $seg[0] . '/' . $seg[1];
$static_url = $path . '/' . 'user_img' . '/' . 'default.png';
?>
<?php include('./config/db.php');
$id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($conn, $query) or die('Error');
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $db_user_img_url = $row['user_img_url'];
    }
}
?>

<?php
include("config/db.php");
if (isset($_FILES['avatar'])) {
    $user_id = $_SESSION['id'];
    $file_name = $_FILES['avatar']['name'];
    $file_size = $_FILES['avatar']['size'];
    $file_tmp = $_FILES['avatar']['tmp_name'];
    $file_type = $_FILES['avatar']['type'];
    $target_dir = "assets/uploads";
    $target_file = $target_dir . basename($_FILES['avatar']['name']);
    $check = getimagesize($_FILES['avatar']['tmp_name']);
    $file_ext = strtolower(end(explode('.', $_FILES['avatar']['name'])));

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
        move_uploaded_file($file_tmp, "assets/uploads/" . $file_name);
        if (isset($_SERVER['HTTP_REFERER'])) {
            $url = $_SERVER['HTTP_REFERER'];
            $seg = explode('/', $url);
            $path = $seg[0] . '/' . $seg[1] . '/' . $seg[2] . '/' . $seg[3];
            $full_url = $path . '/' . 'assets/uploads/' . $file_name;
            $sql =  "UPDATE users set user_img_url = '$full_url' WHERE id='$user_id'";
            $query = $conn->query($sql);
            if ($query) {
                $success = "Profile Updated Succesfully ! 🎉";
                // header('Refresh: 2; url=dashboard.php');
                header('Refresh: 2; url=profile_img.php');
            } else {
                $msg = "Unable to upload image ! Please Try again";
            }
        }
    }
}
?>

<?php include('./config/db.php');
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
?>


<?php if (!$_SESSION['username']) :  ?>
    <?php header('Location:login.php') ?>
<?php else : ?>
    <?php include('./inc/header.php'); ?>
    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <div class="add_img_wrapper col-lg-10">
                <h4><img src="./img/party-popper.png" alt="add_post" class="emoji"> Upload Profile photo</h4>


                <div class="d-grid justify-content-center align-items-center my-5">
                    <?php if ($db_user_img_url) : ?>
                        <div class="position-relative">
                            <img src="<?php echo $db_user_img_url ?>" alt="user_img" class="shadow default_user_img">
                            <form action="profile_img.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button class="delete_btn_profile_img" name="delete"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>

                    <?php elseif ($static_url) : ?>
                        <img src="<?php echo $static_url; ?>" alt="default_user_img" class="shadow default_user_img">
                    <?php else :
                        echo "<p>Sorry no img to display</p>";
                    ?>
                    <?php endif; ?>
                </div>


                <div class="my-4">
                    <?php if (isset($_FILES['avatar']) === true) : ?>
                        <p class="alert alert-success text-center"> <?php echo $success; ?></p>
                    <?php elseif ((isset($_FILES['avatar']))) : ?>
                        <p class="alert alert-danger text-center"> <?php echo $msg; ?> <img src="./img/ban.png" alt="emoji" class="emoji"></p>
                    <?php else :
                        echo $msg;
                    ?>
                    <?php endif; ?>
                </div>

                <form action="profile_img.php" method="POST" enctype="multipart/form-data">
                    <div class="profile_user_img my-4">
                        <label for="profile_user_img" class="pb-2">Upload Image</label>
                        <input class="form-control" type="file" name="avatar">
                    </div>
                    <div class="submit_btn_wrapper w-100 d-grid">
                        <input type="submit" class="btn btn-success" name="profile" value="Submit">
                    </div>
                </form>

                <div class="d-grid text-center my-5">
                    <a href="dashboard.php" class="btn-link text-capitalize">return to Dashboard</a>
                </div>

            </div>

        </div>
    </div>
<?php endif; ?>