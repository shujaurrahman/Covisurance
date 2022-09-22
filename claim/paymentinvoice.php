<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
<style>
	.error {
		margin-top:10%;
        color: black;
        font-size: 15px;
        font-weight: 600;
        background: #71C9CE;
        width: 100%;
        text-align: center;
        padding: 1rem;
		font-family: 'Montserrat', sans-serif;
    }
	img{
		width: 50%;
		height: 50%;
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
$first_name="";
$last_name="";
$gender="";
$dob="";
$f_name="";
$m_name="";
$email="";
$addres="";
$policyName="";
$policyCat="";
$policyPremium="";
$policyCoverage="";
$pancard="";
$phone="";
$pan_image="";
$aadhar_image="";
$medical_image="";
$pass_image="";
$unique_id="";
$userName="";
$action="";
$date="";
$newDate =""; 
$newTime =""; 
$subject="";
$msg="";
$msgend="";
require "../partials/conn.php";

$innerSql2 = "SELECT * FROM `payments` Where `username`= '$currentName'";
$resultSql2 = mysqli_query($conn,$innerSql2);
$data = mysqli_fetch_assoc($resultSql2);
$paid_on=$data["date"];
$time=$data["time"];
$due_date=$data["next_date"];
$forign_id=$data['id_pol'];

$sql = "SELECT * FROM `appliedpolicy`  WHERE `username`='$currentName' AND `id`=$forign_id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_object($result);
$first_name=$data->{"first_name"};
$last_name=$data->{"last_name"};
$email=$data->{"email"};
$addres=$data->{"address"};
$policyName=$data->{"p_name"};
$policyCat=$data->{"p_cat"};
$policyPremium=$data->{"p_premium"};
$policyCoverage=$data->{"p_coverage"};
$phone=$data->{"phone"};
$unique_id=$data->{"unique_id"};
$userName=$data->{"username"};


$subject="$policyName Payments Success.";
$msg="<strong>Congratulations!</strong> Your Premium Payment for $policyName. Email has an attachment with your Payment details. <br>";
$msgend="<i>Please ignore this message if this wasn't you.</i>";

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
<div style="text-align: right">'.$paid_on.$time.'</div>
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
<td align="center">7</td>
<td align="center">Email</td>
<td>'.$email.'</td>
</tr>
<tr>
<td align="center">8</td>
<td align="center">Address</td>
<td>'.$addres.'</td>
</tr>
<tr>
<td align="center">9</td>
<td align="center">Policy</td>
<td>'.$policyName.'</td>
</tr>
<tr>
<td align="center">10</td>
<td align="center">Policy Category</td>
<td>'.$policyCat.'</td>
</tr>
<tr>
<td align="center">11</td>
<td align="center">Policy Premium</td>
<td>'.$policyPremium.'</td>
</tr>
<tr>
<td align="center">12</td>
<td align="center">Policy Coverage</td>
<td>'.$policyCoverage.'</td>
</tr>
<tr>
<td align="center">14</td>
<td align="center">Phone Number</td>
<td>'.$phone.'</td>
</tr>
<tr>
<td align="center">15</td>
<td align="center">Your Unique Insurance ID</td>
<td>'.$unique_id.'</td>
</tr>












</tbody>
</table>
</strong>
<p>
<br><br>
(PAYMENT WAS COMPLETED ON '.$paid_on.'at'.$time.')

</p>

<br><br>
<div style="text-align: center; font-style: italic;">Payment terms: Next payment Installment date is '.$due_date.'</div>
</body>
</html>
';

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path .'/vendor/autoload.php';

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
$mpdf->SetAuthor("Covisurance");
$mpdf->SetWatermarkText("covisurance");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');

$mpdf->WriteHTML($html);

$mpdf->Output('./pdf/'.$currentName.'paymentslip.pdf','F');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
$m = new PHPMailer(true);

$m->isSMTP();                                            
$m->Host      = 'smtp.gmail.com';                     
$m->SMTPAuth   = true;    
$m->SMTPSecure = 'tls';                             
$m->Username   = 'covisurance@gmail.com';                     
$m->Password   = 'imfqdtfdtgkbqqbt';                               
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
$m->addAttachment('./pdf/'.$currentName.'paymentslip.pdf');                                  
$m->send();

unlink('./pdf/'.$currentName.'paymentslip.pdf');
echo "
<script>
  window.location = '../index.php?paymentinvoicemailed';
</script>
";
$sql2="UPDATE `notify` SET `pdf`= '1' WHERE `username`='$currentName'";
$result2=mysqli_query($conn,$sql2);

?>