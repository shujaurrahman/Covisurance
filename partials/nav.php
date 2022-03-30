<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbaar+Codes for different pages based on condition</title>
</head>
<body>
<?php




// session================================================================
if (!isset($_SESSION)) {
    session_start();    
}






// login condition=======================================================
$boolLoggedIn = false;
if (isset($_SESSION) and isset($_SESSION['username'])) {
    $boolLoggedIn = true;
    $currentUser = $_SESSION['username'];
     
}
else{
  $currentUser=null;
}








// $website = "";
// Variable for linking flies urls ============================================
$signUp = "$website/sign up/signup.php";
$profile = "$website/user profile/profile.php";
$logOut = "$website/logout/logout.php";
$contactUs = "$website/contact us/contactus.php";
$claim= "$website/claim/claim.php";
$homePage = "$website/index.php";
$userProfile="$website/user profile/profile.php";
$testimonial="$website/testimonial/testimonial.php";





// Discrete block that changes for different blocks 
// to be displayed at differend place ======================================

$headBlock = '<div class="logo">
              <img src"" class="logoimg"alt="" />
              </div>';

$homeBlock =  "<a href='$homePage' class='home'>Home</a>";
$claimBlock="<a href='$claim'>Claim</a>";
$testimonialBlock="<a href='$testimonial'>Post Testimonial</a>";
$signUpBlock="<a href='$signUp' class='btn'>Get Started</a>";
$contactUsBlock = "  <a href='$contactUs'>Contact us</a>";







// ========================================Policies Dynamic session and Condition to fect all cards 
//  at one place when admin adds any policies to database==============================================================



$fetch = false;
$policyCard ="";
$sql = "SELECT * FROM `policycards`";
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

        // echo $policyName;

        
        // polcies image are randomly inserted for every card that while loop fetches from database
        $random=rand(1,15);
        if($boolLoggedIn){        
          $policyImage="../static/img/$random.svg";
        }
          else{
            $policyImage="./static/img/$random.svg";
          }
         
           
          // $uniqueCustomerid=$id.$currentUser;
          // echo $uniqueCustomerid;
          if($boolLoggedIn){
            $apply="../apply policy/applypolicy.php?category=$policyCat&policyName=$policyName&premium=$policyPremium&coverage=$policyCoverage&id=$id";
            
            }
            else{
              $apply='index.php';

            }
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



    <a href='$apply' type='submit' class='btn small'>Apply Now</a>
    <p class='title-sm' style='font-size: 15px; margin:15px 10px;'> Posted on $newDate</p>
    <p class='title-sm' style='font-size: 15px; margin:15px 10px;'> at $newTime</p>




  </div>
</div>
</div>";
}

}

// 





// ======================================policy cards data variable ================================




$policyCardBlock="<section class='services section' id='services'>
<div class='container'>
  <div class='section-header'>
    <h3 class='title' data-title='COVID-19'>Insurance Plans</h3>
    <p class='text'>
      We offer comprehensive policies that provide insurance for
      eventualities. Opt for a suitable corona insurance policy.
    </p>
  </div>

  <div class='cards'>
     $policyCard
  </div>
</div>
</section>";



// policies that user has applied will be shown =================================================






// Sql Test for the specific user so that he can not turn more than one policy to claimed process ===========================================



$fetch = false;
$userpolicyCard ="";
$sql = "SELECT * FROM `appliedpolicy` Where `username`='$currentUser'";
$result = mysqli_query($conn,$sql);
$aff = mysqli_affected_rows($conn);
if($aff<1){
  $fetch = false;
}
else{
  $fetch = true;
}

if ($fetch) {
    $boolAlreadyClaimed = false;
    $innerSql = "SELECT * FROM `appliedpolicy` Where `username`='$currentUser' and `action` = 1 ";
    $resultSql = mysqli_query($conn,$innerSql);
    $innerAff = mysqli_affected_rows($conn);
    if($innerAff > 0){
      $boolAlreadyClaimed = true;
    }

    $claimhref="";
    while($data = mysqli_fetch_object($result)){
        $id=$data->{"id"};
        $policyCat = $data->{'p_cat'};
        $policyName = $data->{'p_name'};
        $unique_id = $data->{'unique_id'};
        $policyPremium = $data->{'p_premium'};
        $policyCoverage = $data->{'p_coverage'};
        // $actionformypolicies=$data->{'action'};
        $date = $data->{'date'};
        $newDate = date("j-F Y", strtotime($date));
        $newTime = date("l, g:i a", strtotime($date));
        $action=$data->{'action'};
         
        if($action==0){
          $action="Insured";
          $details="Your Unique Insuranse Id for this Policy:  $unique_id
          Do not Share this with anyone. this will be needed when you will claim policy.";
          if(!$boolAlreadyClaimed){
            $claimhref="../claim/claim.php";
          }
        }
        if($action==1){
          $action="Claimed,Download Application";
          $details="You have Claimed this policy with Id $unique_id,Once admin Verifies details Admin will call on 
          phone Number and ask for bank details and Sum assured will be transfered to you";
          $claimhref="../claim/userpage.php?id=$id";
        }
        if($action==2){
          $action="Approved, Print Applicaition";
          $details="Congratulations, Your claim of Id no $unique_id has been approved and assured money is transferred Check
          your funds in account. If any questions feel free to contact us.";
          $claimhref="../claim/userpage.php?id=$id";
        }
        if($action==3){
          $action="Disapproved, Discrepancy found";
          $details="Sorry, Your policy with Id $unique_id details didn't matach with our records.
          we found discrepancy in your documents or details. If any questions feel free to contact us.";
        }
        // echo $policyName;

        
        // polcies image are randomly inserted for every card that while loop fetches from database
        $random=rand(1,15);
        if($boolLoggedIn){        
          $policyImage="../static/img/$random.svg";
        }
          else{
            $policyImage="./static/img/$random.svg";
          }
         

        //the actual policy card ,note all cards are fetched from the db which are uploaded by admin
        //while loops iterates all the cards to the user profile if logged in else on index page 
        $userpolicyCard .= " <div class='card-wrap'>
     <div class='card'>
     <div class='card-content z-index'>
     <img src='$policyImage' alt'image'>
    <p class='title-sm' style='font-size: 18px; margin:15px 10px'>$policyCat</p>
    <h3 class='title-sm'>$policyName</h3>
    <p class='text'>
  $details
    </p>
    <p class='title-sm' style='font-size: 17px; margin:10px'>Premium $policyPremium</p>
    <p class='title-sm' style='font-size: 15px; margin:15px 10px'> Cover upto $policyCoverage lakhs</p>



    <a href='$claimhref' type='submit' class='btn small'>$action</a>
    <p class='title-sm' style='font-size: 15px; margin:15px 10px;'> on $newDate</p>
    <p class='title-sm' style='font-size: 15px; margin:15px 10px;'> at $newTime</p>




  </div>
</div>
</div>";
}

}

// 
if($fetch){
$userpolicyCardBlock="<section class='services section' id='services'>
<div class='container'>
  <div class='section-header'>
    <h3 class='title' data-title='Your'>Insurance Policies</h3>
    <p class='text'>
          You have applied for these policies,
          Claim in hour of need we are there for you always...!!
    </p>
  </div>

  <div class='cards'>
     $userpolicyCard
  </div>
</div>
</section>";}
else{
  $userpolicyCardBlock="<section class='services section' id='services'>
<div class='container'>
  <div class='section-header'>
    <h3 class='title' data-title='You Have No'> Insured Policies</h3>
    <p class='text'>
         Looks Like you haven't insured yourself against Covid!!
         Do it Now and get fully insured against deadly covid...
    </p>
  </div>
</div>
</section>";
}





// ========================================Policies Conditions End Here========================================================

$payments="";
// Payments section for user who have insured 

        //  Testing payment only awailable when user has claimed any policy otherwise not 
        
  
        $fetch = false;
        $sql = "SELECT * FROM `appliedpolicy` Where `username`='$currentUser' and `action` = 0";
        $result = mysqli_query($conn,$sql);
        $aff = mysqli_affected_rows($conn);
        if($aff<1){
          $fetch = false;
        }
        else{
          $fetch = true;
        }
        
        if ($fetch) {
            $innerSql2 = "SELECT * FROM `appliedpolicy` Where `username`='$currentUser' and `action` = 0 ";
            $resultSql2 = mysqli_query($conn,$innerSql2);
            $data = mysqli_fetch_object($resultSql2);
                $id=$data->{"id"};
                $policyName = $data->{'p_name'};
                $unique_id = $data->{'unique_id'};
                $policyPremium = $data->{'p_premium'};
                $policyCoverage = $data->{'p_coverage'};
                $date = $data->{'date'};
                $newDate = date("j-F Y", strtotime($date));
                $newTime = date("l, g:i a", strtotime($date));
                  

$payments="<section class='chat-us' id=''>
<div class='container'>
  <h3 class='title' data-title='Pay your premium for'>$policyName <h4>With Id $unique_id</h4></h3>
  <p class='text'>
    Pay your Current Active policy premium here for $policyName that covers
    $policyCoverage everymonth.<br> Otherwise admin will Disapprove  your application
    of claim when you will process it. <br>
    You have applied this policy on $newDate at $newTime,
    Pay in +5 to +10 <br> days ahead of policy applied date of every month.
    If you have any questions, don't <br> hesitate talk with us! 
     Send your Question through Contact us section our admin will answer!
  </p>
<div class='razorpay-embed-btn' data-url='https://pages.razorpay.com/pl_J875FCFkuOEgcL/view' data-text='Pay Now' data-color='#00ADB5' data-size='large'>
  <script>
    (function(){
      var d=document; var x=!d.getElementById('razorpay-embed-btn-js')
      if(x){ var s=d.createElement('script'); s.defer=!0;s.id='razorpay-embed-btn-js';
      s.src='https://cdn.razorpay.com/static/embed_btn/bundle.js';d.body.appendChild(s);} else{var rzp=window['__rzp__'];
      rzp && rzp.init && rzp.init()}})();
  </script>
</div>

</div>
</section>
</main>";
      }
else{
  $id="";
  $policyName = "";
  $unique_id = "";
  $policyPremium = "";
  $policyCoverage = "";
  $date = "";
  $newDate = "";
  $newTime = "";
}



// different condition to change assigned as variable blocks when user is logged in =============



if($boolLoggedIn){
  $profileBlock= "<a href='$userProfile' class='active'>$currentUser</a>";

}
else{
   if($_SERVER['REQUEST_URI']!=$homePage)
   $signInBlock = "<a href='$homePage' class='active' id='openBtn'>Sign in</a>";
   else{
   $signInBlock = "<a href='#' class='active' id='openBtn'>Sign in</a>";
   }

}
if(!$boolLoggedIn){
if($_SERVER['REQUEST_URI']=$claim){
  $claimBlock="<a href='$homePage'>Claim</a>";
}
}
if ($boolLoggedIn) {
    echo "
    <nav>
    <div class='container'>
      $headBlock
      <div class='links'>
        $homeBlock
        $claimBlock
        $testimonialBlock
        $contactUsBlock
        $profileBlock
      </div>
      <div class='hamburger-menu'>
        <div class='bar'></div>
      </div>
    </div>
  </nav>

";
}
else{
    echo "
    <nav>
    <div class='container'>
        $headBlock
      <div class='links'>
        $homeBlock
        $claimBlock
        $testimonialBlock
        $contactUsBlock

        $signInBlock
      </div>
      <div class='hamburger-menu'>
        <div class='bar'></div>
      </div>
    </div>
  </nav>

";
}

?>

</body>
</html>
