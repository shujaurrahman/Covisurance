<?php
require "../partials/conn.php";

$boolAdminLoggedIn = false;
session_start();
if(isset($_SESSION) and isset($_SESSION["adminusername"])){  
	$currentName=$_SESSION["adminusername"];
    $boolAdminLoggedIn = true;   
}

$row = "";

$sql = "SELECT * FROM `visitors`";
$result = mysqli_query($conn, $sql);
while($data = mysqli_fetch_object($result)){
$browser = $data->{"browser"};
$ip = $data->{"ip"};
$country = $data->{"county"};
$city= $data->{"city"};
$region = $data->{"region"};
$latitude = $data->{"latitude"};
$longitude = $data->{"longitude"};
$date = $data->{"date"};
$time = $data->{"time"};
$count = $data->{"count"};

$row.=  "
<tr class='alert' role='alert'>
  <td>$browser</td>
  <td>$ip</td>
  <td>$country</td>
  <td>$city</td>
  <td>$region</td>
  <td>$latitude</td>
  <td>$longitude</td>
  <td>$date</td>
  <td>$time</td>
  <td>$count</td>

</tr>";

}



?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Viewers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	</head>

    <button style="position:relative !important; top:0; right:0;background-color:#00ADB5; color:#fff;" onclick="window.location.href='./home.php'">Back to Admin Panel</button>

	<body style="background-color:#f3f3f3 ;">
			<div style="color:#00ADB5;" class="row justify-content-center">
				<div class="col-md-6 text-center mt-5 mb-3">
					<h4 class="heading-section">Website Visitors Details</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table">
						  <thead class="thead-dark">
						    <tr>
						      <th>Browser</th>
						      <th>IP Address</th>
						      <th>Country</th>
						      <th>city</th>
						      <th>Region </th>
						      <th>latitude</th>
						      <th>longitude</th>
						      <th>Date  </th>
						      <th>Time</th>
						      <th>View Count</th>
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

