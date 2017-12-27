<?php
include_once("db_connection.php");
$ip=$_SERVER['REMOTE_ADDR'];
date_default_timezone_set("Asia/Dhaka");
//echo "The time is " . date("h:i:sa");
$time=date("h:i:sa");
//echo $time;


$sql="SELECT ip from visitors where ip='$ip'";

$result = mysqli_query($conn, $sql);
$CheckIp=mysqli_num_rows($result);
//echo $CheckIp;
if($CheckIp==0)
{
    $query="INSERT INTO visitors (date,ip) VALUES ('$time','$ip')";
    mysqli_query($conn, $query);
}
else
{
    $query_update="UPDATE  visitors  SET date=now() WHERE ip='$ip'";
    mysqli_query($conn, $query_update);

}

?>