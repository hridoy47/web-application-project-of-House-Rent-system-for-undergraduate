<?php
session_start();
    if(isset($_SESSION['username'])){
        $Loginusername = $_SESSION['username'] ;
        $_SESSION['Loginusername'] = $Loginusername;
        echo "You are Logged in as : ".$Loginusername."<br><br>"; 

    }else{
      echo "Url has no user";
    }
	$con =  mysqli_connect('localhost','root','','home');
	$noti = mysqli_query($con,"SELECT * FROM char WHERE notification='1' and Sender=$Loginusername");
	$result1=mysqli_num_rows($noti);
	echo "Your Notification ".$result1;
	while($extract = mysqli_fetch_array($result1)){ 
		
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>