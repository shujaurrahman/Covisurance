<?php
require "../partials/conn.php";
$boolAdminLoggedIn = false;
session_start();
if(isset($_SESSION) and isset($_SESSION["adminusername"])){  
	$currentName=$_SESSION["adminusername"];
    $boolAdminLoggedIn = true;   
}
  
$row = "";

$sql = "SELECT * FROM `alluser`";
$result = mysqli_query($conn, $sql);

while($data = mysqli_fetch_object($result)){
$firstName = $data->{"first_name"};
// $firstName = mysqli_real_escape_string($conn,$firstName);
// $firstName = stripcslashes($firstName);
// $firstName = htmlspecialchars($firstName);
$lastName = $data->{"last_name"};
$userName = $data->{"username"};
$userEmail = $data->{"email"};
$phoneNumber = $data->{"phonenumber"};
$annualIncome = $data->{"annual_income"};
$adress = $data->{"_address"};
$city = $data->{"city"};
$country = $data->{"country"};
$pancard = $data->{"pancard"};
$birthday = $data->{"birthday"};
$date = $data->{"date"};
$image = $data->{"_image"};
$newDate = date("j F Y", strtotime($date));
$newTime = date("l, g:i a", strtotime($date));
if(empty($image)){
	$profilepic="<img src='../static/img/default.jpg' alt='Image Not uploaded'>
	<p>User haven't uploaded profile pic yet.</p>";

}
else{
$profilepic="<img src='../userimages/$image' alt='Image Not uploaded'>";
}
$row.=  "
<tr class='alert' role='alert'>
  <td>$firstName</td>
  <td>$lastName</td>
  <td>$userName</td>
  <td>$userEmail</td>
  <td>$phoneNumber</td>
  <td>$birthday</td>
  <td>$pancard</td>
  <td>$adress.$city.$country</td>
  <td>$newDate at $newTime</td>
  <td>$profilepic</td>

</tr>";

}



?>

<!doctype html>
<html lang="en">
  <head>
  	<title>All Registered users </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	</head>
	<body style="background-color:#f3f3f3 ;">
        <?php
        require "./nav.php";
        ?>
			<div style="color:#00ADB5;" class="row justify-content-center">
				<div class="col-md-6 text-center mt-5 mb-3">
					<h2 class="heading-section">All Registered Users</h2>
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
						      <th>DOB</th>
						      <th>Pancard</th>
						      <th>Address </th>
						      <th>Date of Registration</th>
						      <th>Profile pic</th>
						    </tr>
						  </thead>


						  <tbody>

                        <?php 
                        echo $row;
                            ?>

						  </tbody>
						</table>
					</div>
				</div>
			</div>


	</body>
</html>

