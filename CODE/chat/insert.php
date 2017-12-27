
<?php 
session_start();
//SELECT DISTINCT WantToChat FROM chat WHERE Sender='user2' 
//SELECT COUNT(DISTINCT WantToChat) FROM chat WHERE notification=1 
//SELECT DISTINCT WantToChat FROM chat WHERE notification=1 
//SELECT DISTINCT WantToChat FROM chat WHERE notification='1' and Sender='user2' 
if($_GET){
		$uname = $_SESSION['receivername'];

    }
else{
      
    	$uname = $_SESSION['receivername'];
    }




$Loginusername = $_SESSION['Loginusername'];

$msg = (isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null);

echo $Loginusername."<br>";
echo $uname."<br>";

$link = mysqli_connect('localhost','root','','home');

mysqli_query($link,"INSERT INTO chat(Msg_ID,Sender, Message,notification,WantToChat) VALUES(null,'$uname', '$msg','1','$Loginusername')"); 


$result1 = mysqli_query($link,"SELECT * FROM chat WHERE (Sender='$uname' AND WantToChat='$Loginusername') OR (Sender='$Loginusername'  AND WantToChat= '$uname') ORDER by Msg_ID DESC "); 

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>

	<div id="location">
	<table border="2">
	<h2 style="color: #006600">Messages...</h2>

	<tbody >
	<div>
		
	
<?php
	while($extract = mysqli_fetch_array($result1)){ 
			if ($extract['WantToChat']==$Loginusername) {
				
				
				echo "<div class='sender'>
				<div class='self'>".$extract['Message']."</div>
				
				</div>";
			}
			else {
				
				echo "<div class='receiver'>
				<div class='friend'>".$extract['Message']."</div>
				
				</div>";
			}
			
			
	} 	
?>﻿
		</div>
	</tbody>
		
	</table>
</div>
	
	</body>
	</html>



	