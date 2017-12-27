
<?php 
$link = mysqli_connect('localhost','root','','chat');
$result = mysqli_query($link,"SELECT * FROM chat WHERE (Sender='user1' AND WantToChat='user2') OR (Sender='user2'  AND WantToChat= 'user1') ORDER by Msg_ID DESC "); 


	while($extract = mysqli_fetch_array($result)){ 
			if ($extract['WantToChat']=='user1') {
				# code...
				echo "user1"."<br>";
				echo $extract['Message']." ".$extract['WantToChat']." ".$extract['Sender']."<br>";
				echo "<br>";
			}
			else if ($extract['WantToChat']=='user2'){
				# code...
	echo "user2"."<br>";
	echo $extract['Message']." ".$extract['WantToChat']." ".$extract['Sender']."<br>";
	echo "<br>";
			}
			
	} 	
?>﻿


	