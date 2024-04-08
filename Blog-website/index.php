<?php session_start();
?>
<?php
$url = $_SERVER['PHP_SELF'];
$seg = explode('/', $url);
$path =  "http://localhost" . $seg[0] . '/' . $seg[1];
$static_url = $path . '/' . 'user_img' . '/' . 'default.png';
?>
<?php include("inc/header.php"); ?>
<?php include("config/functions.php"); ?>
<section class="position-relative mt-5">
    <div class="container">
        <?php include("config/db.php");
        $all_post_query = "SELECT * FROM posts ORDER BY timestamp DESC LIMIT 1";
        $post_result = mysqli_query($conn, $all_post_query) or die("Error");
        if (mysqli_num_rows($post_result) > 0) {
            while ($posts = mysqli_fetch_assoc($post_result)) {
                $id = $posts['id'];
                $title = $posts['title'];
                $description = $posts['description'];
                $img_url = $posts['img_url'];
                $user_name = $posts['user_name'];
                $user_img_url = $posts['user_img_url'];
                $timestamp = $posts['timestamp'];
        ?>

                <a href="view.php?id=<?php echo $id; ?>" style="color:white;">
                    <div class="bg_img_container" style="background: url('<?php echo $img_url; ?>');">
                        <div class="lead_post_content  d-flex align-items-center p-3 p-sm-4">
                            <div class="w-100 mt-auto text-white">
                                <h4 class="text-white"><?php echo $title; ?></h4>
                                <p class="text-white"><?php echo myTruncate($description, 130);  ?></p>
                                <div class="user_info_card_bottom">
                                    <div class="user_card_img_wrapper">
                                        <?php if ($user_img_url) : ?>
                                            <img src="<?php echo $user_img_url; ?>" alt="<?php echo $user_img_url; ?>" class="shadow default_user_img">
                                        <?php elseif ($static_url) : ?>
                                            <img src="<?php echo $static_url; ?>" alt="default_user_img" class="shadow default_user_img">
                                        <?php else :
                                            echo "<p>Sorry no img to display</p>";
                                        ?>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-capitalize" style="color:gray;">by <?php echo $user_name; ?></span>
                                    <span class="date_card_bottom" style="color:gray;"><?php echo HumanReadDate($timestamp); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
        <?php

            }
        } else {
            echo "Sorry ! No Post to show ";
        }

        ?>
        <br>
        <br>
        <div class="row mt-3 gy-10 gx-5">
            <main class="col-lg-9 col-md-12">
                <div class="mb-4">
                    <h4 class="m-0 heading"><i class="bi bi-stopwatch me-2"></i>Recent Posts</h4>
                </div>
                <div class="row gy-4" style="padding: 1rem;">
                    <?php include("config/db.php");
                    $all_post_query = "SELECT * FROM posts ORDER BY timestamp DESC LIMIT 6";
                    $post_result = mysqli_query($conn, $all_post_query) or die("Error");
                    if (mysqli_num_rows($post_result) > 0) {
                        while ($posts = mysqli_fetch_assoc($post_result)) {
                            $id = $posts['id'];
                            $title = $posts['title'];
                            $description = $posts['description'];
                            $img_url = $posts['img_url'];
                            $user_name = $posts['user_name'];
                            $user_img_url = $posts['user_img_url'];
                            $timestamp = $posts['timestamp'];
                    ?>
                            <div class="col-xl-6 col-lg-7 index_post_col">
                                <div class="card">
                                    <img class="card-img-top" src="<?php echo $img_url; ?>" alt="<?php echo $img_url; ?>">
                                    <div class="card-body">
                                        <a href="view.php?id=<?php echo $id; ?>" class="card-title"><?php echo $title; ?></a>
                                        <p class="card-text mt-2"><?php echo myTruncate($description, 130);  ?></p>
                                        <div class="user_info_card_bottom">
                                            <div class="user_card_img_wrapper">
                                                <?php if ($user_img_url) : ?>
                                                    <img src="<?php echo $user_img_url; ?>" alt="<?php echo $user_img_url; ?>" class="shadow default_user_img">
                                                <?php elseif ($static_url) : ?>
                                                    <img src="<?php echo $static_url; ?>" alt="default_user_img" class="shadow default_user_img">
                                                <?php else :
                                                    echo "<p>Sorry no img to display</p>";
                                                ?>
                                                <?php endif; ?>
                                            </div>
                                            <span class="text-capitalize" style="color:gray;">by
                                                <?php echo $user_name; ?></span>
                                            <span class="date_card_bottom" style="color:gray;"><?php echo HumanReadDate($timestamp); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                    <?php

                        }
                    } else {
                        echo "Sorry ! No Post to show ";
                    }
                    ?>

                    <div style="margin:3rem 0;">
                        <a class="btn btn-primary text-capitalize" href="posts.php" role="button">Show all posts <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </main>


            <main class="col-lg-3 mt-5 mt-lg-0">
                <div class="categories_wrapper mt-5">
                    <div>
                        <h4 class="m-0 heading fs-4"></i>Categories</h4>
                        <ul class="list-group mt-3">
                            <li class="list-group-item list-group-item-action">Technolgy</li>
                            <li class="list-group-item list-group-item-action">Education</li>
                        </ul>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>

<?php include("inc/footer.php"); ?>