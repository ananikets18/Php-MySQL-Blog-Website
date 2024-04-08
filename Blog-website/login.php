<?php session_start(); ?>
<?php error_reporting(0); ?>

<?php
include('./config/db.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username != '' && $password != '') {
        $encrypted_pwd = md5($password);
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$encrypted_pwd'";
        $result = mysqli_query($conn, $sql) or die('Error');

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $username = $row['username'];
                $email = $row['email'];

                $_SESSION['id'] = $id;
                $_SESSION['name'] = $name;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;

                header('Location:dashboard.php');
            }
        } else {
            $error = "Username Or Password is incorrect ! Please Try again";
        }
    } else {
        $error = "Please Fill all the Input Fields";
    }
}

?>


<?php if ($_SESSION['name']) : ?>
<?php header('Location:dashboard.php') ?>
<?php else : ?>
<?php
    define('CSSPATH', './inc/css/');
    $cssItem = 'style.css';
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo (CSSPATH . "$cssItem"); ?>" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
                    <div class="p-4 p-sm-5 bg-primary-soft p-4 p-sm-5 border border-light shadow">
                        <div class="text-center mb-4">
                            <h2 class="login_title"><img src="./img/guidelines.png" alt="login" class="emoji"> BLog <img
                                    src="./img/guidelines.png" alt="login" class="emoji"></h2>
                        </div>
                        <h5 class="text-center mb-3 fw-normal"><img src="./img/key.png" alt="login" class="emoji"> Log
                            in to your account <img src="./img/key.png" alt="login" class="emoji"></h5>

                        <?php if (isset($_POST['login'])) : ?>
                        <p class="alert alert-danger text-center"> <?php echo $error; ?> <img src="./img/ban.png"
                                alt="emoji" class="emoji"></p>

                        <?php endif; ?>

                        <!-- Form START -->
                        <form class="mt-2" action="login.php" method="POST">
                            <!-- Username -->
                            <div class="mb-3">
                                <label class="form-label" for="exampleInputEmail1">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control mb-2"
                                    placeholder="*********">
                                <a href="changepwd.php" style="font-size: 14px;">Forget Password ?</a>
                            </div>
                            <!-- Button -->
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <input type="submit" name="login" class="btn btn-success" value="Sign me in">
                                </div>
                                <div class="col-sm-8 text-sm-end">
                                    <span>Don't have an account? <a href="signup.php"><u>Sign up</u></a></span>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="text-center mt-4">
                        <a href="index.php" class="text-capitalize text-black btn btn-warning rounded"><i
                                class="bi bi-house-door"></i> Back to home <i class="bi bi-house-door"></i></a>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <?php include('./inc/footer.php'); ?>
    <?php endif; ?>