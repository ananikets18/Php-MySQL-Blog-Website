<?php session_start();
?>
<?php if (!$_SESSION['username']) :  ?>
<?php header('Location:login.php') ?>
<?php else : ?>
<?php
  define('CSSPATH', './inc/css/'); //define css path
  $cssItem = 'style.css';
  $dashboardItem = 'dashboard.css';
  ?>
<?php
  include('./config/db.php');
  $id = $_SESSION['id'];
  $query = "SELECT * FROM users WHERE id = '$id'";
  $result = mysqli_query($conn, $query) or die('Error');
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $name = $row['name'];
      $img = $row['user_img_url'];
    }
  }
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Dashboard | Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo (CSSPATH . "$cssItem"); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo (CSSPATH . "$dashboardItem"); ?>" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-5" href="index.php" style="letter-spacing: 3px;">BLog</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid" style="height: 100vh;">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-capitalize mb-3" aria-current="page" href="dashboard.php">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-capitalize mb-3" href="profile.php">
                                profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-capitalize mb-3" href="profile_img.php">
                                update profile image
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-capitalize mb-3" href="post.php">
                                add post
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-capitalize" href="changepwd.php">
                                change password
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="mb-2 mb-md-0">
                        <a href="logout.php" class="fs-6" style="padding-right: 1rem;">Log out</a>
                    </div>
                </div>
                <div class="my-4">
                    <h4 class="text-capitalize"><img src="./img/hello.png" class="emoji" alt="Hello User emoji"> Hello,
                        <?php echo $name; ?></h4>
                </div>
                <span style="color:gray;">Below are the collection of the posts created by you !! you can perform
                    various actions including Read, Update & Delete</span>
                <div class="post_table_wrapper" style="margin-top: 2rem;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-capitalize">title</th>
                                <th scope="col" class="text-capitalize">created at</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <?php
              include('./config/db.php');
              $id = $_SESSION['id'];
              $query = "SELECT * FROM posts WHERE user_id = '$id'";
              $result = mysqli_query($conn, $query) or die('Error');
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $id = $row['id'];
                  $title = $row['title'];
                  $created_at = $row['timestamp'];
                  $img_url = $row['img_url'];

              ?>
                        <tbody>
                            <tr>
                                <th><?php echo $id; ?></th>
                                <td><a class="text-primary fs-6"
                                        href="view.php?id=<?php echo $id; ?>"><?php echo $title; ?></a></td>
                                <td style="color:gray;"><?php echo $created_at; ?></td>
                                <td> <a class="btn btn-warning" href="edit.php?id=<?php echo $id; ?>">
                                        <i class="bi bi-pencil"></i>
                                    </a></td>
                                <td>
                                    <form action="delete.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $id ?>">
                                        <input type="hidden" name="post_img" value="<?php echo $img_url ?>">
                                        <button type="submit" name="delete" value="Delete" class="btn btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        <?php

                }
              }
              ?>
                    </table>

                </div>
            </main>
        </div>
    </div>

    <?php
    define('JSPATH', './inc/js/'); //define JS path
    $jsItem = 'script.js'; //JS item to display
    ?>
    <footer class="footer mt-auto py-3 border-top">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <span class="text-muted">&copy; 2021 - BLog Project </span>
                <span class="text-muted">218714</span>
            </div>

        </div>
    </footer>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js">
    </script>
    <script type="text/javascript" src="<?php echo (JSPATH . "$jsItem") ?>" defer></script>
</body>

</html>
<?php endif; ?>