<?php

require "../partials/conn.php";



$fetch = false;
$policyCard ="";
$sql = "SELECT * FROM `policycards` ORDER BY id DESC;";
$result = mysqli_query($conn,$sql);
$aff = mysqli_affected_rows($conn);
if($aff<1){
    $fetch = false;
}
else{
    $fetch = true;
}

if ($fetch) {

    while($data = mysqli_fetch_object($result)){
        $id=$data->{"id"};
        $policyCat = $data->{'policycat'};
        $policyName = $data->{'policyname'};
        $policyDetails = $data->{'policydetails'};
        $policyPremium = $data->{'policypremium'};
        $policyCoverage = $data->{'policycoverage'};
        $date = $data->{'date'};
        $newDate = date("j-F Y", strtotime($date));
        $newTime = date("l, g:i a", strtotime($date));

		$random=rand(1,15);
          $policyImage="../static/img/$random.svg";
        //the actual policy card ,note all cards are fetched from the db which are uploaded by admin
        //while loops iterates all the cards to the user profile if logged in else on index page 
        $policyCard .= " <div class='card-wrap'>
     <div class='card'>
     <div class='card-content z-index'>
     <img src='$policyImage' alt'image'>
    <p class='title-sm' style='font-size: 18px; margin:15px 10px'>$policyCat</p>
    <h3 class='title-sm'>$policyName</h3>
    <p class='text'>
    $policyDetails
    </p>
    <p class='title-sm' style='font-size: 17px; margin:10px'>Premium $policyPremium</p>
    <p class='title-sm' style='font-size: 15px; margin:15px 10px'> Cover upto $policyCoverage lakhs</p>


	<button  type='submit' class='btn small' onClick='policyDel($id)'>Delete</button>
    <p class='title-sm' style='font-size: 15px; margin:15px 10px;'> Posted on $newDate</p>
    <p class='title-sm' style='font-size: 15px; margin:15px 10px;'> at $newTime</p>





  </div>
</div>
</div>";
}

}

// ======================================policy cards data variable ================================




$policyCardBlock="<section class='services section' id='services'>
<div class='container'>
  <div class='section-header'>
    <h3 class='title' data-title='All'>Insurance Policies</h3>
    <p class='text'>
      All the policies that you have posted that are live on the website.
    </p>
  </div>

  <div class='cards'>
     $policyCard
  </div>
</div>
</section>";


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete page</title>
	<link rel="stylesheet" href="../static/css/style.css">
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
<body>
<?php 
		require "./nav.php";
		if($fetch){
			        // for Deletion of the policy javascripst gets this when admin click on del button which activates 
		// delpolicy function 
		$alerMssg = "";
        $alertError = "";
        $alertDisplay = "none";


        if(isset($_GET) and isset($_GET['delpolicy'])){
            $id= $_GET['delpolicy'];
                $sql = "DELETE FROM `policycards`  WHERE `id` = '$id'";
                $result = mysqli_query($conn,$sql);
                if($_GET['delpolicy']){
					$alertMssg = "The Policy Once Deleted Will be Erased.Action Can not be reversed Now. ";
					$alertError = "class = 'error'";
					$alertDisplay = "block";
					echo "<p $alertError style='display: $alertDisplay;'>$alertMssg</p>";
				}
            }

	      echo $policyCardBlock;
		}
		else{
			$policyCardBlock="<section class='services section' id='services'>
			<div class='container'>
			<div class='section-header'>
				<h3 class='title' data-title='OOPS NO'>Insurance Policies</h3>
				<p class='text'>
				You have not posted any policy in the mean time
				No policy is live on the website.
				Add Now, Navigate to add a policy section.
				</p>
			</div>
			</div>
			</section>";
			echo $policyCardBlock;
		}
		?>

<script src="../static/js/admin.js"> </script>
</body>
</html>