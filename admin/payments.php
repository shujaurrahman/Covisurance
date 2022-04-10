<?php
require "../partials/conn.php";
$boolAdminLoggedIn = false;
session_start();
if(isset($_SESSION) and isset($_SESSION["adminusername"])){  
	$currentName=$_SESSION["adminusername"];
    $boolAdminLoggedIn = true;   
}
  
$row = "";

$sql = "SELECT * FROM `appliedpolicy` WHERE `action`='0' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

while($data = mysqli_fetch_object($result)){
$firstName = $data->{"first_name"};
$lastName = $data->{"last_name"};
$userName = $data->{"username"};
$userEmail = $data->{"email"};
// $phoneNumber = $data->{"phonenumber"};
$pol_name = $data->{"p_name"};
$pol_cov = $data->{"p_coverage"};
$date = $data->{"date"};
$newDate = date("j F Y", strtotime($date));
$newTime = date("l, g:i a", strtotime($date));
$sql2 = "SELECT * FROM `payments` WHERE `username`='$userName'";
$resultSql2 = mysqli_query($conn, $sql2);
$data = mysqli_fetch_assoc($resultSql2);
$last_date=$data["date"];
$time=$data["time"];
$install=$data["paid"];
$due_date=$data["next_date"];
$status=$data["status"];
$unique_id=$data["unique_id"];
$sql = "SELECT * FROM `alluser` WHERE `username`='$userName'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_object($result);
$phone=$data->{'phonenumber'};
$ph="<button type='button' class='btn btn-light'>Ph:$phone</button>";
if(!strcmp($status,'unpaid'))
{
	$Action="<button type='submit' onclick='sendEmail();' class='btn btn-warning'>Remind</button>";
}
else{
	$Action="<button type='button' class='btn btn-light'>Paid</button>";
}
echo "
<script>
function sendEmail() 
{
    window.location = 'mailto:$userEmail?subject=Your Payments is Due';
}
</script>
";
$row.=  "
<tr class='alert' role='alert'>
  <td>$firstName</td>
  <td>$lastName</td>
  <td>$userName</td>
  <td>$userEmail</td>
  <td>$pol_name</td>
  <td>$pol_cov</td>
  <td>Rs. $install</td>
  <td>$last_date $time</td>
  <td>$due_date</td>
  <td>$status</td>
  <td>Mail: $Action <br><br>
      $ph
       </td>
</tr>";

}



?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Client Payments</title>
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
					<h2 class="heading-section">Running Policy Payments</h2>
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
						      <th>Policy Name</th>
						      <th>Policy coverage</th>
						      <th>Premium</th>
						      <th>Last Payment</th>
						      <th>Next Payment Date</th>
						      <th>Payment Status</th>
						      <th>Action</th>
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

