<?php
require "../partials/conn.php";
$boolAdminLoggedIn = false;
session_start();
if(isset($_SESSION) and isset($_SESSION["adminusername"])){  
	$currentName=$_SESSION["adminusername"];
    $boolAdminLoggedIn = true;   
}



date_default_timezone_set('Asia/Calcutta');

$Hour = date('G');

if ( $Hour >= 5 && $Hour <= 11 ) {
    $greeting ="Good Morning";
} else if ( $Hour >= 12 && $Hour <= 18 ) {
    $greeting ="Good Afternoon";
} else if ( $Hour >= 19 || $Hour <= 4 ) {
    $greeting ="Good Evening";
}

$viewButton="";
$row="";

$sql = "SELECT * FROM `admins` ORDER BY s_no";
$result = mysqli_query($conn, $sql);
while($data = mysqli_fetch_object($result)){
$id = $data->{"s_no"};
$userName = $data->{"username"};
$Name = $data->{"name"};
$Category = $data->{"category"};
if(strcmp($userName,'AdminShuja')){
    $viewButton="<button type='button' class='btn btn-outline-info mx-2 my-2' onclick=window.location.href='./admins.php?delAdmin=$id'>Remove</button>";
}
else{
    $viewButton="<button type='button' class='btn btn-primary  mx-2 my-2' onclick=window.location.href='./superadmin.php'>VIEW SUPER ADMIN</button>";
}
$row.=  "
<tr class='alert' role='alert'>
  <td>$Name</td>
  <td>$userName</td>
  <td>$Category</td>.
  <td>$viewButton</td>
</tr>";
}
    $alertMssg = "";
    $alertError = "";
    $alertDisplay = "none";
if(isset($_GET) and isset($_GET['delAdmin'])){
$id= $_GET['delAdmin'];
$sql = "DELETE FROM `admins`  WHERE `s_no` = '$id'";
$result = mysqli_query($conn,$sql);
if($result){
    $alertMssg = "A Sub Admin Was Removed.";
    $alertError = "class = 'error'";
    $alertDisplay = "block";
    echo "<p $alertError style='display: $alertDisplay;'>$alertMssg</p>
    ";

}}

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>All Admins</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../static/css/claimopensource.css">
<style>
        .error {
        color: black;
        font-size: 15px;
        font-weight: 600;
        background: #71C9CE;
        width: 100%;
        text-align: center;
        padding: 1rem;
        margin: 0 0 20px 0;
    }
    </style>

	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	</head>
	<body style="background-color:#f3f3f3 ;">
        <?php
        require "./nav.php";
        ?>
			<div style="color:#00ADB5;" class="row justify-content-center">
				<div class="col-md-6 text-center mt-5 mb-3">
					<h2 class="heading-section">All Admins</h2>
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table">
						  <thead class="thead-dark">
						    <tr>
						      <th>Name</th>
						      <th>Username</th>
						      <th>Category</th>
						      <th>Remove</th>

						    </tr>
						  </thead>


						  <tbody>

                        <?php 
                        echo $row;
                            ?>

						  </tbody>
						</table>
					</div>
                            <br><hr style="color:black;border:5px;">
                            <?php
                            $sql = "SELECT * FROM `admins` WHERE `username`='$currentName'";
                            $result = mysqli_query($conn, $sql);
                            $data = mysqli_fetch_object($result);
                            $YouuserName = $data->{"username"};
                            $YouName = $data->{"name"};
                            $YouCategory = $data->{"category"};
                            ?>
                        <div class="table-wrap">
						<table class="table">
					        <h4 class="heading-section"><?php echo $greeting."&nbsp".$currentName;?></h4>    
						  <tbody>
                          <?php
                            echo "
                                <tr class='alert' role='alert'>
                                <td>Your Name: $YouName</td>
                                <td>Your Username: $YouuserName</td>
                                <td>Your Category: $YouCategory</td>.
                                </tr>";
                            ?>

						  </tbody>
						</table>
					</div>
                    
				</div>
			</div>
	</body>
</html>

