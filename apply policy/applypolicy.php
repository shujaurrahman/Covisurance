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
}



$random=rand(100000000,900000000);
$uniqeCustomerId=$random;
// echo $uniqeCustomerId;

//posting application data to server with unique customer id which will be user 
// afterward to verify when user will claim same policy 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $submit = true;
   $firstName = $_POST["first_name"];
   $lastName = $_POST["last_name"];
   $gender=$_POST["gender"];
   $fatherName=$_POST["f_name"];
   $motherName=$_POST["m_name"];
   $birthday = $_POST["birthday"];
   $email = $_POST["email"];
   $addres=$_POST["address"];
   $p_name=$_POST["p_name"];
   $p_cat=$_POST["p_cat"];
   $p_premium=$_POST["p_premium"];
   $p_coverage=$_POST["p_coverage"];
   $pancard=$_POST["pancard"];
   $phone=$_POST["phone"];


$pan = $_FILES["pan_image"]["name"]; //img name
$tmpName1 = $_FILES["pan_image"]["tmp_name"]; //temp server
$newpan = $currentUser.$pan; //new image src


$aadhar = $_FILES["aadhar_image"]["name"]; //img name
$tmpName2= $_FILES["aadhar_image"]["tmp_name"]; //temp server
$newaadhar = $currentUser.$aadhar; //new image src


$medical = $_FILES["medical_image"]["name"]; //img name
$tmpName3 = $_FILES["medical_image"]["tmp_name"]; //temp server
$newmedical = $currentUser.$medical; //new image src


$pass= $_FILES["pass_image"]["name"]; //img name
$tmpName4 = $_FILES["pass_image"]["tmp_name"]; //temp server
$newpass = $currentUser.$pass; //new image src



   $sql = "INSERT INTO `appliedpolicy`(`first_name`, `last_name`, `gender`, `f_name`,`m_name`, `dob`, `email`, `address`, `p_name`, `p_cat`, `p_premium`, `p_coverage`, `pancard`,`phone`,`pan_image`,`aadhar_image`,`medical_image`,`pass_image`,`unique_id`,`username`, `action`) VALUES ('$firstName','$lastName','$gender','$fatherName','$motherName','$birthday','$email','$addres','$p_name','$p_cat','$p_premium','$p_coverage','$pancard','$phone',  '$newpan','$newaadhar','$newmedical','$newpass', '$uniqeCustomerId','$currentUser',0)";
   $result = mysqli_query($conn, $sql);

   if($result){
    $path='../userdoc/'; 
   mkdir($path.$currentUser.$p_name);
   move_uploaded_file($tmpName1,$path.$currentUser.$p_name.'/'.$newpan);
   move_uploaded_file($tmpName2,$path.$currentUser.$p_name.'/'.$newaadhar);
   move_uploaded_file($tmpName3,$path.$currentUser.$p_name.'/'.$newmedical);
   move_uploaded_file($tmpName4,$path.$currentUser.$p_name.'/'.$newpass);
   $sql2="UPDATE `notify` SET `policy_app`= '1' WHERE `username`='$currentUser'";
   $result2=mysqli_query($conn,$sql2);

   }
   else{
       echo "Doc Images doesn't got stored in our database,contact admin ";
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
</head>

<body>
<!-- =======================================NAV BAR OF WEBSITE================================-->

                              <?php
                            require "../partials/nav.php";
                                $alerMssg = "";
                                $alertError = "";
                                $alertDisplay = "none";
                                if($_SERVER["REQUEST_METHOD"] == "POST"){
                                $alertMssg = "Note Down Your Unique Insurance Number: &nbsp $uniqeCustomerId &nbsp This will be needed when you
                                will claim policy,You can also see Unique Insurane Id in my policies";
                                $paymentMssg="A payment page will pop up Now pay your premium fee to start the policy process.";
                                if($paymentMssg){
                                    $sql2="UPDATE `notify` SET `payment_success`= '1' WHERE `username`='$currentUser'";
                                    $result2=mysqli_query($conn,$sql2);
                                }
                                $alertError = "class = 'error'";
                                $alertDisplay = "block";
                                echo "<p $alertError style='display: $alertDisplay;'>$alertMssg</p>";
                                echo "<p $alertError style='display: $alertDisplay;'>$paymentMssg</p>";
                                echo "
                                <script>
                                setInterval(() => {
                                  window.location = 'https://pages.razorpay.com/pl_J875FCFkuOEgcL/view';
                                }, 4000);
                                </script>
                                ";
                                }
                                else{
                                    $alertMssg = "You Have already applied for this policy Check my policies section.";
                                    $alertError = "class = 'error'";
                                    $alertDisplay = "block";
                                }

                            ?>
                        


    <!--================Policy Cliam =================-->
    <section class="blog_area single-post-area area-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <form action="applypolicy.php" method="POST" enctype='multipart/form-data'>
                        <h1 style="color: black">Apply Policy 
                        </h1>
                        <p style="color: black"> Fill your details correctly these details will be matched with your id at the time of policy claim. </p>
                        
                        <div class="mt-10">
                            <input type="text" name="first_name" placeholder="First Name" value = '<?php echo $DfirstName?>'  required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="last_name" placeholder="Last Name" value = '<?php echo $DlastName?>'  required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="gender" placeholder="Gender" value = ''"  required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="f_name" placeholder="father Name" value = ''"  required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="m_name" placeholder="Mother Name" value = ''"  required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="date" name="birthday" placeholder="Date of Birth" value = '<?php echo $Dbirthday?>'  required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="email" name="email" placeholder="Email address" value = '<?php echo $DuserEmail?>'  required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="address" placeholder="Address" value = '<?php echo implode('  ',array($Dadress,$Dcity,$Dcountry))?>' required class="single-input">
                        </div>
                          <br>
                        <p style="color: black"> Your are applying for the policy </p>
                        <div class="mt-10">
                            <input type="text" name="p_name" placeholder="policy Name" value = '<?php 
                            
                            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                                echo "";
                            }
                            else{
                            echo $_GET['policyName'];
                            }
                            ?>'  required class="single-input">
                            
                        </div>
                        <div class="mt-10">
                            <input type="text" name="p_cat" placeholder="policy Category"   value = '<?php 
                                                        if ($_SERVER["REQUEST_METHOD"] == "POST"){
                                                            echo "";
                                                        }
                                                        else{
                            echo $_GET['category']
                        ;}
                            ?>'  required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="p_premium" placeholder="policy Premium" value = '<?php 
                                                        if ($_SERVER["REQUEST_METHOD"] == "POST"){
                                                            echo "";
                                                        }
                                                        else{
                                                      echo $_GET['premium'];
                                                        }?>'  required class="single-input">
                        </div>
                        
                        <div class="mt-10">
                            <input type="text" name="p_coverage" placeholder="policy Coverage"  value='<?php
                                                        if ($_SERVER["REQUEST_METHOD"] == "POST"){
                                                            echo "";
                                                        }
                                                        else{
                            echo $_GET['coverage'];}
                            ?>'  required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="pancard" placeholder="PAN CARD" value = '<?php echo $Dpancard?>'  required class="single-input-primary">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="phone" placeholder="Phone Number" value = '<?php echo $DphoneNumber?>'  required class="single-input-accent" maxlength="20">
                        </div>
                        <br>
                        <p style="color: black"> Upload supporting Doc </p>
                        <div class="input-group-icon mt-10">
                        <p style="color: black"> PAN CARD </p>
                        <input type='file' name='pan_image' class='image' accept='image/*' required>
                        <p style="color: black"> AADHAAR </p>
                        <input type='file' name='aadhar_image' class='image' accept='image/*' required>
                        <p style="color: black"> MEDICAL REPORT </p>
                        <input type='file' name='medical_image' class='image' accept='image/*' required>
                        <p style="color: black"> PASSPORT SIZE PHOTO </p>
                        <input type='file' name='pass_image' class='image' accept='image/*' required>
                        </div>
                        <br>
                        <div class="mt-10" align="center">
                            <button type="submit" name="submitreg" class="active">Submit
                            </button>
                            <button style="margin-left: 50px" type="reset" name="submitreg" class="active active-2"><a href="../user profile/profile.php">Cancel</a>
                            </button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

<script>
    if (performance.navigation.type === 1) {
  window.location.href = '../user profile/profile.php';
} else {
  // Do nothing
}
</script>

</body>

</html>
