<?php

require '../partials/conn.php';
session_start();
$email=$_SESSION["email"];
$status = "Offline now";
$sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE email = '{$email}'");
if($sql){
    $currentUser=$_GET['username'];
    $sql2="UPDATE `notify` SET `logout`= '1' WHERE `username`='$currentUser'";
    $result2=mysqli_query($conn,$sql2);
}
session_unset();
session_destroy();
header("Location: ../index.php");
?>