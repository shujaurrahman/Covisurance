<?php
require "../partials/conn.php";
session_start();
if (isset($_SESSION) and isset($_SESSION['username'])) {
    $boolLoggedIn = true;
    $currentUser = $_SESSION['username'];
}
else{
    header("location ../index.php");
}

$result2="";
if(isset($_GET) and isset($_GET['clear'])){
  $id= $_GET['clear'];
      $sql = "UPDATE `notify` SET `account_created`=null, `email_verified`=null, `signed_in`=null, `password_reset`=null ,`update_info`=null ,`profile_pic`=null ,`policy_app`=null ,`policy_claimed`=null ,`admin_review`=null ,`approved`=null ,`disapproved`=null ,`download_pdf`=null ,`question`=null ,`logout`=null ,`payment_success`=null,`pdf`=null  WHERE `id`=$id";
      $result2 = mysqli_query($conn,$sql);        
      }
$logout="";
$payment_success="";
$question="";
$download_pdf="";
$policy_app="";
$disapproved="";
$approved="";
$payment_success="";
$passWord_reset="";
$admin_review="";
$profile_pic="";
$signed_in="";
$email_verified="";
$account="";
$update_info="";
$caughtup="";
$pdf="";
$backbutton="";

$sql= "SELECT * FROM `notify` WHERE `username`='$currentUser'";
$result=mysqli_query($conn,$sql);
$aff=mysqli_affected_rows($conn);
if($aff>0){
  $data=mysqli_fetch_object($result);
  $id=$data->{"id"}; 
  if($data->{'signed_in'}==1 or $data->{'logout'}==1 or $data->{'email_verified'}==1 or $data->{'password_reset'}==1
  or $data->{'update_info'}==1 or $data->{'profile_pic'}==1 or $data->{'policy_app'}==1 or $data->{'policy_claimed'}==1 or $data->{'admin_review'}==1
  or $data->{'approved'}==1 or $data->{'disapproved'}==1 or $data->{'download_pdf'}==1 or $data->{'question'}==1
  or $data->{'payment_success'}==1 or $data->{'pdf'}==1) {
  $button="<button type='submit' class='btn btn-warning' onClick='clearNotification($id)'>Clear All</button>";
  $backbutton="<a href='../user profile/profile.php'><button type='submit' class='btn btn-warning back' > Go Back</button></a>";
}
else{

  $button="<a href='../user profile/profile.php'><button type='submit' class='btn btn-warning' > Go Back</button></a>";
  $caughtup='<h4><strong> No New Notifications!!</strong> You are all caught up.</h4>';
  }
  $date=$data->{"date"};
  $email=$data->{'email'};
    $newDate = date("j-F Y", strtotime($date));
    $newTime = date("l, g:i a", strtotime($date));
  if($data->{'account_created'}==1){
          $account="<div class='alert alert-success alert-white rounded'
          <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
          <div class='icon'>
              <i class='fa fa-solid fa-user-plus'></i>
          </div>
          <strong>Yahoo... Account Created!</strong> 
          You created account Successfully <small>$newDate at $newTime</small>
           </div>"
           ;
          }
    if($data->{'email_verified'}==1){
                        $email_verified="<div class='alert alert-success alert-white rounded'
                        <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
                        <div class='icon'>
                         <i class='fa fa-solid fa-envelope'></i>
                        </div>
                        <strong>Email Verified!</strong> 
                        Your Email was verfied at <small>$newDate at $newTime</small>
                        </div>"
                        ;
                      }
    if($data->{'signed_in'}==1){
                        $signed_in="<div class='alert alert-success alert-white rounded'
                        <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
                        <div class='icon'>
                        <i class='fas fa-solid fa-user-check'></i>
                        </div>
                        <strong>Sign in!</strong> 
                        You Signed in successfully. <small>$newDate at $newTime</small> 
                        </div>"
                        ;
                      }
   if($data->{'password_reset'}==1){
    $passWord_reset="<div class='alert alert-success alert-white rounded'
    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
    <div class='icon'>
    <i class='fa fa-solid fa-lock'></i>
    </div>
    <strong>Password Reset!</strong> 
    Your password Was reset.    </div>"
    ;
  }
  if($data->{'update_info'}==1){
    $update_info="<div class='alert alert-success alert-white rounded'
    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
    <div class='icon'>
    <i class='fa fa-solid fa-file-invoice'></i>
    </div>
    <strong>Info Updated!</strong> 
      Your personal information was updated.
    </div>"
    ;
  }
  if($data->{'profile_pic'}==1){
    $profile_pic="<div class='alert alert-success alert-white rounded'
    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
    <div class='icon'>
    <i class='fa fa-solid fa-id-badge'></i>
    </div>
    <strong>Profile picture Updated!</strong> 
     Your profile pic was Changed.
    </div>"
    ;
  }
  if($data->{'policy_app'}==1){
    $policy_app="<div class='alert alert-success alert-white rounded'
    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
    <div class='icon'>
    <i class='fa fa-regular fa-file-code'></i>
    </div>
    <strong>Applied Policy</strong> 
    You applied for a policy 
    </div>"
    ;
  }
  if($data->{'policy_claimed'}==1){
    $policy_claimed="<div class='alert alert-success alert-white rounded'
    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
    <div class='icon'>
    <i class='fa fa-solid fa-circle-exclamation'></i>
    </div>
    <strong>Claimed Policy!</strong> 
     You Claimed a policy.
    </div>"
    ;
  }
  if($data->{'admin_review'}==1){
    $admin_review="<div class='alert alert-success alert-white rounded'
    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
    <div class='icon'>
        <i class='fa fa-circle-o-notch fa-spin fa fa-fw'></i>
    </div>
    <strong>Application Under Review!</strong> 
     Your Policy is Being reviewed by admin currently
    </div>"
    ;
  }
  if($data->{'approved'}==1){
    $approved="<div class='alert alert-success alert-white rounded'
    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
    <div class='icon'>
    <i class='fa fa-solid fa-thumbs-up'></i>
    </div>
    <strong>Policy Approved!</strong> 
     Your Policy was approved by the admin. <small>$newDate at $newTime</small>
    </div>"
    ;
  }
  if($data->{'disapproved'}==1){
    $disapproved="<div class='alert alert-success alert-white rounded'
    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
    <div class='icon'>
    <i class='fa fa-solid fa-thumbs-down'></i>
    </div>
    <strong>Policy Disapproved!</strong> 
    Your Policy was disapproved by the admin. <small>$newDate at $newTime</small>
    </div>"
    ;
  }
  if($data->{'download_pdf'}==1){
    $download_pdf="<div class='alert alert-success alert-white rounded'
    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
    <div class='icon'>
    <i class='fa fa-regular fa-file'></i>
    </div>
    <strong>Downloaded PDF!</strong> 
    You Downloaded PDF copy of your policy application.
    </div>"
    ;
  }
  if($data->{'question'}==1){
    $question="<div class='alert alert-success alert-white rounded'
    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
    <div class='icon'>
    <i class='fa fa-regular fa-comment'></i>
    </div>
    <strong>Messaged Admin!</strong> 
    You Sent admin a Querry through Contact us Section. <small>$newDate at $newTime</small>
    </div>"
    ;
  }
  if($data->{'logout'}==1){
    $logout="<div class='alert alert-success alert-white rounded'
    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
    <div class='icon'>
    <i class='fa fa-solid fa-sign-out'></i>
    </div>
    <strong>Logged out!</strong> 
    You logged out Successfully.<small>$newDate at $newTime</small>
    </div>"
    ;
  }
  if($data->{'payment_success'}==1){
    $payment_success="<div class='alert alert-success alert-white rounded'
    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
    <div class='icon'>
    <i class='fa fa-regular fa-credit-card'></i>
    </div>
    <strong>Payment Success!</strong> 
    Your Payment for your policy was Succesfull. <small>$newDate at $newTime</small>
    </div>"
    ;
  }
  if($data->{'pdf'}==1){
    $pdf="<div class='alert alert-success alert-white rounded'
    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'></button>
    <div class='icon'>
    <i class='fa fa-solid fa-at'></i>
    </div>
    <strong>PDF MAILED!</strong> 
    An Email with policy details as PDF file attachment has been to $email. Please check your inbox
    (or check your spam ) and keep it as a soft copy.
    </div>"
    ;
  }


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Notifications</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="https://kit.fontawesome.com/06edf57802.js" crossorigin="anonymous"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippets bootdey">
          <h1>  <?php
            echo "Notifications $backbutton $button </h1>
             
            $caughtup
            $pdf
            $logout
            $profile_pic
            $update_info
            $policy_app
            $payment_success
            $download_pdf
            $admin_review
            $approved
            $disapproved
            $question
            $passWord_reset
            $signed_in
            $email_verified
            $account
            
            ";
          ?> 

<style type="text/css">

@import url('../static/css/color.css');
body{
  margin-top:2%;
  background-color: var(--light-three);
  
}
button{
  position: absolute;
  right: 11%;
  margin: 0 0 1% 0 !important;
  background-color: var(--main-color) !important;
  border-color: var(--main-color) !important;
}

.back{
  right:17%;
}
button:hover{
  background-color: var(--light-one) !important;
  color: var(--dark-one) !important;
}
h1{
  margin-bottom: 1%;
  text-align: center;
  padding: 10px;
  font-weight: 600;
  color: var(--main-color);
}

h4{
  background-color: var(--main-color);
  margin-top: 10%;
  padding: 8px 10px;
  width: 25%;
  border-radius: 10px;
  position: absolute;
  left: 30%;
}
small{
  position: absolute;
  right: 10px;
}
.alert {
  border-radius: 0;
  -webkit-border-radius: 0;
  box-shadow: 0 1px 2px rgba(0,0,0,0.11);
  display: table;
  width: 100%;
}

.alert-white {
  background-color: var(--light-two) !important;
  border-top-color: #d8d8d8;
  border-bottom-color: #bdbdbd;
  border-left-color: #cacaca;
  border-right-color: #cacaca;
  color:var(--dark-one) !important;
  padding-left: 61px;
  position: relative;
}

.alert-white.rounded {
  border-radius: 5px;
  -webkit-border-radius: 3px;
}

.alert-white.rounded .icon {
  border-radius: 3px 0 0 3px;
  -webkit-border-radius: 3px 0 0 3px;
}

.alert-white .icon {
  text-align: center;
  width: 45px;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  border: 1px solid #bdbdbd;
  padding-top: 15px;
}


.alert-white .icon:after {
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
  display: block;
  content: '';
  width: 10px;
  height: 10px;
  border: 1px solid #bdbdbd;
  position: absolute;
  border-left: 0;
  border-bottom: 0;
  top: 50%;
  right: -6px;
  margin-top: -3px;
  background: #fff;
}

.alert-white .icon i {
  font-size: 20px;
  color: var(--light-three) !important;
  left: 12px;
  margin-top: -10px;
  position: absolute;
  top: 50%;
}
/*============ colors ========*/
.alert-success {
  color: #fff;
}

.alert-white.alert-success .icon, 
.alert-white.alert-success .icon:after {
  border-color: var(--light-two);
  background: var(--main-color);
}



</style>
<script src="../static/js/admin.js"></script>
</body>

</html>