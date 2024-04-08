<?php session_start(); ?>
<?php
$url = $_SERVER['PHP_SELF'];
$seg = explode('/', $url);
$path =  "http://localhost" . $seg[0] . '/' . $seg[1];
$static_url = $path . '/' . 'user_img' . '/' . 'default.png';
?>

<?php include('./inc/header.php'); ?>
<?php include("config/functions.php"); ?>
<div class="container mt-0 mb-5">
    <div class="row mt-5 gy-5">
        <?php include("config/db.php");
      $all_post_query = "SELECT * FROM posts ORDER BY timestamp DESC";
      $post_result = mysqli_query($conn, $all_post_query) or die("Error");
      if (mysqli_num_rows($post_result) > 0) {

         while ($posts = mysqli_fetch_assoc($post_result)) {
            $id = $posts['id'];
            $title = $posts['title'];
            $category = $posts['category'];
            $description = $posts['description'];
            $img_url = $posts['img_url'];
            $user_id = $posts['user_id'];
            $user_name = $posts['user_name'];
            $user_img_url = $posts['user_img_url'];
            $timestamp = $posts['timestamp'];
      ?>

        <div class="col-xl-4 col-lg-5">
            <div class="card" style="width: auto;">
                <img class="card-img-top border shadow-sm all-posts" src="<?php echo $img_url; ?>"
                    alt="<?php echo $img_url; ?>" style="width: 22rem; height:22rem;">
                <div class="card-body">
                    <a href="view.php?id=<?php echo $id; ?>" class="card-title"><?php echo $title; ?></a></a>
                    <p class="card-text mt-2 text-sm" style="font-size: 15px;">
                        <?php echo myTruncate($description, 100); ?></p>
                    <div class="user_info_card_bottom">
                        <div class="user_card_img_wrapper">
                            <?php if ($user_img_url) : ?>
                            <img src="<?php echo $user_img_url; ?>" alt="<?php echo $user_img_url; ?>"
                                class="post_credits_author_thumb border shadow-sm">
                            <?php elseif ($static_url) : ?>
                            <img src="<?php echo $static_url; ?>" alt="default_user_img"
                                class="post_credits_author_thumb border shadow-sm">
                            <?php else :
                                        echo "<p>Sorry no img to display</p>";
                                    ?>
                            <?php endif; ?>
                        </div>
                        <span class="text-capitalize" style="color:gray;">by <?php echo $user_name; ?></span>
                        <span class="date_card_bottom"
                            style="color:gray; font-size:13px;"><?php echo HumanReadDate($timestamp); ?></span>
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
    </div>
</div>
<br><br><br><br><br>
<?php include('./inc/footer.php'); ?>