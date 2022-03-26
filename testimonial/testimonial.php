<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <?php 
        require "../partials/conn.php";
       require "../partials/link.php";
       require "../partials/linkbootstrap.php";
      //  require "../partials/dballusers.php";
      session_start();
      $boolLoggedIn = false;
      $currentUser = "";
      if (isset($_SESSION) and isset($_SESSION['username'])) {
          $currentUser = $_SESSION['username'];
          $boolLoggedIn = true;
      } else {
          $currentUser="Anonymous,Not registered with us";
      }


// if ($boolLoggedIn) {
//     $sql = "SELECT * FROM $tableName Where `username` = '$currentUser'";
//     $result = mysqli_query($conn, $sql);
//     $data = mysqli_fetch_object($result);
//     $firstName = $data->{"first_name"};
//   	$firstName = mysqli_real_escape_string($conn,$firstName);
//   	$firstName = stripcslashes($firstName);
//     $firstName = htmlspecialchars($firstName);
//     $lastName = $data->{"last_name"};
//     $userName = $data->{"username"};
//     $userEmail = $data->{"email"};
// }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $place = $_POST["place"];
  $message = $_POST["message"];
  $rate = $_POST["rate"];
  $sql= "INSERT INTO `testimonial` (`username`, `name`, `place`,`message`,`rate`) VALUES ('$currentUser','$name','$place','$message','$rate')";
  $result = mysqli_query($conn,$sql);
  // echo mysqli_error($conn);
  if($result){
    echo "
    <script>
    setInterval(() => {
      window.location = '../index.php';
    }, 2500);
    </script>";
}



}

    ?>
    <!-- Style -->
    <link rel="stylesheet" href="../static/css/contact-us.css">
    <link rel="stylesheet" href="../static/css/style.css" />
    <style>
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

    <title>Testimonial</title>
  </head>
  <body>
  
   <?php
   
   require "../partials/nav.php";
          $alerMssg = "";
        $alertError = "";
        $alertDisplay = "none";
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $alertMssg = "Your review was posted we are delighted to serve you,thankyou for Feedback.";
    $alertError = "class = 'error'";
    $alertDisplay = "block";
    echo "<p $alertError style='display: $alertDisplay;'>$alertMssg</p>";
   }
   ?>
  <div class="content">
    
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10">
          

          <div class="row justify-content-center">
            <div class="col-md-6">
              
              <h3 class="heading mb-4">Post a Review!</h3>
              <p>We are delighted to serve you,if you like our services please review us people might find that Helpful.</p>

              <p>
                  
              
         
            <?php

                    $random1=rand(1,8);
                    $random2=rand(1,8);
                    echo "<img src='../static/img/testimonial/$random1.svg' alt='Image' class='img-fluid'>";
                    echo "<img src='../static/img/testimonial/$random2.svg' alt='Image' class='img-fluid'>";

                ?>
            </p>


            </div>
            <div class="col-md-6">
              
              <form class="mb-5" action="testimonial.php" method="POST">
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="name" id="name"  placeholder="Your name" required>

                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="place" id="email"  placeholder="city you belong" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <textarea class="form-control" name="message" id="message" cols="30" rows="7"  placeholder="Write your review" required></textarea>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input class="form-control" name="rate" id="message"   placeholder="Rate in Number (1-5)" required></input>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-12">
                    <input type="submit" value="Post" class="btn btn-primary rounded-0 py-2 px-4">
                  <span class="submitting"></span>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  </body>
</html>