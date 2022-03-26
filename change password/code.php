<?php 
require "../partials/conn.php";
session_start();
$boolLoggedIn=false;
if (isset($_SESSION) and isset($_SESSION['username'])) {
    $boolLoggedIn = true;
    $currentUser = $_SESSION['username'];
     

if (isset($_POST['op']) && isset($_POST['np'])
    && isset($_POST['c_np'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$op = validate($_POST['op']);
	$np = validate($_POST['np']);
	$c_np = validate($_POST['c_np']);
    
    if(empty($op)){
      header("Location: passwordChange.php?error=Fields cannot be Empty, Enter passwords");
	  exit();
    }else if(empty($np)){
      header("Location: passwordChange.php?error=New Password is required");
	  exit();
    }else if($np !== $c_np){
      header("Location: passwordChange.php?error=New password  does not match");
	  exit();
    }else {
    	// hashing the password
    	$op = password_hash($op, PASSWORD_DEFAULT);
    	$np = password_hash($np, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM `alluser` WHERE `username` = '$currentUser'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
        	$sql_2 = "UPDATE `alluser` SET `password`='$np'
        	          WHERE `username`='$currentUser'";
        	mysqli_query($conn, $sql_2);
        	header("Location: ./passwordChange.php?success=Your password has been changed successfully");
           
	        // exit();

        }else {
        	header("Location: ./passwordChange.php?error=Incorrect password");
	        exit();
        }

    }

    
}else{
	header("Location: ./passwordChange.php");
	exit();
}

}else{
     header("Location: ../user profile/profile.php");
     exit();
}