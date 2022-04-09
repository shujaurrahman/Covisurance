<?php 
require "../partials/conn.php";
session_start();
$boolLoggedIn = false;
if (isset($_SESSION) and isset($_SESSION['adminusername'])) {
    $currentUser = $_SESSION['adminusername'];
    $boolLoggedIn = true;
}


$alertMssg = "";
$alertError = "";
$alertDisplay = "none";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $category = $_POST["category"];
    $Password = $_POST["password"];
    $passwordHash = password_hash($Password,PASSWORD_DEFAULT);
    $sql = "INSERT INTO `admins` (`username`,`password`,`name`,`category`) VALUES ('$name','$passwordHash','$name','$category')";
    $result = mysqli_query($conn,$sql);
    if($result){
         $alertDisplay = "block"; 
         $alertMssg="New Sub Admin Added";
         $alertError = "class = 'error'";
         header("location: ./admins.php");
        
    }                       
}

?>

  <title>Add Admin </title>
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
                            echo "<p $alertError style='display: $alertDisplay;'> $alertMssg</p>";
                        }
                 
 ?>
           <div class="nav-login-admin links">
      <img src="../static/img/logo.png" class="logo-img logo" alt="">
      <a href="./admins.php">Go Back</a>
    </div>
      <header>Add New Admin</header>
      <form action="#" method="POST">
        <div class="error-text"></div>
        <div class="field input">
          <label>Name</label>
          <input type="text" name="name" placeholder="Enter Name for Admin" required>
        </div>
        <div class="field input">
          <label>Username</label>
          <input type="text" name="username" placeholder="Enter Username for Admin" required>
        </div>
        <div class="field input">
          <label>Category</label>
          <input type="text" name="category" placeholder="Enter category for Admin" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter Password For Admin" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Add New Admin">
        </div>
      </form>
    </section>
</body>
</html>

