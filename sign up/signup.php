<?php
require "../partials/conn.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Sign-up</title>
  <!------Favicon-->
  <link rel="icon" href="images/favicon.ico">
  <!--stylesheet-->
    <link rel="stylesheet" href="../static/css/sign-up.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
  .logo {
    width: 32px;
  }

  a {
    text-decoration: none;
  }

  .nav-sign-up {
    display: flex;
  }

  .links a {
    color: var(--main-color);
    font-size: 1rem;
    line-height: 1;
    font-weight: 500;
    transition: 0.3s;
    margin: 10px 0 0 12px;
  }

  .links a:hover {
    color: var(--dark-three);
  }
  .error{
  border-color: var(--main-color) !important;
  background-color: var(--light-four) !important;
}

.error-2 {
  color: black;
    font-size: 17px;
    font-weight: 600;
    background: var(--light-four);
    width: 90%;
    text-align: center;
    padding: 0.3rem;
    margin: 0 0 20px 0;
}
</style>

<body>
  <!-- php code +validation of quantities code  -->

  <?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

session_start();
if (isset($_SESSION) and isset($_SESSION['username'])) {
  header("Location: ../user profile/profile.php");
}


$boolUserError = true;
$boolEmailError = true;
$boolBirthdayError = true;
$boolPhoneNumberError = true;
$boolConfirmPasswordError = true;
$boolPasswordError = true;
$submit = false;

$fistnameError = "";
$firstnameMssg = "";
$firstnameDisplay = "none";

$userError = "";
$userMssg = "";
$userDisplay = "none";

$emailError = "";
$emailMssg = "";
$emailDisplay = "none";


$birthdayError = "";
$birthdayMssg = "";
$birthdayDisplay = "none";


$phoneError = "";
$phoneMssg = "";
$phoneDisplay = "none";

$passwordError = "";
$passwordMssg = "";
$passwordDisplay = "none";



$confirmPasswordError = "";
$confirmPasswordMssg = "";
$confirmPasswordDisplay = "none";

$signUpMssg = "";
$signUpError = "";
$signUpDisplay = "none";
$Mssgsuccess="";
$otpsuccess="";
$otpnotsuccess="";

$otpmssg="";
$otperror="";
$otpdisplay="none";


$email = "";
$name = "";
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $submit = true;
  $firstName = $_POST["first_name"];
  $lastName = $_POST["last_name"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $birthday = $_POST["birthday"];
  $phoneNumber = $_POST["phonenumber"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirmPassword"];

  $sql = "SELECT * FROM `alluser` WHERE `username` = '$username'";
  $result = mysqli_query($conn, $sql);
  $aff = mysqli_affected_rows($conn);
  if ($aff < 1) {
    $boolUserError = false;
  } else {
    $userMssg = "Username Already Exist";
    $userError = "class = 'error'";
    $userDisplay = "block";
  }

  $sql = "SELECT * FROM `alluser` WHERE `email` = '$email'";
  $result = mysqli_query($conn, $sql);
  $aff = mysqli_affected_rows($conn);
  if ($aff < 1) {
    $boolEmailError = false;
  } else {
    $emailMssg = "Email Already Exist";
    $emailError = "class = 'error'";
    $emailDisplay = "block";
  }

  if ($password == $confirmPassword) {
    $boolConfirmPasswordError = false;
  } else {
    $confirmPasswordMssg = "Password Doesnt Match";
    $confirmPasswordError = "class = 'error'";
    $confirmPasswordDisplay = "block";
  }

  //Javascript Part in php

  //First Name
  $regex = "/[A-Z]\w+/";
  if (preg_match($regex, $firstName)!= 1) {
    $firstnameMssg = "First letter Should be Capital";
    $firstnameError = "class = 'error'";
    $firstnameDisplay = "block";
  }

  //Password
  $regex = "/\w{6,}/";
  if (preg_match($regex, $password) == 1) {
    $boolPasswordError = false;
  } else {
    $passwordMssg = "Password too Weak";
    $passwordError = "class = 'error'";
    $passwordDisplay = "block";
  }

  //birthday
  $regex = "/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/";
  if (preg_match($regex, $birthday) == 1) {
    $boolBirthdayError = false;
  } 
  else {
    $birthdayMssg = "Enter Correct Format";
    $birthdayError = "class = 'error'";
    $birthdayDisplay = "block";
  }

  $regex = '/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1})?([0-9]{10})$/';
  if (preg_match($regex, $phoneNumber)==1) {
    $boolPhoneNumberError = false;
  } 
  else {
    $phoneMssg = "Enter Correct Format";
    $phoneError = "class = 'error'";
    $phoneDisplay = "block";
  }




  if (
    !$boolUserError and !$boolEmailError and !$boolPasswordError and !$boolConfirmPasswordError
  ) {

    //UserName
    $regex = "/\w{4,}/";
    if (preg_match($regex, $username) == 1) {
      $boolUserError = false;
    } else {
      $userMssg = "username cannot be less than 4";
      $userError = "class = 'error'";
      $userDisplay = "block";
    }



    //Email
    $regex = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    if (preg_match($regex, $email) == 1) {
      $boolEmailError = false;
    } else {
      $emailMssg = "Please Enter a valid Email address";
      $emailError = "class = 'error'";
      $emailDisplay = "block";
    }

    if (
      !$boolPasswordError and !$boolConfirmPasswordError and !$boolUserError and !$boolEmailError
    ) 
    {
      $encpass = password_hash($password, PASSWORD_BCRYPT);
      $code = rand(999999, 111111);
      $status = "notverified";
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);
      $sql="INSERT INTO `alluser`( `first_name`, `last_name`, `username`, `email`, `birthday`, `phonenumber`, `password`,`code`,`status`) VALUES 
      ('$firstName','$lastName','$username','$email','$birthday','$phoneNumber','$passwordHash','$code','$status')";
      // $result = mysqli_query($conn, $sql);
      // echo var_dump($result);
      $data_check = mysqli_query($conn, $sql);
      if($data_check){
     
        $msg="Your verification code is ";
                              
        $msgend= "If this wasn't you ignore this message.";
        $subject = "Email Verification Code";

              //Create an instance; passing `true` enables exceptions
              $m = new PHPMailer(true);
   
              try {
                  //Server settings
                  // $m->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                  $m->isSMTP();                                            //Send using SMTP
                  $m->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                  $m->SMTPAuth   = true;    
                  $m->SMTPSecure = 'tls';// Enable TLS encryption, `ssl` also accepted                               //Enable SMTP authentication
                  $m->Username   = 'covisurance@gmail.com';                     //SMTP username
                  $m->Password   = 'shuja@123';                               //SMTP password
               //    $m->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                  $m->Port = '587';   
                  // $m->SMTPDebug = 2;   
                  $m->SMTPOptions = array(
                   'ssl' => array(
                       'verify_peer' => false,
                       'verify_peer_name' => false,
                       'allow_self_signed' => true
                   )
               );                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
   
                  //Recipients
                  $m->setFrom('covisurance@gmail.com', 'Covisurance');
                  $m->addAddress($email,$firstName);     //Add a recipient
                  $m->addAddress($email);               //Name is optional
                  // $m->addReplyTo('info@example.com', '');
               //    $m->addCC('cc@example.com');
               //    $m->addBCC('bcc@example.com');
   
                  //Attachments
               //    $m->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
               //    $m->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
   
                  //Content
                  $m->isHTML(true);                                  //Set email format to HTML
                  $m->Subject = $subject;
                  $m->Body    = $msg .' <b>'.$code.'</b><br><br>'.$msgend;
                  $m->AltBody = 'Code Not Generated. Some error Occured';
   
                  $m->send();
                  // echo 'Message has been sent';
              }
              catch (Exception $e) {
                  // echo "Message could not be sent. Mailer Error: {$m->ErrorInfo}";
              }


            $otpmssg="We've sent a verification code to - $email" ;
            $otperror="class='error-2'";
            $otpdisplay="block";
            $otpsuccess= "
            <p $otperror style='display: $otpdisplay;'>$otpmssg</p>";
            $info = "We've sent a verification code to your email -$email";
            $_SESSION['info'] = $info;
            $_SESSION['email'] = $email;
              header('location: ../authentication/user-otp.php');
              exit();
          }else{
                $otpmssg="Otp not Sent!" ;
                $otperror="class='error-2'";
                $otpdisplay="block";
                $otpnotsuccess= "
                <p $otperror style='display: $otpdisplay;'>$otpmssg</p>";

          }
        }  
      }
      
    }
  
  if(!empty($_GET['email'])){
  $email=$_GET['email'];
  $check_code = "SELECT * FROM `alluser` WHERE `email`= '$email'  and `code`=0";
  $code_res = mysqli_query($conn, $check_code);
  if(mysqli_num_rows($code_res)===1){
    $signUpMssg = "Your Email is verified Sign-up Success,redirecting to you homepage.";
    $signUpError = "class = 'error-2'";
    $signUpDisplay = "block";
  session_destroy();
  echo "
  <script>
  setInterval(() => {
    window.location = '../index.php';
  }, 3200);
  </script>
  ";
}
 }

  $Mssgsuccess= "
     <p $signUpError style='display: $signUpDisplay;'>$signUpMssg</p>";
  


    
  echo "<div class='container'>";
      echo $Mssgsuccess;
      echo $otpsuccess;
      echo $otpnotsuccess;
  ?>
    <div class="nav-sign-up links">
      
      <img src="../static//img/logo.png" class="logo-img logo" alt="">
      <a href="../index.php">Home</a>
    </div>
    <div class="title">Get Started</div>
    <div class="content">
      <form action="signup.php" method="POST">
        <div class="user-details">

          <?php
          $firstNameBlock = "<div class='input-box'>
          <span class='details'>First Name</span>
         <input type='text' name='first_name' id='first_name' $fistnameError placeholder='Enter your First name' required>
         <small style='display: $firstnameDisplay;'>$firstnameMssg</small>
         </div>";

          $lastNameBlock = "<div class='input-box'>
          <span class='details'>Last Name</span>
          <input type='text' name='last_name'  placeholder='Enter your Last name' required>
           </div>";

          $userNameBlock = "<div class='input-box'>
          <span class='details'>Username</span>
           <input type='text' name='username' id='username' $userError placeholder='Enter your username' required>
           <small style='display: $userDisplay;'>$userMssg</small></div>";
          
          $emailBlock = "<div class='input-box'>
          <span class='details'>Email</span>
          <input type='text' name='email' id='email' $emailError placeholder='Enter your email' required>
          <small style='display: $emailDisplay;'>$emailMssg</small>   
          </div>";

          $birthdayBlock = "<div class='input-box'>
          <span class='details'>Birthday</span>
         <input type='text' name='birthday' id='birthday' $birthdayError placeholder='Enter your Birthday: DD/MM/YYYY' required>
         <small style='display: $birthdayDisplay;'>$birthdayMssg</small>
         </div>";

          $phoneNumberBlock = "<div class='input-box'>
          <span class='details'>Phone Number</span>
          <input type='text' name='phonenumber' id='phonenumber' $phoneError placeholder='(+91) Enter your number' required>
          <small style='display: $phoneDisplay;'>$phoneMssg</small>
          </div>";

          $passwordBlock = "<div class='input-box'>
          <span class='details'>Password</span>
          <input type='password' name='password' id='password' $passwordError placeholder='Enter your password' required>
          <small style='display: $passwordDisplay;'>$passwordMssg</small>
          </div> ";

          $confirmPasswordBlock = "<div class='input-box'>
          <span class='details'>Confirm Password</span>
          <input type='password' name='confirmPassword' id='confirmPassword' $confirmPasswordError placeholder='Confirm your password' required>
          <small style='display: $confirmPasswordDisplay;'>$confirmPasswordMssg</small>
          </div> ";

          $buttonBlock="<div class='button'>
          <input type='submit' value='Sign up'>
          <div class='sign-in'>
            <h5>Already have an account?</h5>
            <a href='../index.php' class='active' id='signupopenBtn'>Sign in</a>
          </div>";

          echo "
              $firstNameBlock

              $lastNameBlock

              $userNameBlock

              $emailBlock

              $birthdayBlock

              $phoneNumberBlock

              $passwordBlock

              $confirmPasswordBlock

              $buttonBlock
          ";
          ?>
          </div>
      </form>
    </div>

  </div>

</body>
<script src="../static/js/signup.js"></script>
</html>