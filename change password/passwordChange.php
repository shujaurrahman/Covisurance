<?php 
session_start();
require "../partials/conn.php";
$boolLoggedIn=false;
if (isset($_SESSION) and isset($_SESSION['username'])) {
    $boolLoggedIn = true;
    $currentUser = $_SESSION['username'];
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
    <link rel="stylesheet" href="../static/css/style.css">
    <style>
		@import url(../static/css/color.css);
		body {
	background: var(--light-two);
	display: flex;
	align-items: center;
	height: 100vh;
	flex-direction: column;
}

*{
	margin: 0;
	padding: 0;
	font-family: sans-serif;
	box-sizing: border-box;
}

form {
	width: 500px;
	border: 2px solid #ccc;
	padding: 30px;
	background: var(--light-three);
	border-radius: 15px;
	margin-top: 40px;
}


h2 {
	text-align: center;
	margin-bottom: 40px;
}

input {
	display: block;
	background-color: var(--light-three);
	border: 1px solid var(--dark-two);
	width: 95%;
	padding: 10px;
	margin: 10px auto;
	border-radius: 5px;
}
input:hover {
	background-color: var(--light-color);
	border: 1px solid var(--dark-two);
	width: 95%;
	padding: 10px;
	margin: 10px auto;
	border-radius: 5px;
}
label {
	color: var(--dark-three);
	font-size: 18px;
	padding: 10px;
}

button {
	float: right;
	background: var(--main-color);
	padding: 10px 15px;
	color: #fff;
	border-radius: 5px;
	margin-right: 10px;
	border: none;
}
button:hover{
	background: var(--light-two);
	color: var(--dark-three);
	opacity: .7;
}
.error {
   background: var(--main-color);
   color: var(--dark-three);
   padding: 10px;
   width: 95%;
   border-radius: 5px;
   margin: 20px auto;
}

.success {
   background: var(--main-color);
   color: var(--dark-three);
   padding: 10px;
   width: 95%;
   border-radius: 5px;
   margin: 20px auto;
}

h1 {
	text-align: center;
	color: #fff;
}


	</style>
</head>
<body>
	<?php
	require '../partials/nav.php';
	


	?>
    <form action="./code.php" method="post">
     	<h2>Change Password</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success'];   
				          echo "
						  <script>
							setInterval(() => {
							  window.location = '../user profile/profile.php';
							}, 1000);
						  </script>
						  ";
			?></p>
        <?php } ?>

     	<label>Old Password</label>
     	<input type="password" 
     	       name="op" 
     	       placeholder="Old Password">
     	       <br>

     	<label>New Password</label>
     	<input type="password" 
     	       name="np" 
     	       placeholder="New Password">
     	       <br>

     	<label>Confirm New Password</label>
     	<input type="password" 
     	       name="c_np" 
     	       placeholder="Confirm New Password">
     	       <br>

     	<button type="submit">CHANGE</button>
          <!-- <a href="../user profile/profile.php" class="ca home-nav" >HOME</a> -->
     </form>
</body>
</html>

<?php 
}else{
     header("Location: ../user profile/profile.php");
     exit();
}
 ?>