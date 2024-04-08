<?php session_start(); ?>
<?php error_reporting(0); ?>
<?php
include('./config/db.php');
if (isset($_POST['changepwd'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $Newpassword = $_POST['newpassword'];
    if (isset($_SESSION)) {
        echo $user_id = $_SESSION['id'];
    }

    if ($email != '' && $password != '' && $Newpassword != '') {
        if ($password != $Newpassword) {
            $hash = md5($password);
            $new_hash = md5($Newpassword);
            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$hash'";

            $query = mysqli_query($conn, $query) or die("Error");

            if (mysqli_num_rows($query) > 0) {
                if (isset($_SESSION)) {
                    echo $user_id = $_SESSION['id'];
                }
                $updSql = "UPDATE users SET password = '$new_hash' WHERE id = '$user_id'";

                if ($conn->query($updSql)) {
                    $msg = "Password Updated Successfully !";
                } else {
                    echo $msg = "Failed to Update Password";
                }
            } else {
                $msg = "Credentials Not Found";
                header('Location:dashboard.php');
            }
        } else {
            $msg = "Both Password's are same";
        }
    } else {
        $msg = "Please Fill all the Input Fields";
    }
}
?>

<?php include('./inc/header.php'); ?>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
                <div class="p-4 p-sm-5 bg-primary-soft p-4 p-sm-5 border border-light shadow" style="margin-top:5rem;">
                    <h2 class="text-center mb-5 text-capitalize h4"><img src="./img/lock.png" alt="login" class="emoji mx-2">change password <img src="./img/key.png" alt="login" class="emoji mx-2"></h2>
                    <div>

                        <?php if (isset($_POST['changepwd'])) : ?>
                            <p class="alert alert-primary text-center"> <?php echo $msg; ?> <img src="./img/ban.png" alt="emoji" class="emoji"></p>

                        <?php endif; ?>
                        <form action="changepwd.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Your Email">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Old Password</label>
                                <input type="password" name="password" class="form-control" placeholder="*********">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">New Password</label>
                                <input type="password" name="newpassword" class="form-control" placeholder="*********">
                            </div>
                            <div class="d-grid">
                                <input type="submit" name="changepwd" class=" btn btn-success" value="Change Password">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 text-center mt-5">
                    <a href="index.php" class="link">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('./inc/footer.php'); ?>