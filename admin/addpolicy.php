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
if (isset($_SESSION) and isset($_SESSION['adminusername'])) {
    $currentUser = $_SESSION['adminusername'];
    $boolLoggedIn = true;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $p_name = $_POST["policyname"];
  $p_cat = $_POST["policycat"];
  $p_disc = $_POST["policydetails"];
  $p_premium = $_POST["policypremium"];
  $p_coverage = $_POST["policycoverage"];

// $sql="INSERT INTO `policycards` (`policycat`, `policyname`, `policydetails`, `policypremium`, `policycoverage`) VALUES ('$p_cat','$p_name','$p_disc','$p_premium','$p_coverage')";
$sql= "INSERT INTO `policycards` (`policycat`, `policyname`, `policydetails`, `policypremium`, `policycoverage`) VALUES ('$p_cat','$p_name','$p_disc','$p_premium','$p_coverage')";
$result = mysqli_query($conn,$sql);
// echo var_dump($result);
if($result){
  echo "
  <script>
  setInterval(() => {
    window.location = './home.php';
  }, 4000);
  </script>";
}

} ?>
    <!-- Style -->
    <link rel="stylesheet" href="../static/css/contact-us.css">
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

    <title>Add a Policy </title>
  </head>
  <body>
  
   <?php
   
   require "./nav.php";
          $alerMssg = "";
        $alertError = "";
        $alertDisplay = "none";
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $alertMssg = "The policy has been added, Policies are reflected at homepage and in user profile. ";
    $alertError = "class = 'error'";
    $alertDisplay = "block";
    echo "<p $alertError style='display: $alertDisplay;'>$alertMssg</p>";
   }
   ?>
  <div class="content">
    
    <div class="container">
      <div class="row justify-content-center">
      <h3 style="margin-left:20%;" class="heading">Add a Policy</h3>
        <div class="col-md-10">
            <div class="col-md-6">
              
              <form class="mb-5" action="addpolicy.php" method="POST">
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="policyname"   placeholder="Policy name" required>

                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                  <select class="form-control" name="policycat" required>
                                    <option value="1">* Category</option>
                                    <option>Basic</option>
                                    <option>Premium</option>
                                    <option>Diamond</option>
                                </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <textarea class="form-control" name="policydetails" cols="30" rows="7"  placeholder="Explain Policy" required></textarea>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input class="form-control" name="policypremium"   placeholder="Policy premium in rupees" required></input>
                  </div>
                </div>  
                <div class="row">
                <div class="col-md-12 form-group">
                    <input class="form-control" name="policycoverage"   placeholder="Policy coverage in rupees" required></input>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-12">
                    <input type="submit" value="Add" class="btn btn-primary rounded-0 py-2 px-4">
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