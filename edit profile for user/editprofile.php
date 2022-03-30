<?php
require "../partials/conn.php";
// $website = "";
$Msgdisplay = "Update your personal Details,Email should be unique..";
$cancelButton = "$website/user profile/profile.php";
$updateButton = "$website/my profile/myprofile.php";

session_start();
$boolLoggedIn = false;
if (isset($_SESSION) and isset($_SESSION['username'])) {
	$currentUser = $_SESSION['username'];
	$boolLoggedIn = true;
} else {
	//   header("Location: ../index.php");
}
$submit = false;
if ($boolLoggedIn) {
	$sql = "SELECT * FROM `alluser` Where username ='$currentUser'";
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_object($result);
	$DfirstName = $data->{"first_name"};
	$DlastName = $data->{"last_name"};
	$DuserName = $data->{"username"};
	$DuserEmail = $data->{"email"};
	$DphoneNumber = $data->{"phonenumber"};
	$DannualIncome = $data->{"annual_income"};
	$Dadress = $data->{"_address"};
	$Dcity = $data->{"city"};
	$Dcountry = $data->{"country"};
	$Dpancard = $data->{"pancard"};
	$Dbirthday = $data->{"birthday"};
	$Dimage=$data->{"_image"};
}
// if(empty($Dimage)){
// if(isset($_POST['submit'])){

// 	$querry="INSERT INTO $tableName (_image) VALUES ('$image') WHERE username='$currentUser'";
// 	$processImage=mysqli_query($conn,$querry);
// 	echo $processImage;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$submit = true;
	$firstName = $_POST['first_name'];
	$lastName = $_POST['last_name'];
	$phoneNumber = $_POST['phonenumber'];
	$userEmail = $_POST['email'];
	$birthday = $_POST['birthday'];
	$pancard = $_POST['pancard'];
	$annualIncome = $_POST['annual_income'];
	$city = $_POST['city'];
	$country = $_POST['country'];
	$adress = $_POST['address'];


	//=======================================


    //=============old==================
	/*
	$image=$_FILES['userImage']['name'];
	 $path='../userimages/';
	 */
	 //============================
	 
	//========================testing============================


	//code for unique image name so that diff user can upload same image 
	$image = $_FILES["userImage"]["name"]; //img name
	$tmpName = $_FILES["userImage"]["tmp_name"]; //temp server
	$path='../userimages/'; //path to which image is uploaded
	// $imgExplode = explode('.',$image); //appension of username to image
	$newImgName = $currentUser.$image; //new image src



	      //update doesnot occure if same img is chosan to update..
	 
	if($Dimage == $newImgName){
		
		$Msgdisplay= "This is your current profile picture, Please choose different picture. ";
	}


          ///condition that actually executes updation 

	else{
	$sql = "UPDATE `alluser` SET first_name='$firstName',last_name='$lastName',
	email='$userEmail',birthday='$birthday',phonenumber='$phoneNumber',pancard='$pancard',annual_income='$annualIncome',_address='$adress',
	city='$city',country='$country',_image='$newImgName' WHERE username ='$currentUser'";
	$result = mysqli_query($conn, $sql);
	if($result){

		//old
		// move_uploaded_file($_FILES['userImage']['tmp_name'],$path.$currentUser.basename($_FILES["userImage"]["name"]));

		//when cond. fullfilled deletes old image
		unlink($path.$Dimage);
        


		//This code updates new picture with username appended at begning 
		//so that imag is unique for every user and diff user can update same image
		move_uploaded_file($tmpName,$path.$newImgName);

	}
	else{
		$Msgdisplay= "Image not stored,error occured";
	}
	echo "
	<script>
	setInterval(() => {
	  window.location = '../my profile/myprofile.php';
	}, 2200);
	</script>
	";
	if ($result) {
		$Msgdisplay = "Your details are updated successfully, redirecting you..... to profile";
	}
}
}
// $aff = mysqli_affected_rows($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Edit profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../static/css/edit-profile.css">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="../static/css/style.css">

	<style>
		a,
		a:hover {
			text-decoration: none !important;
			color: white;
		}

		#cancel:hover {
			color: white;
			background-color: red !important;
		}

		.card {
			max-width: 100% !important;
			max-height: 93% !important;
			text-align: left !important;
		}

		input[type='file'] {

			background-color: #00ADB5;
			color: white;
			left: 18px;
			padding: 8px 17px;
			font-size: 18px;
			outline: none;
			width: 367px;
		}

		input[type='file']:hover {

			background-color: #E3FDFD;
			color: black;
		}

		.btn {
			padding: 0.50rem 1rem !important;
		}

		/* label{
			height: 59px;
			width: 210px;
			background-color: #00ADB5;
			color: white;
			position: absolute;
			left: 10px;
			padding: 15px 25px;
			align-items: center;
			justify-content: center;
			margin-left: 1.5rem;
			font-size: 20px;
			display: flex;
		} */
	</style>
</head>


<body>
	<?php
	require "../partials/nav.php";
	?>
	<div class="container">
		<div class="row gutters">
			<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
				<div class="card h-100">
					<div class="card-body">
						<div class="account-settings">
							<div class="user-profile">
								<div class="user-avatar">
									<?php

									require "../userimages/profileImagefetch.php";
									echo $profilepic;
									
								echo"
								</div>
								<h5 class='user-name'>$currentUser</h5>
								<h6 class='user-email'>$DuserEmail</h6>";
								?>
							</div>
							<div class="about">
								<h5>Upload profile picture</h5>

								<p>
									<?php echo "
                 <form action='editprofile.php' method='POST' enctype='multipart/form-data'>

				 <input type='file' name='userImage' class='image' accept='image/*' required>

				</p>
			</div>
		</div>
	</div>
</div>
</div>
<div class='col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12'>
<div class='card h-100'>

	<div class='card-body'>
		<div class='row gutters'>
			<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
				<h6 class='mb-2 text-primary'>
				$Msgdisplay</h6>
			</div>
			<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12'>
				<div class='form-group'>
				<label  for='fullName'>First Name</label>
				<input name='first_name' type='text' class='form-control' id='fullName' value='$DfirstName' required>
				</div>
			</div>
			<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12'>
				<div class='form-group'>
					<label  for='eMail'>Last Name</label>
					<input name='last_name' type='text' class='form-control' id='eMail' required value='$DlastName'>
				</div>
			</div>
			<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12'>
				<div class='form-group'>
					<label  for='phone'>Phone </label>
					<input name='phonenumber' type='number' class='form-control' id='phone' required value='$DphoneNumber'>
				</div>
			</div>
			<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12'>
				<div class='form-group'>
					<label  for='website'>Email</label>
					<input name='email' type='email' class='form-control' id='website' required value='$DuserEmail'>
				</div>
			</div>
			<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12'>
				<div class='form-group'>
					<label  for='website'>Birthday </label>
					<input name='birthday' type='date' class='form-control' id='website' required value='$Dbirthday'>
				</div>
			</div>
			<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12'>
				<div class='form-group'>
					<label  for='website'>PAN CARD </label>
					<input name='pancard' type='text' class='form-control' id='website' required value='$Dpancard'>
				</div>
			</div>
		</div>
		<div class='row gutters'>
		    <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12'>
				<div class='form-group'>
					<label  for='zIp'>Address </label>
					<input name='address' type='text' class='form-control' id='zIp' required value='$Dadress'>
				</div>
			</div>
			<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12'>
				<div class='form-group'>
					<label  for='Street'>Annual Income</label>
					<input name='annual_income' type='text' class='form-control' id='Street' required value='$DannualIncome'>
				</div>
			</div>
			<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12'>
				<div class='form-group'>
					<label  for='ciTy'>City</label>
					<input name='city' type='text' class='form-control' id='ciTy' required value='$Dcity'>
				</div>
			</div>
			<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12'>
				<div class='form-group'>
					<label  for='sTate'>Country</label>
					<input name='country' type='text' class='form-control' id='sTate' required value='$Dcountry'>
				</div>
			</div>

		</div>
		<div class='row gutters'>
			<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
				<div class='text-right'>

					<button type='button' id='cancel' class='btn btn-secondary'>
					<a href='$cancelButton'>
					Cancel
					</a>
					</button>
					<button type='submit' id='submit' name='submit' class='btn btn-primary'>
					<a href'$updateButton'>Update
					</a>
					</button>

				
				</div>
			</div>
		</div>
	</div>
</form>";
									?>
							</div>
						</div>
					</div>
				</div>

				<script type="text/javascript">

				</script>
</body>

</html>