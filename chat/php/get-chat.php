<?php 
    session_start();
    require "../../partials/conn.php";
$boolLoggedIn = false;
if (isset($_SESSION) and isset($_SESSION['username'])) {
	$currentUser = $_SESSION['username'];
	$boolLoggedIn = true;
} else {
	//   header("Location: ../index.php");
}
if ($boolLoggedIn) {
	$sql = "SELECT * FROM `alluser` Where username ='$currentUser'";
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_object($result);
	$Dimage = $data->{"_image"};
}
if (empty($Dimage)) {
	$profilepic= "<img src='../static/img/default.jpg' alt=''>";
} else {

	$profilepic = "<img src='../userimages/$Dimage' alt='../userimages/deafault.svg'>";
}
    if(isset($_SESSION['unique_id'])){
        include_once "../../partials/conn.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                    
                    <div class="details">
                    
                    <p>'. $row['msg'] .'</p>
                    </div>
                    ' .$profilepic.' 
                    </div>
                    <img class="media-out" src="media/'.$row['media'].'" alt="">
                    ';
                }else{
                    $output .= '<div class="chat incoming">
                    <img src="../userimages/'.$row['img'].'" alt="">
                    <div class="details">
                    <p>'. $row['msg'] .'</p>
                    </div>
                    </div>
                    <img class="media-in" src="media/'.$row['media'].'" alt="">
                    ';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../index.php");
    }
    

?>
