



<?php
$homePage = "../index.php";
$editprofile = "../edit profile for user/editprofile.php";

require "../partials/conn.php";

session_start();
$boolLoggedIn = false;
if (isset($_SESSION) and isset($_SESSION['username'])) {
    $currentUser = $_SESSION['username'];
    $boolLoggedIn = true;
} else {
    header("Location: ../index.php");
}





// ===============================fetching data from alluser table for current logged in user 
if ($boolLoggedIn) {
    $sql = "SELECT * FROM `alluser` Where `username` = '$currentUser'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_object($result);
    $firstName = $data->{"first_name"};

	$firstName = mysqli_real_escape_string($conn,$firstName);
	$firstName = stripcslashes($firstName);
    $firstName = htmlspecialchars($firstName);

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
}


$fetch = false;
$userpolicyCard ="";
$sql = "SELECT * FROM `appliedpolicy` Where `username`='$currentUser'";
$result = mysqli_query($conn,$sql);
$aff = mysqli_affected_rows($conn);
if($aff<1){
    $uniqueId="";
    $fetch = false;
    $current="You havn't applied yet!";
    $p_name="";
    $p_coverage="";
    $status="Claim status";
    $details="You need to apply to claim any policy";
    $claimcolumn=" <div class='bio-desk'>
    <h4 class='green'> Claim</h4>
    <h4>You can't claim</h4>
     </div>";
     $claimcolumnstatus="
     <div class='bio-desk'>
     <h4 class='purple'>Notification</h4>
     <p>Not Started</p>
     <p>Oops! You haven't applied yet.</p>
 </div>
     
     ";
     
}
else{
    $fetch = true;
}


if($fetch){
    $data = mysqli_fetch_object($result);
    $action=$data->{'action'};
    $policyName = $data->{'p_name'};
    $policyCoverage = $data->{'p_coverage'};
    $uniqueId=$data->{"unique_id"};


    if($action==0){
        $current="Your Policy";
        $p_name="$policyName";
        $p_coverage="$policyCoverage";
        

        $status=" Claim Status ";
        $details="You have Not Claimed this policy yet.";


        $claimcolumn=" <div class='bio-desk'>
        <h4 class='green'>Claim Now</h4>
        <button type='button' class='btn btn-primary'><a href='../claim/claim.php'>Claim</a></button>
         </div>";


        $claimcolumnstatus="
        <div class='bio-desk'>
        <h4 class='purple'> Notification</h4>
        <p>Not Started</p>
        <p>After you claim you will be Notified here for next step .</p>
    </div>
        
        ";

      }
      if($action==1){
        $current="Your Policy";
        $p_name="$policyName";
        $p_coverage="$policyCoverage";


        $status="Claim Status";
        $details="You have Claimed this policy,wait for admin approval.";
        $claimcolumn=" <div class='bio-desk'>
                         <h4 class='green'>Claimed </h4>
                          <h4>You have claimed $policyName</h4>
                          </div>";
                          $claimcolumnstatus="
                          <div class='bio-desk'>
                          <h4 class='purple'>Notification</h4>
                          <p>Verfication Process Started</p>
                          <p>Admin verifying your details.</p>
                      </div>
                          
                          ";
      }
      if($action==2){
        $current="Your  Policy";
        $p_name="$policyName";
        $p_coverage="$policyCoverage";

        $status="Claim Status";
        $details=" Congratulations,Policy Approved.
        Admin will call you for bank details.";

        $claimcolumnstatus=" <div class='bio-desk'>
                         <h4 class='green'>Notification</h4>
                         <h4>Claimed Approved for $policyName</h4>
                         <h4>Be in touch with admin </h4>
                         <h4>He will Contact you on the Number you provided. </h4>

                          </div>";
         $claimcolumn="
                          <div class='bio-desk'>
                          <h4 class='purple'>Claim</h4>
                          <p>Approved, Fund process started</p>
                      </div>
                          
                          ";
        
      }
      if($action==3){
        $current="Your Policy";
        $p_name="$policyName";
        $p_coverage="$policyCoverage";

        $status=" Dispproved by admin ";
        $details="Discrepancy found,Sorry! Your details didn't matach with our records.";
        
        
        $claimcolumn=" <div class='bio-desk'>
                         <h4 class='green'>Claim denied</h4>
                          <h4>You cannot apply for claim </h4>
                          <h4>Contact admin for more</h4>

                          </div>";
         $claimcolumnstatus="
                          <div class='bio-desk'>
                          <h4 class='purple'>Notification</h4>
                          <p>Reason,Your records didnot matched with our system.</p>
                          <p>If any confusion Contact us.</p>

                      </div>
                          
                          ";
        
      }

}
//policy status database (applied Policies)=========================================================






// ================================condition that changes UPDATE button COLOR N TEXT  and makes theme dynamic at my profile 
// when new user comes it tell to update infor else if already updated info button changes===========
if ($boolLoggedIn) {

    $updateButton = '';
    if (empty($pancard) || empty($adress) || empty($city) || empty($country) || empty($annualIncome)) {
        $infoMessage = " <div class='bio-graph-heading'>
              $firstName $lastName, Please update your information
           </div>";
        $updateButton = "<li><a href='$editprofile' class='active' style='background-color: #f17e7e; color:black;'> <i class='fa fa-edit'></i> Update profile</a></li>";
    } else {
        $infoMessage = "<div class='bio-graph-heading'>
            $firstName $lastName, your personal details
         </div>";
        $updateButton = "<li><a href='$editprofile'> <i class='fa fa-edit'></i> Edit profile</a></li>";
    }
}
?>





<!-- html code starts form here===================================== -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>User profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../static/css/my-profile.css">
    <script src="https://kit.fontawesome.com/06edf57802.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="profile-nav col-md-3">
                <div class="panel">
                    <div class="user-heading round">
                        <a href="#">
                            <?php


//  from userimagesfetchphp code 
// =====================================================profile pic====================
                            require "../userimages/profileImagefetch.php";
                            echo $profilepic;

                            ?>
                        </a>
                        <?php
                        echo "
              <h1>$firstName $lastName</h1>
              <p>$userEmail</p>"
                        ?>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <?php
                        echo "<li><a href='$homePage'> <i class='fa fas fa-home'></i> Home page</a></li>            
                               $updateButton ";
                        ?>
                    </ul>
                </div>
            </div>
            <div class="profile-info col-md-9">
                <div class="panel">
                    <?php
                    echo $infoMessage;
                    ?>
                    <div class="panel-body bio-graph-info">
                        <div class="row">
                            <?php echo "
                  <div class='bio-row'>
                      <p><span>First name </span>:  &nbsp; $firstName</p>
                  </div>
                  <div class='bio-row'>
                      <p><span>Last name </span>  :&nbsp; $lastName</p>
                  </div>
                  <div class='bio-row'>
                    <p><span>Username</span>   :&nbsp;     $currentUser</p>
                </div>
                  <div class='bio-row'>
                      <p><span>Phone </span>:&nbsp;    $phoneNumber</p>
                  </div>
                  <div class='bio-row'>
                      <p><span>Email</span>:&nbsp; $userEmail</p>
                  </div>
                  <div class='bio-row'>
                      <p><span>Birthday</span>:&nbsp; $birthday</p>
                  </div>
                  <div class='bio-row'>
                      <p><span>Pan Card</span>:&nbsp;   $pancard</p>
                  </div>
                  <div class='bio-row'>
                      <p><span>Annual Income</span>:&nbsp;   $annualIncome</p>
                  </div>
                  <div class='bio-row'>
                      <p><span>Address </span>:&nbsp;  $adress</p>
                  </div>
                  <div class='bio-row'>
                      <p><span>City</span>:&nbsp;    $city</p>
                  </div>
                  <div class='bio-row'>
                      <p><span>Country </span>:&nbsp;  $country</p>
                  </div>
                  <div class='bio-row'>
                      <p><span>Policy Reg. Date </span>:&nbsp;  12 Dec 2022</p>
                  </div>  
                  ";
                            ?>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="bio-desk">
                                       <?php
                                       echo "
                                        <h4 class='red'>$current</h4>
                                        <p>Name : $p_name</p>
                                        <p>Cover upto: Rs $p_coverage</p>
                                        <p>Your Unique Insurance Id: $uniqueId</p>";

                                       ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    
                                    <div class="bio-desk">
                                    <?php
                                       echo "
                                        <h4 class='terques'>$status</h4>
                                        <p>$details</p>";
                                       ?>
                                        <!-- <h4 class="terques">Policy Status </h4>
                                        <p>Pending </p>
                                        <p>Policy is approved by admin after reviewing your application.</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <?php
                                    echo "$claimcolumn
                                    <p>    </p>";
                                    
                                    ?>
                                    <!-- <div class="bio-desk">
                                        <h4 class="green">Your Policy Claim</h4>
                                        <button type="button" class="btn btn-primary">Claim Now</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <?php
                                    
                                    echo "$claimcolumnstatus";
                                    ?>
                                    <!-- <div class="bio-desk">
                                        <h4 class="purple">Claim status</h4>
                                        <p>Not Started</p>
                                        <p>Claim is approved by admin after reviewing your application.</p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

    </script>
</body>

</html>