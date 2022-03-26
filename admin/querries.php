<?php
require "../partials/conn.php";
$boolAdminLoggedIn = false;
session_start();
if(isset($_SESSION) and isset($_SESSION["adminusername"])){  
	$currentName=$_SESSION["adminusername"];
    $boolAdminLoggedIn = true;   
}
else{
    $boolAdminLoggedIn = false;
    header("location: ./index.php");
}

$cardBlock = "";
$boolContactFetch = false;

if($boolAdminLoggedIn){

    $sql = "SELECT * FROM `contactus` ORDER BY s_no DESC;";
    $result = mysqli_query($conn,$sql);

    $aff = mysqli_affected_rows($conn);

    if($aff<1){
        $boolContactFetch = false;
    }
    else{
        $boolContactFetch = true;

        while($data = mysqli_fetch_object($result)){
            $id = $data->{"s_no"};
            $contactName = $data->{"name"};
            $contactEmail = $data->{"email"};
            $contactusername=$data->{"username"};
            $contactMssg = $data->{"message"};
            $contactSub= $data->{"subject"};
            $contactTime = $data->{"date"};
            $newDate = date("j F Y", strtotime($contactTime));
            $newTime = date("l, g:i a", strtotime($contactTime));


            $cardBlock .= "
                            <div class='container mx-5 my-5'>       
                                <div style='background-color:#E3FDFD;' class='card  btn-dark text-dark'>
                                    <div style='background-color:#E3FDFD;' class='card-header'>
                                        $contactName &nbsp &nbsp $contactEmail &nbsp &nbsp $contactusername   
                                    </div>
                                    <div class='card-body'>
                                        <blockquote class='blockquote mb-0'>
                                        <p style='font-size:16px;'>Subject:  $contactSub.</p>
                                        <p> $contactMssg.</p>
                                        <footer class='blockquote-footer'>$newDate  <cite title='Source Title'> $newTime</cite></footer>
                                        </blockquote>
                                    </div>
                                </div>
                                <button type='button' class='btn btn-outline-danger mx-2 my-2' onClick='querryDel($id)'>Delete</button>
                            </div>   ";
        }
    }

}


if($boolContactFetch){
    // for Deletion of the Querry javascript gets this when admin click on del button which activates 
// delquerry function 
$alerMssg = "";
$alertError = "";
$alertDisplay = "none";


if(isset($_GET) and isset($_GET['delquerry'])){
$id= $_GET['delquerry'];
$sql = "DELETE FROM `contactus`  WHERE `s_no` = '$id'";
$result = mysqli_query($conn,$sql);
if($_GET['delquerry']){
    $alertMssg = "The querry has been Deleted.";
    $alertError = "class = 'error'";
    $alertDisplay = "block";
    echo "<p $alertError style='display: $alertDisplay;'>$alertMssg</p>";
}
}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queries</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>";
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
</head>
<body>
<?php require "./nav.php";  ?>

 
        <h1 style="margin-left:10%; color:#71C9CE;">All Queries</h1>

        <?php
            if($boolContactFetch){

                echo $cardBlock;
            }
            else{
                echo "<h1> No Queries </h1>";
            }
        ?>
<script src="../static/js/admin.js"></script>
</body>
</html>
