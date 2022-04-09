<?php
require "./partials/conn.php";
// get user details
$user_agent = $_SERVER['HTTP_USER_AGENT']; //user browser
$ip_address = $_SERVER["REMOTE_ADDR"];     // user ip adderss
$page_name = $_SERVER["SCRIPT_NAME"];      // page the user looking
$query_string = $_SERVER["QUERY_STRING"];   // what query he used
$current_page = $page_name."?".$query_string; 


// get location 
$url = json_decode(file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=22d265ec49b289c305bcc83eb00a8572559e506fbd2a648fae444533146b172f&ip=".$_SERVER['REMOTE_ADDR']."&format=json"));
$country=$url->countryName;  // user country
$city=$url->cityName;       // city
$region=$url->regionName;   // regoin
$latitude=$url->latitude;    //lat and lon
$longitude=$url->longitude;

// get time
date_default_timezone_set('UTC');
$date = date("Y-m-d");
$time = date("H:i:s");
$count=1;
$sql="INSERT INTO `visitors`(`browser`, `ip`, `county`, `city`, `region`, `latitude`, `longitude`, `date`, `time`,`count`) VALUES
('$user_agent','$ip_address','$country','$city','$region','$latitude','$longitude','$date','$time','$count')";
$result=mysqli_query($conn,$sql);

$sql2="SELECT * FROM `visitors` WHERE `ip`='$ip_address'";
$result2=mysqli_query($conn,$sql2);
$aff=mysqli_fetch_row($result2);
if($aff>0){
    $sql2="SELECT * FROM `visitors` WHERE `ip`='$ip_address'";
    $result2=mysqli_query($conn,$sql2);
    $data = mysqli_fetch_object($result2);
    $old_count = $data->{'count'};
    $update_count=$old_count+1;
    $sql3="UPDATE `visitors` SET `count`='$update_count'";
    $result3=mysqli_query($conn,$sql3);

}


?>