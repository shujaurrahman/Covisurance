<?php
require "../partials/conn.php";
$boolAdminLoggedIn = false;
session_start();
if(isset($_SESSION) and isset($_SESSION["adminusername"])){  
	$currentName=$_SESSION["adminusername"];
    $boolAdminLoggedIn = true;   
}

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>All Admins</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../static/css/claimopensource.css">

	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	</head>
	<body style="background-color:#f3f3f3 ;">
        <?php
        require "./nav.php";
        ?>
			<div style="color:#00ADB5;" class="row justify-content-center">
				<div class="col-md-6 text-center mt-5 mb-3">
				<div class="col-md-12">
				</div>
					<h5 class="heading-section" style="color:black;">More About </h5>
					<h3 class="heading-section" style="color:Red;">Super Admin</h3>
                            <div class="admin">
                            <p class="admin-info">Name: Shuja Ur Rahman</p>
                            <p class="admin-info">UserName: AdminShuja</p>
                            <p class="admin-info">Profile Picture</p>
                            <img src="../static/img/admin.jpg" style="width:40%;height:40%;" alt="">

                            <p class="admin-info">Website Designed and Coded By Shuja ur Rahman(SUPER ADMIN)</p>
                            <p class="admin-info">Faculty Number : 2019CAB009</p>
                            <p class="admin-info">Supervisor: Dr Ziyyyauddin </p>
                            <p class="admin-info">Copyright @2022 All rights reserved.</p>
                        </div>
                        <div class="row">
			</div>
			</div>
			</div>
	</body>
</html>

