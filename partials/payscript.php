<?php
$boolLoggedIn = false;
session_start();
if(isset($_SESSION) and isset($_SESSION["username"])){  
	$currentName=$_SESSION["username"];
    $boolLoggedIn = true;   
}
else{
  header("Location ../index.php");
}

require "../partials/conn.php";
 $apiKey = "YOUR API KEY";
$id=$_GET['id'];
$sql = "SELECT * FROM `appliedpolicy`  WHERE `id`=$id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_object($result);
$first_name=$data->{"first_name"};
$last_name=$data->{"last_name"};
$policyPremium=$data->{"p_premium"};
$phone=$data->{"phone"};
$unique_id=$data->{"unique_id"};
$email=$data->{"email"};


?>

<title>Covisurance Payment Gateway</title>

<script src="https://code.jquery.com/jquery-3.5.0.js"></script>


<?php
echo "
<form action='../user profile/profile.php?paymentsuccess&id=$id' method='POST'>";
?>
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $apiKey; ?>" 
    data-amount="<?php echo $policyPremium*100;?>" 
    data-currency="INR"
    data-id="<?php echo $unique_id;?>"
    data-buttontext="Pay with Razorpay"
    data-name="Covisurance"
    data-description="Premium Insurances!"
    data-prefill.name="<?php $first_name.$last_name;?>"
    data-prefill.email="<?php echo $email;?>"
    data-prefill.contact="<?php echo $phone;?>"
    data-theme.color="#00ADB5"
></script>
<input type="hidden" custom="Hidden Element" name="hidden">
</form>
<style>
    .razorpay-payment-button{
        display: none;
    }
</style>
<script>
    $(document).ready(function(){
           $('.razorpay-payment-button').click();
    });
</script>

