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
    <title>Dassboard-user</title>
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
      $button="<a href='../claim/invoice.php'><button class='btn btn-warning'>Email Invoice</button></a>";
      echo "<small> Click to get soft copy with  current<br> policy details to your email.</small> 
      $button";
      echo "<h2 style='margin-left:15%; font-weight:500;' class='tittle-sm'> Welcome, $currentUser</h2>";
    echo "$policyCardBlock";
    echo "$payments";
    ?>

    <script>
        function menuToggle() {
            const togglemenu = document.querySelector('.menu');
            togglemenu.classList.toggle('open')
        }
    </script>
</body>

</html>