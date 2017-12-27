<?php
session_start();

$conn = mysqli_connect('localhost','root','','chat');


$username = $_POST['username'];
$password = $_POST['password'];
$_SESSION['Sendername'] = $username; 
/*
$username = form1.username.value;
$password = form1.password.value;
*/
$sql = "SELECT * FROM users WHERE UserName='$username' AND UserPassword = '$password'";
$result = $conn->query($sql);
if ($result->num_rows>0) {
	# code...
//	header("Location: index.php?LoginuserName=".$username);

	header("Location: ownerlist.php?LoginuserName=".$username);

}
else{
	header("Location: login.php");
}