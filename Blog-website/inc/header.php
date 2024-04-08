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

<body class="d-flex flex-column h-100">
    <header class="border-bottom">
        <nav class="navbar navbar-expand-lg navbar-light" style="padding-top: 0;">
            <div class="container mt-2">
                <a class="navbar-brand heading fw-bolder fs-3 text-primary" href="index.php"><img
                        src="./img/guidelines.png" alt="login" class="emoji"> B<span class="text-black">Log</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item mt-2 me-4">
                            <a class="nav-link text-black text-capitalize fw-normal" href="posts.php">posts</a>
                        </li>
                        <li class="nav-item mt-2 me-4">
                            <a class="nav-link  text-black text-capitalize" href="about.php">about</a>
                        </li>
                        <li class="nav-item mt-2 me-4">
                            <a class="nav-link  text-black text-capitalize" href="guidelines.php">guidelines</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['id'])) : ?>
                        <li class="nav-item mt-2 me-4">
                            <a class="nav-link  text-black text-capitalize fw-normal" href="dashboard.php">dashboard</a>
                        </li>
                        <li class="nav-item mt-2 me-4">
                            <a class="nav-link  text-black text-capitalize fw-normal" href="logout.php">logout</a>
                        </li>
                        <?php else : ?>
                        <li class="nav-item mt-2 me-4">
                            <a class="nav-link text-black text-capitalize fw-normal" href="login.php">log in</a>
                        </li>
                        <li class="nav-item mt-2 me-4">
                            <a class="nav-link  text-black text-capitalize fw-normal" href="signup.php">register</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>