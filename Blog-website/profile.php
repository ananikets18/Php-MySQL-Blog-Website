<?php session_start(); ?>
<?php if (!$_SESSION['username']) :  ?>
    <?php header('Location:login.php') ?>
<?php else : ?>
    <?php include('./inc/header.php'); ?>
    <?php include('./config/db.php');
    $id = $_SESSION['id'];
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $query) or die('Error');
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['name'];
            $username = $row['username'];
            $email = $row['email'];
            $bio = $row['bio'];
        }
    }
    ?>

    <?php
    if (isset($_POST['update'])) {
        $user_id = $_SESSION['id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $bio = $_POST['bio'];
        if ($name && $username  && $email && $bio) {
            // echo "Success";
            $sql = "UPDATE users set name = '$name' , username = '$username', email =  '$email' , bio = '$bio' WHERE id='$user_id'";
            $query = $conn->query($sql);
            if ($query) {
                $success = "Profile Updated Succesfully ! 🎉";
                header('Refresh: 2; url=dashboard.php');
            } else {
                $error = "Failed to Update User Profile ! Please Try again ";
            }
        } else {
            $error =  'Please Fill all the Details !';
        }
    }

    ?>

    <div class="container" style="height: 0;">
        <div class="row d-flex justify-content-center" style="margin-top: 6rem;">
            <div class="add_post_wrapper col-lg-10">
                <h4 class="text-capitalize" style="margin-bottom:2.5rem;">
                    <img src="./img/mirror.png" alt="add_post" class="emoji">
                    <img src="./img/young.png" alt="add_post" class="emoji">
                    update profile
                    <img src="./img/middle.png" alt="add_post" class="emoji">
                    <img src="./img/old.png" alt="add_post" class="emoji">
                </h4>
                <div class="my-4">
                    <?php if (isset($_POST['update']) === true) : ?>
                        <p class="alert alert-success text-center"> <?php echo $success; ?></p>
                    <?php endif; ?>
                </div>

                <form action="profile.php" method="POST">
                    <div class="user_name my-4">
                        <label for="name" class="pb-2 text-capitalize">name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                    </div>

                    <div class="user_name my-4">
                        <label for="username" class="pb-2 text-capitalize">username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                    </div>

                    <div class="user_email my-4">
                        <label for="email" class="pb-2 text-capitalize">email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                    </div>

                    <div class="user_bio my-4">
                        <label for="user_bio" class="pb-2 text-capitalize">bio</label>
                        <textarea class="form-control" name="bio"><?php echo $bio; ?></textarea>
                    </div>


                    <div class="submit_btn_wrapper w-100 d-grid">
                        <input type="submit" class="btn btn-success" name="update" value="Update">
                    </div>
                </form>
            </div>
        </div>
        <br><br><br>
    </div>
<?php endif; ?>