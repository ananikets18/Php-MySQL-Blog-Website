<?php
include('./config/db.php');
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username != '' && $password != '') {

        if ($username == "admin" && $password == "admin") {
            header('Location:admin.php');
        } else {
            $error = "You are not an admin !";
        }
    } else {
        $error = "Please Fill all the Input Fields";
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
    <title><?php  ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo (CSSPATH . "$cssItem"); ?>" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        .hint {
            font-size: 13px;
            color: gray;
            font-style: italic;
        }
    </style>
</head>

<body>
    <section class="content">
        <div class="position-absolute  m-3">
            <a href="index.php" class="text-capitalize text-black btn btn-warning rounded"><i class="bi bi-house-door"></i> Back to home <i class="bi bi-house-door"></i></a>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
                    <div class="p-4 p-sm-5 bg-primary-soft p-4 p-sm-5 border border-light shadow" style="margin-top: 5rem;">
                        <div class="text-center mb-4">
                            <h2 class="login_title"><img src="./img/guidelines.png" alt="login" class="emoji"> BLog <img src="./img/guidelines.png" alt="login" class="emoji"></h2>
                        </div>
                        <h5 class="text-center mb-3 fw-normal"><img src="./img/key.png" alt="login" class="emoji"> Log in to Admin account <img src="./img/key.png" alt="login" class="emoji"></h5>

                        <!-- Form START -->
                        <form class="mt-3" action="admin_login.php" method="POST">

                            <?php if (isset($_POST['login'])) : ?>
                                <p class="alert alert-danger text-center"> <?php echo $error; ?> <img src="./img/ban.png" alt="emoji" class="emoji"></p>

                            <?php endif; ?>

                            <!-- Username -->
                            <div class="mb-3">
                                <label class="form-label" for="exampleInputEmail1">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username">
                                <span class="hint">hint : admin</span>
                            </div>
                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control mb-2" placeholder="*********">
                                <span class="hint">hint : admin</span>
                            </div>
                            <!-- Button -->
                            <div class="row align-items-center">
                                <div class="col-sm-4 d-grid w-100">
                                    <input type="submit" name="login" class="btn btn-success" value="Sign me in">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="text-center mt-4">
                        <button class="text-capitalize text-black btn btn-warning rounded"> Look's like you are admin</button>
                    </div>

                </div>

            </div>
        </div>
        <?php include('./inc/footer.php'); ?>