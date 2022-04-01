<style>
  .error {
        font-family: Arial, Helvetica, sans-serif;
        color: black;
        font-size: 18px;
        font-weight: 600;
        background: #71C9CE;
        width: 100%;
        text-align: center;
        padding: 1rem;
        margin: 10% 0 20px 0;
    }
</style>
    
<?php
session_start();
if(isset($_SESSION) and isset($_SESSION["username"])){  
	$currentName=$_SESSION["username"];
    $boolLoggedIn = true;   
}
else{
  header("Location ../index.php");
}
require "../partials/conn.php";

$sql = "SELECT * FROM `appliedpolicy`  WHERE `username`='$currentName'";
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
$subject="$policyName Details.";
$msg="<strong>Congratulations!</strong> You Have applied for $policyName. Email has an attachment with your Policies details.
Make sure you have completed your first premuim of Rs. $policyPremium. <br>
if not <a href='https://pages.razorpay.com/pl_J875FCFkuOEgcL/view'>click here</a> to pay first installment otherwise your policy won't be registered by admin.";
$msgend="<i>Please ignore this message if this wasn't you.</i>";
$alertMssg = "Please don't Refrese this page. Sending you to the payment gateway. Please complete payment process.
<br>A Message with policy details as PDF file attachment has been to your Email $email. Please check your inbox
(if not check your spam ) and keep it as a soft copy.";
echo "<p class = 'error' style='display:'block';'>$alertMssg</p>";

$html = '

<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
</style>
</head>
<body>
<!--mpdf
<htmlpageheader name="myheader">
<table width="100%"><tr>
<td width="50%" style="color:#0000BB; "><span style="font-weight: bold; font-size: 14pt;">Covisurance</span><br />Premiun Online Insurances<br />Pilibhit<br /><span style="font-family:dejavusanscondensed;">&#9742;</span>7579966178</td>
<td width="50%" style="text-align: right;">Invoice to.<br /><span style="font-weight: bold; font-size: 12pt;">'.$currentName.'</span></td>
</tr></table>
</htmlpageheader>
<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>
<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->
<div style="text-align: right">'.$newDate.$newTime.'</div>
<br />
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="15%">S. No.</td>
<td width="10%">Details</td>
<td width="45%">Values</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
<tr>
<td align="center">1</td>
<td align="center">First Name</td>
<td>'.$first_name.'</td>
</tr>
<tr>
<td align="center">2</td>
<td align="center">Last Name</td>
<td>'.$last_name.'</td>
</tr>
<tr>
<td align="center">3</td>
<td align="center">Gender</td>
<td>'.$gender.'</td>
</tr>
<tr>
<td align="center">4</td>
<td align="center">Father Name</td>
<td>'.$f_name.'</td>
</tr>
<tr>
<td align="center">5</td>
<td align="center">Mother Name</td>
<td>'.$m_name.'</td>
</tr>
<tr>
<td align="center">6</td>
<td align="center">Date Of Birth</td>
<td>'.$dob.'</td>
</tr>
<tr>
<td align="center">5</td>
<td align="center">Email</td>
<td>'.$email.'</td>
</tr>
<tr>
<td align="center">5</td>
<td align="center">Address</td>
<td>'.$addres.'</td>
</tr>
<tr>
<td align="center">5</td>
<td align="center">Policy</td>
<td>'.$policyName.'</td>
</tr>
<tr>
<td align="center">5</td>
<td align="center">Policy Category</td>
<td>'.$policyCat.'</td>
</tr>
<tr>
<td align="center">5</td>
<td align="center">Policy Premium</td>
<td>'.$policyPremium.'</td>
</tr>
<tr>
<td align="center">5</td>
<td align="center">Policy Coverage</td>
<td>'.$policyCoverage.'</td>
</tr>
<tr>
<td align="center">5</td>
<td align="center">Policy Premium</td>
<td>'.$policyPremium.'</td>
</tr>
<tr>
<td align="center">5</td>
<td align="center">Phone Number</td>
<td>'.$phone.'</td>
</tr>
<tr>
<td align="center">5</td>
<td align="center">Your Unique Insurance ID</td>
<td>'.$unique_id.'</td>
</tr>
<tr>
<tr>
<td align="center">5</td>
<td align="center">PAN no</td>
<td>'.$pancard.'</td>
</tr>
<tr>

</tbody>
</table>
<div style="text-align: center; font-style: italic;">Payment terms: payment due in 30 days</div>
</body>
</html>
';

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
	'margin_left' => 20,
	'margin_right' => 15,
	'margin_top' => 48,
	'margin_bottom' => 25,
	'margin_header' => 10,
	'margin_footer' => 10
]);

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Covisurance");
$mpdf->SetAuthor("Acme Trading Co.");
$mpdf->SetWatermarkText("covisurance");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');

$mpdf->WriteHTML($html);

$mpdf->Output('./pdf/'.$currentName.'.pdf','F');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
$m = new PHPMailer(true);

try {
$m->isSMTP();                                            
$m->Host      = 'smtp.gmail.com';                     
$m->SMTPAuth   = true;    
$m->SMTPSecure = 'tls';                             
$m->Username   = 'covisurance@gmail.com';                     
$m->Password   = 'shuja@123';                               
$m->Port = '587';   
$m->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);                              
$m->setFrom('covisurance@gmail.com', 'Covisurance');
$m->addAddress($email);    
$m->addAddress($email);               
$m->isHTML(true);
$m->Subject = $subject;
$m->Body    = $msg .'</b><br><br>'.$msgend;
$m->AltBody = 'Code Not Generated. Some error Occured';
$m->addAttachment('./pdf/'.$currentName.'.pdf');                                  

$m->send();
}
catch (Exception $e) {
}

unlink('./pdf/'.$currentName.'.pdf');

echo "
<script>
setInterval(() => {
  window.location = 'https://pages.razorpay.com/pl_J875FCFkuOEgcL/view';
}, 6000);
</script>
";

?>