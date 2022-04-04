<?php 
require "../partials/conn.php";
$boolAdminLoggedIn = false;
session_start();
if(isset($_SESSION) and isset($_SESSION["adminusername"])){  
	 $currentName=$_SESSION["adminusername"];
    $boolAdminLoggedIn = true;  
    	header("location: ./home.php"); 
}


// One Timer


// $name = "Shuja ur Rahman";
// $adminPassword = "Opssasur@786";
// $username = "Adminshuja";

// $passwordHash = password_hash($adminPassword,PASSWORD_DEFAULT);

// $sql = "INSERT INTO $tableName(`username`,`password`,`name`)
//         VALUES('$username','$passwordHash','$name')";
// $result = mysqli_query($conn,$sql);


$boolAdminUserFound = false;
$boolAdminPasswordMatch = false;


$alertMssg = "";
$alertError = "";
$alertDisplay = "none";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $currentUsername = $_POST["username"];
    $userPassword = $_POST["password"];
    $sql = "SELECT * FROM `admins` where `username` = '$currentUsername';";
    $result = mysqli_query($conn,$sql);
    $aff = mysqli_affected_rows($conn);

    if($aff===1){
      $boolAdminUserFound = true;
    }
    elseif($aff!==1){
      $boolAdminUserFound = false;    }
    else{
      $alertDisplay="none";
    }


    if($boolAdminUserFound){
        $data = mysqli_fetch_object($result);
        $passwordInDatabase = $data->{"password"};
        if(password_verify($userPassword,$passwordInDatabase)){
            $boolAdminPasswordMatch = true;   
            session_start();
            $_SESSION["adminusername"] = $currentUsername;
            $status = "Online now";
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE email = 'adminshuja@gmail.com'");
            $_SESSION['unique_id'] = 123456789; 
            $_SESSION['email'] = 'adminshuja@gmail.com';    
            header("location: ./home.php");
        }
        elseif(!password_verify($userPassword,$passwordInDatabase)){
            $boolAdminPasswordMatch =false;
        }
    }

 
}

?>
  <link rel="stylesheet" href="style.css">
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
<body>

  <div class="wrapper">
    <section class="form login">
  <?php  
                   if($_SERVER["REQUEST_METHOD"]=="POST"){
                            $alertDisplay = "block"; 
                            $alertMssg="Username Not Found!!!,This is admin Area..";
                            $alertError = "class = 'error'";
                           if($aff!==1){
                            echo "<p $alertError style='display: $alertDisplay;'> $alertMssg</p>";
                            }
                          elseif(!$boolAdminPasswordMatch){
                            $alertDisplay = "block"; 
                            $alertMssg="Admin Your password doesn't Match.";
                            $alertError = "class = 'error'";
                            echo "<p $alertError style='display: $alertDisplay;'> $alertMssg</p>";
                          }
                        }
 ?>
    <div class="nav-login-admin links">
      <img src="../static/img/logo.png" class="logo-img logo" alt="">
      <a href="../index.php">Home</a>
    </div>
      <header>Admin Login</header>
      <form action="index.php" method="POST">
        <div class="error-text"></div>
        <div class="field input">
          <label>Username</label>
          <input type="text" name="username" placeholder="ADMIN, Enter your Username" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Login">
        </div>
      </form>
    </section>
  </div>
</body>
</html>
