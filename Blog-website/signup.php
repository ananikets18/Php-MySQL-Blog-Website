<?php session_start();?>
<?php error_reporting(0); ?>
<?php
include("config/db.php");
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($name != '' && $username != '' && $email != '' && $password != '') {
        $pwd_hash = md5($password);
        $sql = "INSERT INTO users (name,username,email,password) VALUES ('$name', '$username', '$email', '$pwd_hash')";
        $query = $conn->query($sql);
        if ($query) {
            header('Location:login.php');
        } else {
            $error = "Failed to Register User !";
        }
    }
     else {
        $error =  'Please Fill all the Details !';
    }
}
?>
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
    <?php if ($_SESSION['name']) : ?>
    <?php header('Location:dashboard.php') ?>
    <?php else : ?>
    <main class="content">
        <section>
            <div class="position-absolute m-3">
                <a href="index.php" class="text-capitalize text-black btn btn-warning rounded my-2 me-3"><i
                        class="bi bi-arrow-left"></i> Back to home</a>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
                        <div class="bg-primary-soft p-4 p-sm-5 border border-light shadow mt-3">
                            <div class="text-center mb-4">
                                <h2 class="login_title"><img src="./img/guidelines.png" alt="login" class="emoji"> BLog
                                    <img src="./img/guidelines.png" alt="login" class="emoji">
                                </h2>
                            </div>

                            <h5 class="text-center mb-3 fw-normal"><img src="./img/write.png" alt="create"
                                    class="writing_hands"> Create your account <img src="./img/write.png" alt="create"
                                    class="writing_hands"></h5>
                            <div class="alerts">
                                <?php if (isset($_POST['register'])) : ?>

                                <p class="alert alert-danger text-center"><?php echo "Please Fill all the Details "; ?>
                                    <img src="./img/ban.png" alt="emoji" class="emoji">
                                </p>
                                <?php endif; ?>

                            </div>

                            <!-- Form START -->
                            <form class="mt-2" action="signup.php" method="POST">
                                <!-- NAME -->
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputEmail1">Full Name</label>
                                    <input type="text" name="name" class="form-control" aria-describedby="nameHelp"
                                        placeholder="Full name">
                                </div>
                                <!-- Username -->
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputEmail1">Username</label>
                                    <input type="text" name="username" class="form-control"
                                        aria-describedby="UsernameHelp" placeholder="Username">
                                </div>
                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="E-mail">
                                    <small id="emailHelp" class="form-text">We'll never share your email with anyone
                                        else.</small>
                                </div>
                                <!-- Password -->
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password" class="form-control"
                                        id="exampleInputPassword1" placeholder="*********">
                                </div>
                                <!-- Button -->
                                <div class="row align-items-center">
                                    <div class="col-sm-4">
                                        <input type="submit" name="register" class="btn btn-success" value="Sign me up">

                                    </div>
                                    <div class="col-sm-8 text-sm-end mt-3 ">
                                        <span>Have an account? <a href="login.php" class="link-primary"><u>Sign
                                                    in</u></a></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
    </main>
    <?php endif; ?>
    <?php include("inc/footer.php"); ?>