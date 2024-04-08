<?php session_start(); ?>
<main class="light_bg" style="background-color:#F9FAFB;">
    <?php include('./inc/header.php'); ?>
    <div class="container mt-5">
        <h3>Admin Dashboard</h3>
        <div class="post_table_wrapper my-5">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-capitalize">name</th>
                        <th scope="col" class="text-capitalize">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <?php
                include('./config/db.php');
                $sql = "SELECT * FROM users ORDER BY created_at DESC";
                $result = mysqli_query($conn, $sql) or die('Error');
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $username = $row['username'];
                        $email = $row['email'];

                ?>
                        <tbody>
                            <tr>
                                <th><?php echo $id; ?></th>
                                <td class="text-capitalize"><?php echo $name; ?></td>
                                <td style="color:gray;">@<?php echo $username; ?></td>
                                <td style="color:gray;"><?php echo $email; ?></td>
                                <td>
                                    <form action="delete_user.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                                        <button type="submit" name="delete" value="Delete" class="btn btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                <?php
                    }
                } else {
                    $error = "Username Or Password is incorrect ! Please Try again";
                }
                ?>
            </table>
        </div>
</main>
</div>
</main>
<?php include('./inc/footer.php'); ?>