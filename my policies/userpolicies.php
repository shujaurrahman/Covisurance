<?php
require "../partials/conn.php";
if (isset($_SESSION) and isset($_SESSION['username'])) {
    $boolLoggedIn = true;
    $currentUser = $_SESSION['username'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Policies
    </title>
    <?php
    require "../partials/link.php";
    ?>
    <link rel="stylesheet" href="../static/css/profile.css">
    <!-- <link rel="stylesheet" href="../static/css/profileNavCss.css"> -->
    <link rel="stylesheet" href="../static/css/style.css">

</head>

<body>
    <?php
    require "../partials/nav.php";
    ?>
    <!-- <img src="../static/img/logo.png" class="logo" alt=""> -->
    <?php   
    echo "$userpolicyCardBlock";
    ?>

</body>

</html>