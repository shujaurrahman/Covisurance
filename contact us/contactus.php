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
if (isset($_SESSION) and isset($_SESSION['username'])) {
    $currentUser = $_SESSION['username'];
    $boolLoggedIn = true;
} else {
     $currentUser="Anonymous,Not registered";
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
                  $email = $_POST["email"];
                  $subject = $_POST["subject"];
                  $message = $_POST["message"];
                $sql="INSERT INTO `contactus`(`username`, `name`, `email`, `subject`, `message`) VALUES ('$currentUser','$name','$email','$subject','$message')";
                $result = mysqli_query($conn,$sql);
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

    <title>Contact Form</title>
  </head>
  <body>
  
   <?php
   
            require "../partials/nav.php";
                    $alerMssg = "";
                    $alertError = "";
                    $alertDisplay = "none";
                  if($_SERVER["REQUEST_METHOD"] == "POST"){
                  $alertMssg = "Your Message was submitted.";
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
              
              <h3 class="heading mb-4">Send us a Message!</h3>
              <p>If you have any querry related to anything or want to give us feedback. Feel free to contact us.</p>

              <p><img src="../static/img/contact/contact.svg" alt="Image" class="img-fluid"></p>


            </div>
            <div class="col-md-6">
              
              <form class="mb-5" action="contactus.php" method="POST">
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="name" id="name"  placeholder="Your name" required>

                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="email" id="email"  placeholder="Email" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="subject" id="subject"  placeholder="Subject" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <textarea class="form-control" name="message" id="message" cols="30" rows="7"  placeholder="Write your message" required></textarea>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-12">
                    <input type="submit" value="Send Message" class="btn btn-primary rounded-0 py-2 px-4">
                  <span class="submitting"></span>
                  </div>
                </div>
              </form>

              <div id="form-message-warning mt-4"></div> 
              <div id="form-message-success">
                Your message was sent, thank you!
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
   <script src="../static/js/contact-us.js"></script>
  </body>
</html>