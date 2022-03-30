<?php

use Mpdf\Mpdf;

$boolAdminLoggedIn = false;
session_start();
if(isset($_SESSION) and isset($_SESSION["username"])){  
	$currentName=$_SESSION["username"];
    $boolAdminLoggedIn = true;   
}

require "../partials/conn.php";


$id=$_GET['id'];
$sql = "SELECT * FROM `appliedpolicy`  WHERE `id`=$id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_object($result);
$first_name=$data->{"first_name"};
$last_name=$data->{"last_name"};
$gender=$data->{"gender"};
$dob=$data->{"dob"};
$f_name=$data->{"f_name"};
$m_name=$data->{"m_name"};
$email=$data->{"email"};
$addres=$data->{"address"};
$policyName=$data->{"p_name"};
$policyCat=$data->{"p_cat"};
$policyPremium=$data->{"p_premium"};
$policyCoverage=$data->{"p_coverage"};
$pancard=$data->{"pancard"};
$phone=$data->{"phone"};
$pan_image=$data->{"pan_image"};
$aadhar_image=$data->{"aadhar_image"};
$medical_image=$data->{"medical_image"};
$pass_image=$data->{"pass_image"};
$unique_id=$data->{"unique_id"};
$userName=$data->{"username"};
$action=$data->{"action"};
$date=$data->{"date"};
$newDate = date("j-F Y", strtotime($date));
$newTime = date("l, g:i a", strtotime($date));

$pathOfUserDoc='../userdoc/'.$userName.$policyName.'/';

$appheading="Download Your Application";
$display="block";
$alerMssg = "";
$alertError = "";
$alertDisplay = "none";
$approve="";
$dissapp="";









 
 ?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Application Review</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
body{
    color: black;
    margin-top:20px;
}
.section {
    padding: 100px 0;
    position: relative;
}
.gray-bg {
    background-color: #f5f5f5;
}
img {
    max-width: 100%;
}
img {
    margin: 5px;
    vertical-align: middle;
    border-style: none;
}

.about-text h3 {
  font-size: 45px;
  font-weight: 700;
  margin: 0 0 6px;
}
@media (max-width: 767px) {
  .about-text h3 {
    font-size: 35px;
  }
}
.about-text h6 {
  font-weight: 600;
  margin-bottom: 15px;
}
@media (max-width: 767px) {
  .about-text h6 {
    font-size: 18px;
  }
}
.about-text p {
  font-size: 18px;
  max-width: 450px;
}
.about-text p mark {
  font-weight: 600;
  color: black;
}

.about-list {
  padding-top: 10px;
}
.about-list .media {
  padding: 5px 0;
}
.about-list label {
  color: #00ADB5;
  font-weight: 600;
  width: 88px;
  margin: 0;
  position: relative;
}
.about-list label:after {
  content: "";
  position: absolute;
  top: 0;
  bottom: 0;
  right: 11px;
  width: 1px;
  height: 12px;
  background: #00ADB5;
  -moz-transform: rotate(15deg);
  -o-transform: rotate(15deg);
  -ms-transform: rotate(15deg);
  -webkit-transform: rotate(15deg);
  transform: rotate(15deg);
  margin: auto;
  opacity: 0.5;
}
.about-list p {
  margin: 0;
  font-size: 15px;
}

@media (max-width: 991px) {
  .about-avatar {
    margin-top: 30px;
  }
}


.dark-color {
    color: #00ADB5;
}
.counter{
    width: 25%;
    margin: 5% 5px 0 32%;
    justify-content: space-between;
}
.btn{
    margin: auto !important; 
    margin-bottom: 5px !important;
    display: flex;
    flex-direction: row;
    justify-content: center;
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
<?php

$print= "
<body >
<section style='display: $display;' class='section about-section gray-bg' id='about'>";
      $alertMssg = "Download Pdf of Application for future Reference.";
      $alertError = "class = 'error'";
      $alertDisplay = "block";
      $display="none";
      echo "<p $alertError style='display: $alertDisplay;'>$alertMssg</p>";
?>
                   <!-- echo $pathOfUserDoc.$pan_image; -->
                
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-7">
                        <div class="about-text go-to">
                        <?php echo "
                            <h4 class='dark-color'>$appheading</h4>
                            <div class='row about-list'>
                                <div class'col-md-6'>
                                   
                                    <div class='media'>
                                        <label>First Name</label>
                                        <p>$first_name</p>
                                     
                                    </div>
                                    <div class='media'>
                                        <label>Last Name</label>
                                        <p>$last_name</p>
                                    </div>
                                    <div class='media'>
                                        <label>Gender</label>
                                        <p>$gender</p>
                                    </div>
                                    <div class='media'>
                                        <label>Father Name</label>
                                        <p>$f_name</p>
                                    </div>
                                    <div class='media'>
                                        <label>Mother Name</label>
                                        <p>$m_name</p>
                                    </div>
                                    <div class='media'>
                                        <label>Date of Birth</label></label></label>
                                        <p>$dob</p>
                                    </div>
                                    <div class='media'>
                                        <label>Email</label>
                                        <p>$email</p>
                                        
                                    </div>
                                              
                                    <div class='media'>
                                    <label>Address</label>
                                    <p>$addres</p>
                                   </div>
                                   <div class='media'>
                                   <label>Pancard Number</label>
                                   <p>$pancard</p>
                               </div>
                          
                                     </div>


                                     <div class='col-md-6' >
                                     <div class='media'>
                                     <label>Phone Number</label>
                                     <p>$phone</p>
                                 </div>
                                 <div class='media'>
                                     <label>Policy Applied</label>
                                     <p>$policyName</p>
                                 </div>
                                 <div class='media'>
                                     <label>Policy Category</label>
                                     <p>$policyCat</p>
                                 </div>
                                 <div class='media'>
                                     <label>Policy Premium</label>
                                     <p>4th $policyPremium</p>
                                 </div>
                                 <div class='media'>
                                     <label>Policy Sum Assurred</label>
                                     <p>$policyCoverage</p>
                                 </div>                       

                                 <div class='media'>
                                     <label>Unique Insurance Id</label>
                                     <p>$unique_id</p>
                                 </div>
                                 <div class='media'>
                                     <label>Date Applied</label>
                                     <p>$newDate at $newTime</p>
                                 </div>
                                     
                                     
                                     </div>
                                    ";?>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <?php
                        echo "
                                           <div class='about-avatar'>
                                           <p>Pan Card</p>
                                           <img src='$pathOfUserDoc$pan_image' title='Pan Image' alt=''>
                                           <p>Aadhar Card</p>
                                            <img src='$pathOfUserDoc$aadhar_image' title='Aadhaar Image' alt=''>
                                         
                                            </div>
                        
                        ";
                        
                        ?>
            
                    </div>
                    <div class="col-lg-2">
                        <?php
                        echo "
                                           <div class='about-avatar'>
                                             <p>Medical Doc</p>
                                             <img src='$pathOfUserDoc$medical_image' title='Medical Image' alt=''>
                                             <p>User Image</p>
                                            <img src='$pathOfUserDoc$pass_image' title='Passport Image' alt=''>
                                            </div>
                        
                      
                    </div>
                </div>";
                    
                $DownloadButton="<button type='button' class='btn btn-success mx-2 my-2' onclick='myDownload()'>Print Application</button>";
                  echo $DownloadButton;
                        ?>
                   
        </section>




<script src="../static/js/admin.js">

</script>
</body>
<?php
echo $print;


//THIS CODE IS MAKING PROBLEM THE LIBRARY CLASS IS NOT IDENTIFIED IT SAYS BUT 
// I HAVE USED AS DEFIEND on mpdf library avaiable on github/mpdf 
use Mpdf\Mpdf;
require_once __DIR__ .'/vendor/autoload.php';
$mpdf->new mPDF();
$mpdf->WriteHTML('<h1>Hi</h1>');
$mpdf->Output('myfile.pdf','D');

?>
</html>