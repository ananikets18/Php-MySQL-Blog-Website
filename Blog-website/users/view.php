<?php session_start(); ?>
<?php include("../config/functions.php"); ?>
<?php
define('CSSPATH', '../inc/css/'); 
$cssItem = 'style.css'; 
?>
<?php
$url = $_SERVER['PHP_SELF'];
$seg = explode('/', $url);
$path =  "http://localhost" . $seg[0] . '/' . $seg[1];
$static_url = $path . '/' . 'user_img' . '/' . 'default.png';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users View</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo (CSSPATH . "$cssItem"); ?>" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body style="height: 100vh;">
    <header class="border-bottom">
        <nav class="navbar navbar-expand-lg navbar-light" style="padding-top: 0;">
            <div class="container mt-2">
                <a class="navbar-brand heading fw-bolder fs-3 text-primary" href="../index.php"><img
                        src="../img/guidelines.png" alt="login" class="emoji"> B<span class="text-black">Log</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item mt-2 me-4">
                            <a class="nav-link text-black text-capitalize fw-normal" href="../posts.php">posts</a>
                        </li>
                        <li class="nav-item mt-2 me-4">
                            <a class="nav-link  text-black text-capitalize" href="../about.php">about</a>
                        </li>
                        <li class="nav-item mt-2 me-4">
                            <a class="nav-link  text-black text-capitalize" href="../guidelines.php">guidelines</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['id'])) : ?>
                        <li class="nav-item mt-2 me-4">
                            <a class="nav-link  text-black text-capitalize fw-normal"
                                href="../dashboard.php">dashboard</a>
                        </li>
                        <li class="nav-item mt-2 me-4">
                            <a class="nav-link  text-black text-capitalize fw-normal" href="../logout.php">logout</a>
                        </li>
                        <?php else : ?>
                        <li class="nav-item mt-2 me-4">
                            <a class="nav-link text-black text-capitalize fw-normal" href="../login.php">log in</a>
                        </li>
                        <li class="nav-item mt-2 me-4">
                            <a class="nav-link  text-black text-capitalize fw-normal" href="../signup.php">register</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <br><br>
    <div class="container">
        <div class="row justify-content-evenly p-2 rounded" style="background-color: #f8f9fa;">
            <div class="col-lg-4 col-md-4 d-flex align-items-center justify-content-center">
                <?php
                include('../config/db.php');
                $id = $_GET['id'];
                $query = "SELECT * FROM posts INNER JOIN users ON users.id=posts.user_id WHERE users.id='$id'";
                $result = mysqli_query($conn, $query) or die("Error");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['user_id'];
                        $user_name = $row['username'];
                        $name = $row['name'];
                        $bio = $row['bio'];
                        $user_img_url = $row['user_img_url'];
                        $joined_at = $row['created_at'];
                    }
                }
                $result = mysqli_query($conn, "SELECT COUNT(*) AS `count` FROM `posts` WHERE user_id = '$user_id'
            ");
                $row = mysqli_fetch_array($result);
                $count = $row['count'];
                ?>
                <!-- user -img goes here -->
                <div class="img_wrapper_user_view">
                <?php if ($user_img_url) : ?>
                                <img src="<?php echo $user_img_url; ?>" 
                                alt="<?php echo $user_img_url; ?>" class="post_credits_author_thumb border shadow-sm">
                            <?php elseif ($static_url) : ?>
                                <img src="<?php echo $static_url; ?>" alt="default_user_img" class="post_credits_author_thumb border shadow-sm">
                            <?php else :
                                echo "<p>Sorry no img to display</p>";
                            ?>
                <?php endif; ?>
                </div>
            </div>


            <div class="col-lg-8 col-md-6 mt-4 mt-sm-4 user_info__">
                <h3 class="username"><?php echo $user_name; ?></h3>
                <h5 class="text-capitalize users_full_name"><?php echo $name; ?></h5>
                <p class="bio"><?php echo $bio; ?></p>
                <p class="posts_created text-muted" style="font-size: 15px;">Posts created : <span
                        class="post_created_count"><?php echo $count; ?></span></p>
                <span>Date Joined : <?php echo HumanReadDate($joined_at); ?></span>
            </div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <span class="text-muted" style="letter-spacing: 1px;">Collection of posts created by <strong
                            class="text-capitalize"> <?php echo $name; ?></strong></span>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row users_post_container flex align-items-center my-5 gx-5 gy-3">
                <?php include("../config/db.php");
                $all_post_query = "SELECT * FROM posts WHERE user_id= '$user_id' ORDER BY timestamp DESC";
                $post_result = mysqli_query($conn, $all_post_query) or die("Error");
                if (mysqli_num_rows($post_result) > 0) {
                    while ($posts = mysqli_fetch_assoc($post_result)) {
                        $post_id = $posts['id'];
                        $post_title = $posts['title'];
                        $post_desc = $posts['description'];
                        $post_img_url = $posts['img_url'];
                ?>
                <div class="col-xl-4 col-lg-5 col-md-7">
                    <div class="card post__card" style="width: auto;">
                        <img class="card-img-top border shadow-sm" src="<?php echo $post_img_url; ?>" alt="post_img"
                            style="width: 22rem; height:22rem;">
                        <div class="card-body">
                            <a href="../view.php?id=<?php echo $post_id; ?>" class="card-title"
                                style="font-size: 18px;"><?php echo $post_title; ?></a>
                            <p class="card-text mt-2" style="font-size: 15px;">
                                <?php echo myTruncate($post_desc, 100); ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            } else {
            echo "Sorry ! No Post to show ";
            }

            ?>
            </div>
        </div>

    </div>




















    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>