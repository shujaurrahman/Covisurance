<?php
require '../partials/conn.php';
session_start();
$email='adminshuja@gmail.com';
$status = "Offline now";
$sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE email = '{$email}'");
session_unset();
session_destroy();

header("Location: ../index.php");

?>