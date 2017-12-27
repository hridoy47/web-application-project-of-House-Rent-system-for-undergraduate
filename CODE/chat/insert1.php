
<?php 
session_start();

$Loginusername =  $_SESSION['Sendername'];
$uname = $_SESSION['receivername'];
$msg = (isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null);

$link = mysqli_connect('localhost','root','','chat');


mysqli_query($link,"INSERT INTO chat(Msg_ID,Sender, Message,WantToChat) VALUES(null,'$uname','$msg','$Loginusername')"); 

$result = mysqli_query($link,"SELECT * FROM chat WHERE (Sender='$uname' AND WantToChat='$Loginusername')  ORDER by Msg_ID DESC "); 

?>
	<!DOCTYPE html>
	<html>
	<head>
		<title></title>

	</head>
	<body>

	<div id="location">
	<table border="2">
	<h2 style="color: #006600">Messages...</h2>

	<tbody >
	
		
	
<?php
	while($extract = mysqli_fetch_array($result)){ 
			echo $extract['Message']."<br>";
			echo $extract['WantToChat']."<br>";
			echo "----------------------------------------------------------------------------"; 
			
	} 	
?>﻿
		
	</tbody>
		
	</table>
</div>
	
	</body>
	</html>



	