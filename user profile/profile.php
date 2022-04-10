<?php
$boolLoggedIn=false;
require "../partials/conn.php";
session_start();
if (isset($_SESSION) and isset($_SESSION['username'])) {
    $boolLoggedIn = true;
    $currentUser = $_SESSION['username'];
}
else{
    header("location ../index.php");
}
$logout = "../logout/logout.php?username=$currentUser";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dassboard-<?php echo $currentUser;?></title>
    <?php
    require "../partials/link.php";
    ?>
    <link rel="stylesheet" href="../static/css/profile.css">
    <!-- <link rel="stylesheet" href="../static/css/profileNavCss.css"> -->
    <style>
        .active {
            visibility: hidden;
        }
        
        button{
  position: absolute;
  right: 13.5%;
  top: 22%;
  margin: 0 !important;
  background-color: var(--main-color) !important;
  border-color: var(--main-color) !important;
}
        small{
  position: absolute;
  right: 11%;
  top: 30%;
  margin: 0 !important;
  color: var(--dark-one) !important;
}

    </style>
    <link rel="stylesheet" href="../static/css/style.css">

  
</head>

<body>
    <?php
    require "../partials/nav.php";
    ?>
    <!-- <img src="../static/img/logo.png" class="logo" alt=""> -->
    <div class="action-profile">
        <div class="profile" onmouseover="menuToggle();">
            <?php

            require "../userimages/profileImagefetch.php";
            echo $profilepic;
            

            ?>
        </div>
        <div class="menu">
            <?php
            echo "
            <h3>$currentUser<br>
            </h3>
            "
            ?>
            <!-- <span> $currentUser </span> -->
            <ul>
                <li>
                    <div class="space-icons"><i class="fa fa-light fa-user"></i></div><a href="../my profile/myprofile.php"> My profile</a>
                </li>
                <li>
                    <div class="space-icons"><i class="fa fas fa-edit"></i></div><a href="../edit profile for user/editprofile.php"> Edit profile</a>
                </li>
                <li>
                    <div class="space-icons"><i class="fa fa-circle-o-notch fa-spin fa fa-fw"></i></div><a href="../my policies/userpolicies.php">My policies</a>
                </li>
                <li>
                    <div class="space-icons"><i class="fa fa-solid fa-lock"></i></div><a href="../change password/passwordChange.php">Change password</a>
                </li>
                <li>
                    <div class="space-icons"><i class="fa fa-solid fa-question"></i></div><a href="../contact us/contactus.php"> Help</a>
                </li>
                <?php
                echo  "<li><div class='space-icons'><i class='fa fa-solid fa-sign-out'></i></div><a href='$logout'>Logout</a></li>
                    "; ?>
            </ul>
        </div>
    </div>
       
    <?php 
    date_default_timezone_set('Asia/Calcutta');

        $Hour = date('G');

        if ( $Hour >= 5 && $Hour <= 11 ) {
            $greeting ="Good Morning";
        } else if ( $Hour >= 12 && $Hour <= 18 ) {
            $greeting ="Good Afternoon";
        } else if ( $Hour >= 19 || $Hour <= 4 ) {
            $greeting ="Good Evening";
        }
       $sql = "SELECT * FROM `appliedpolicy` Where `username`='$currentUser' and `action` = 0";
       $result = mysqli_query($conn,$sql);
       $aff = mysqli_affected_rows($conn);
       if($aff>0){  
      $button="<a href='../claim/invoice.php'><button class='btn btn-warning'>Email Invoice</button></a>";
      echo "<small> Click to get soft copy with  current<br> policy details to your email.</small> 
      $button";}
      
      echo "<h2 style='margin-left:15%; font-weight:500;' class='tittle-sm'> $greeting&nbsp, $currentUser</h2>";
    echo "$policyCardBlock";
    echo "$payments";

    if ($boolLoggedIn) {
        $sql = "SELECT * FROM `alluser` Where username ='$currentUser'";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_object($result);
        $image = $data->{"_image"};
    }
    $email= $_SESSION['email'];
    if(empty($image)){
    $sql = mysqli_query($conn, "UPDATE users SET img = 'userdefault.jpg' WHERE email = '{$email}'");}
    else{
    $sql = mysqli_query($conn, "UPDATE users SET img = '{$image}' WHERE email = '{$email}'");
    }
    if (isset($_GET) and isset($_GET['id'])){
    $id=$_GET['id'];
    $sql = "SELECT * FROM `appliedpolicy`  WHERE `id`=$id";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_object($result);
    $first_name=$data->{"first_name"};
    $last_name=$data->{"last_name"};
    $email=$data->{"email"};
    $policyPremium=$data->{"p_premium"};
    $phone=$data->{"phone"};
    $unique_id=$data->{"unique_id"};
    $userName=$data->{"username"};
    date_default_timezone_set('UTC');
        $date = date("Y-m-d");
        $next_date= date('Y/m/d',strtotime('+30 days',strtotime($date)));
        $time = date("H:i:s");
     
    $sql = "INSERT INTO `payments` (`first_name`, `last_name`, `email`,`paid`,`phone`,`unique_id`,`username`,`next_date`,`date`,`time`,`id_pol`,`status`) VALUES ('$first_name','$last_name','$email','$policyPremium','$phone', '$unique_id','$currentUser','$next_date','$date','$time','$id','paid')";
    $result = mysqli_query($conn, $sql);

    if (isset($_GET) and isset($_GET['id'])){
        $id=$_GET['id'];
        date_default_timezone_set('UTC');
        $date = date("Y-m-d");
        $next_date= date('Y/m/d',strtotime('+30 days',strtotime($date)));        
        $sql2 = "UPDATE `payments` SET `next_date`='$next_date' ,`date`='$date' WHERE `id_pol`=$id ";
        $result = mysqli_query($conn, $sql2);

}
    }

    ?>

    <script>
        function menuToggle() {
            const togglemenu = document.querySelector('.menu');
            togglemenu.classList.toggle('open')
        }
    </script>
</body>

</html>
