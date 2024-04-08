<?php session_start(); ?>
<?php
$url = $_SERVER['PHP_SELF'];
$seg = explode('/', $url);
$path =  "http://localhost" . $seg[0] . '/' . $seg[1];
$static_url = $path . '/' . 'user_img' . '/' . 'default.png';
?>
<?php include('./inc/header.php'); ?>
<?php include('./config/functions.php'); ?>
<?php include("./config/db.php");
$post_id = $_GET['id'];
$all_post_query = "SELECT * FROM posts INNER JOIN users ON users.id=posts.user_id WHERE posts.id='$post_id'";
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
        $user_name_slug = $posts['username'];
        $user_img_url = $posts['user_img_url'];
        $timestamp = $posts['timestamp'];
    }
} else {
    echo "Sorry ! No Post to show ";
}

?>
<div class="container">
    <div class="row mt-4">
        <div class="col-lg-12">
            <div>
                <div class="bg_img w-100 d-grid">
                    <img style="width: 100%;" src="<?php echo $img_url; ?>" alt="<?php echo $img_url; ?>"
                        class="border shadow">
                </div>

                <span class="badge bg-primary text-capitalize p-2 mt-3 fw-bold"
                    style="letter-spacing: 1.5px;"><?php echo $category; ?></span>
                <p class="text-capitalize h2 mt-5"><?php echo $title; ?></p>
            </div>
        </div>
    </div>
    <div class="row gx-4">
        <div class="col-lg-12">
            <!-- complete description -->
            <p>
                <?php echo $description; ?>
            </p>
            <!-- Add Successfullyy -->
            <?php if (isset($_SESSION['id'])) : ?>
            <?php if ($_SESSION['id'] != $user_id) : ?>
            <?php else : ?>
            <div class="my-5 d-flex">
                <a class="btn btn-warning mx-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit this Post"
                    href="edit.php?id=<?php echo $post_id; ?>">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="delete.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $post_id ?>">
                    <input type="hidden" name="post_img" value="<?php echo $img_url ?>">
                    <button type="submit" name="delete" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Delete this Post" value="Delete" class="btn btn-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
            <?php endif; ?>
            <?php else : ?>
            <?php endif; ?>
        </div>

        <div class="container">
            <button type="button" class="btn btn-secondary" title="Share this Post" data-bs-toggle="modal"
                data-bs-target="#shareModel"><i class="bi bi-share"></i></button>
            <!-- Modal -->
            <div class="modal fade" id="shareModel" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Share this Post On :</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>

                            <a class="link_anchor" name="fb_share" type="button"
                                href="https://www.facebook.com/sharer.php?<?php echo $actual_link; ?>>&t=<<?php echo $title; ?>>"><i
                                    class="bi bi-facebook"></i></a>

                            <a class="link_anchor" href="whatsapp://send?text=<<?php echo $actual_link; ?>>"
                                data-action="share/whatsapp/share" target="_blank" title="Share on whatsapp">
                                <i class="bi bi-whatsapp"></i>
                            </a>

                            <a class="link_anchor"
                                href="https://twitter.com/share?url=<<?php echo $actual_link; ?>>&text=<<?php echo $title; ?>>"
                                target="_blank" title="Share on Twitter"><i class="bi bi-twitter"></i></a>


                            <a class="link_anchor"
                                href="https://www.linkedin.com/shareArticle?mini=true&url=<<?php echo $actual_link; ?>>&t=<<?php echo $title; ?>>"
                                target="_blank" title="Share on Linkedin"><i class="bi bi-linkedin"></i></a>

                            <a class="link_anchor"
                                href="mailto:?subject=[<?php echo myTruncate($description, 10); ?>]&body=<<?php echo $actual_link; ?>>"
                                target="_blank" title="Share on Mail"><i class="bi bi-envelope-open"></i></a>

                            <a class="link_anchor" href="http://www.reddit.com/submit?url=<<?php echo $actual_link; ?>>"
                                target="_blank" title="Share on Mail"><i class="bi bi-reddit"></i></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col-lg-6 mt-5">
            <div class="bg-light border shadow-sm rounded d-flex p-2" style="height:auto;">
                <div>
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
                <div class="mt-3 d-flex flex-column" style="margin-left: 2em;">
                    <a href="./users/view.php?id=<?php echo $user_id; ?>" class="text-capitalize mb-2">Created by
                        <?php echo $user_name; ?></a>
                    <span style="font-size: 15px; color:gray;">Created on <?php echo HumanReadDate($timestamp); ?>
                    </span>
                </div>
            </div>
        </div>

    </div>
    <br><br>
</div>
<br><br>
<?php include('./inc/footer.php'); ?>