<?php
require "../partials/conn.php";
session_start();
$boolLoggedIn = false;
if (isset($_SESSION) and isset($_SESSION['username'])) {
	$currentUser = $_SESSION['username'];
	$boolLoggedIn = true;
} else {
	  header("Location: ../index.php");
}


$submit = false;
if ($boolLoggedIn) {
	$sql = "SELECT * FROM `alluser` Where username ='$currentUser'";
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_object($result);
	$DfirstName = $data->{"first_name"};
	$DlastName = $data->{"last_name"};
	// $DuserName = $data->{"username"};
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



$policy="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $boolAlreadyClaimed = false;
    $innerSql = "SELECT * FROM `appliedpolicy` Where `username`='$currentUser' and `action` = 1 ";
    $resultSql = mysqli_query($conn,$innerSql);
    $innerAff = mysqli_affected_rows($conn);
    $data = mysqli_fetch_object($resultSql);


    if($innerAff > 0){
      $boolAlreadyClaimed = true;
      $policy=$data->{"p_name"};
    }

    if(!$boolAlreadyClaimed){


        $sql="SELECT * FROM  `appliedpolicy` WHERE `username`='$currentUser'";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_object($result);

        // Old code 
        // $data->{"first_name"}== $_POST["fname"];
        // $data->{"first_name"}== $_POST["lname"];
        // $data->{"email"} == $_POST["email"];
        // $data->{"p_name"} == $_POST["p_name"];
        // $data->{"pancard"} == $_POST["pancard"];
        // $data->{"phone"} == $_POST["phone"];
        // $data->{"unique_id"} == $_POST["unique_id"];
        // $data->{"dob"} == $_POST["birthday"];
        


        // Testing if this works for the accurate condition 
        $idinserver = $data->{"action"};
        $policy=$_POST["p_name"];
        $inputId=$_POST["unique_id"];
        
        if(
        $data->{"first_name"}== $_POST["fname"] ||
        $data->{"first_name"}== $_POST["lname"] ||
        $data->{"email"} == $_POST["email"] ||
        $data->{"p_name"} == $_POST["p_name"] ||
        $data->{"pancard"} == $_POST["pancard"] ||
        $data->{"phone"} == $_POST["phone"] ||
        $data->{"unique_id"} == $_POST["unique_id"] ||
        $data->{"dob"} == $_POST["birthday"]
        )
        {
        $sql2="UPDATE `appliedpolicy` SET  `action` = '1' WHERE `unique_id`='$inputId'";
        $result2 = mysqli_query($conn, $sql2);
        if($result){
            $sql2="UPDATE `notify` SET `policy_claimed`= '1' WHERE `username`='$currentUser'";
            $result2=mysqli_query($conn,$sql2);
            $alertMssg = "You have Successfully claimed the $policy policy, It is in pending state Once admin approves the amount Will
            be processed to your account.";
            
            $sql="SELECT * FROM  `appliedpolicy` WHERE `username`='$currentUser' and `unique_id`='$inputId'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_object($result);
            $id=$data->{"id"};
            
            echo "
            <script>
            setInterval(() => {
                window.location = './userpage.php?id=$id';
            }, 3000);
            </script>
            ";
        }
        }

        
        else{
             $alertMssg = "Incorrect Details...";
        }
        
        
        // $firstName = $data->{"first_name"};
        // $lastName = $data->{"last_name"};
        // $userEmail = $data->{"email"};
        // $policy = $data->{"p_name"};
        // $pancard = $data->{"pancard"};
        


        // echo $idinserver;
        // $birthday = $data->{"dob"};

        

        // old code 


        // if($idinserver==1){
        //         $alertMssg = "You have Already claimed the $policy policy, It is pending in state  admin hasn't 
        //         approved yet. Have pateince it will be approved once details are checked thoroughly.";
        // }
        // else{
        // $sql2="UPDATE `appliedpolicy` SET  `action` = '1' WHERE `unique_id`='$inputId'";
        // $result = mysqli_query($conn, $sql2);
        //         $alertMssg = "You have Successfully claimed the $policy policy, It is in pending state Once admin approves the amount Will
        //         be processed to your account.";
        // }

    }
    else{
        $alertMssg = "You have Already claimed the $policy policy, It is pending in state  admin hasn't 
        approved yet.At a time you can Claim only one policy";
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Claim</title>

    <!-- main css -->
    <link rel="stylesheet" href="../static/css/style.css">

    <link rel="stylesheet" href="../static/css/claimopensource.css">
  <style>
      @import url('../static/css/color.css');
      body{
          background-color: var(--light-three);
      }
      h1,p{
          padding: 10px 0;
      }

      .active{
    background-color: var(--main-color) !important;
    color: var(--light-one) !important;
    border-radius: 10px;
    font-size: 1rem;
    padding: 0.9rem 2.1rem;
    display: inline-block;
    color: var(--dark-three) !important;
    font-size: 1.05rem;
    font-weight: 500;
    line-height: 1;
    transition: 0.3s;
}
.active-2{
    background-color: var(--light-three) !important;
    color: var(--dark-three) !important;
}
.active-2 a{
    text-decoration: none;
    color:var(--dark-one) !important;
}
.active:hover{
    background-color: var(--light-four) !important;
    color: #fff !important;
}

.single-input,.single-input-primary,.single-input-accent{
    background-color: var(--light-one);
}
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
  <script>
      setTimeout(function(){$('.error').fadeOut();}, 5000);
  </script>
</head>


<body>
<!-- =======================================NAV BAR OF WEBSITE================================-->

                              <?php
                            require "../partials/nav.php";
                            $alerMssg = "";
                            $alertError = "";
                            $alertDisplay = "none";
                            if($_SERVER["REQUEST_METHOD"] == "POST"){
                                 echo $alerMssg;
                            $alertError = "class = 'error'";
                            $alertDisplay = "block";
                            echo "<p $alertError style='display: $alertDisplay;'>$alertMssg</p>";
                            }
    
                            ?>



    <!--================Policy Cliam =================-->
    <section class="blog_area single-post-area area-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <form action="claim.php" method="POST">
                        <h1 style="color: black">Claim Your Policy 
                        </h1>
                        <p style="color: black"> Claim your amount, Keep in mind fill same details as filled at time of applying. </p>
                        <div class="mt-10">
                            <input type="text" name="fname" placeholder="First Name" onfocus="this.value = '<?php echo $DfirstName?>'"  required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="lname" placeholder="Last Name" onfocus="this.value = '<?php echo $DlastName?>'"  required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="email" placeholder="Email" onfocus="this.value = '<?php echo $DuserEmail?>'"  required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="date" name="birthday" placeholder="Date of Birth" onfocus="this.value = '<?php echo $Dbirthday?>'"  required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="p_name" placeholder="policy Name" value = ''  required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="pancard" placeholder="PAN CARD" onfocus="this.value = '<?php echo $Dpancard?>'"  required class="single-input-primary">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="phone" placeholder="Phone Number" onfocus="this.value = '<?php echo $DphoneNumber?>'"  required class="single-input-accent" maxlength="20">
                        </div>
                        <div class="mt-10">
                            <input type="number" name="unique_id" placeholder="Insurance Unique Id" onfocus="this.value = ''"  required class="single-input-accent" maxlength="20">
                        </div>
                        <br>
                        <div class="mt-10" align="center">
                            <button type="submit" name="submitreg" class="active">Submit
                            </button>
                            <button style="margin-left: 50px" type="reset" name="submitreg" class="active active-2"><a href="../index.php">Cancel</a>
                            </button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>


</body>

</html>
