<?php
$server = "localhost:3307";
$user = "root";
$password = "";
$dbname = "blogweb";

$conn = mysqli_connect($server, $user, $password, $dbname);
if (!$conn) {
    die("connection Failed " . mysqli_connect_error());
} else {
    // echo "Connection Established !";
}