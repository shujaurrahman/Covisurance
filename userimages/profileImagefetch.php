<?php
require "../partials/conn.php";
$boolLoggedIn = false;
if (isset($_SESSION) and isset($_SESSION['username'])) {
	$currentUser = $_SESSION['username'];
	$boolLoggedIn = true;
} else {
	//   header("Location: ../index.php");
}
if ($boolLoggedIn) {
	$sql = "SELECT * FROM `alluser` Where username ='$currentUser'";
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_object($result);
	$Dimage = $data->{"_image"};
}
if (empty($Dimage)) {
	$profilepic= "<img src='../static/img/default.jpg' alt=''>";
} else {
	// $profilepic = "<img src='../userimages/$currentUser.$Dimage' alt='../userimages/deafault.svg'>";

	//new
	// echo "$Dimage";
	$profilepic = "<img src='../userimages/$Dimage' alt='../userimages/deafault.svg'>";
}
