<?php

require "../partials/conn.php";

$boolAdminLoggedIn = false;
session_start();
if(isset($_SESSION) and isset($_SESSION["adminusername"])){  
	$currentName=$_SESSION["adminusername"];
    $boolAdminLoggedIn = true;   
}



$row = "";

$fetch=false;
$sql = "SELECT * FROM `appliedpolicy` WHERE `action`='3' ORDER BY id DESC ";
$result = mysqli_query($conn, $sql);

$aff = mysqli_affected_rows($conn);
if($aff<1){
    $fetch = false;
}
else{
    $fetch = true;
}
if ($fetch) {
while($data = mysqli_fetch_object($result)){
$firstName = $data->{"first_name"};
$lastName = $data->{"last_name"};
$userName = $data->{"username"};
$userEmail = $data->{"email"};
$phoneNumber = $data->{"phone"};
$pancard = $data->{"pancard"};
$date = $data->{"date"};
// $action=$data->{"action"};
$uniqueId=$data->{'unique_id'};
$newDate = date("j F Y", strtotime($date));
$newTime = date("l, g:i a", strtotime($date));
$id=$data->{"id"};
// if(empty($image)){
// 	$profilepic="<img src='../static/img/default.jpg' alt='Image Not uploaded'>
// 	<p>User haven't uploaded profile pic yet.</p>";

// }
// else{
// $profilepic="<img src='../userimages/$image' alt='Image Not uploaded'>";
// }

$viewButton="<button type='button' class='btn btn-outline-info mx-2 my-2' onclick=window.location.href='./userpage.php?id=$id'>View</button>";
$deleteButton="<button type='button' class='btn btn-outline-danger mx-2 my-2' onClick='appDel($id)'>Delete</button>";


$row.=  "
<tr class='alert' role='alert'>
  <td>$firstName</td>
  <td>$lastName</td>
  <td>$userName</td>
  <td>$userEmail</td>
  <td>$phoneNumber</td>
  <td>$pancard</td>
  <td>$uniqueId</td>
  <td>$newDate at $newTime</td>
  <td>$viewButton $deleteButton</td>


</tr>";

}}


    // for Deletion of the Application javascript gets this when admin click on del button which activates 
// delapplication function 
$alerMssg = "";
$alertError = "";
$alertDisplay = "none";


if(isset($_GET) and isset($_GET['delapp'])){
$id= $_GET['delapp'];
$sql = "DELETE FROM `appliedpolicy`  WHERE `id` = '$id'";
$result = mysqli_query($conn,$sql);
if($_GET['delapp']){
    $alertMssg = "The Application has been Deleted.";
    $alertError = "class = 'error'";
    $alertDisplay = "block";
    echo "<p $alertError style='display: $alertDisplay;'>$alertMssg</p>";
}
}




?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Disapproved Application</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
	</head>
	<body style="background-color:#f3f3f3 ;">
        <?php
        require "./nav.php";
        ?>
			<div style="color:#00ADB5;" class="row justify-content-center">
				<div class="col-md-6 text-center mt-5 mb-3">
					<h2 class="heading-section">Disapproved Applications</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table">
						  <thead class="thead-dark">
						    <tr>
						      <th>First Name</th>
						      <th>Last Name</th>
						      <th>Username</th>
						      <th>Email</th>
						      <th>Phone Number</th>
						      <th>Pancard</th>
						      <th>Unique Insurance ID</th>
						      <th>Applied on</th>
						      <th>Delete Application</th>

						    </tr>
						  </thead>


						  <tbody>

              <?php 
                        if($fetch){
                        echo $row;
                        }
                        else{
                          $alertMssg="No disapproved application data available. You haven't disapproved any application yet";
                          $alertError = "class = 'error'";
                          $alertDisplay = "block";
                          echo "<p $alertError style='display: $alertDisplay;'>$alertMssg</p>";
                        }
                            ?>

						  </tbody>
						</table>
					</div>
				</div>
			</div>

<script src="../static/js/admin.js"></script>
	</body>
</html>

