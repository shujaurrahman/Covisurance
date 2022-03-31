<?php

require '../partials/conn.php';
session_start();
session_unset();
session_destroy();
$currentUser=$_GET['username'];
$sql2="UPDATE `notify` SET `logout`= '1' WHERE `username`='$currentUser'";
$result2=mysqli_query($conn,$sql2);
header("Location: ../index.php");

?>