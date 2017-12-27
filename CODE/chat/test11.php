<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<form action="test10.php" method="POST">


<button type="button" name="submit" onClick="document.getElementById('notificationId').style.display='none';">Close</button>
<input type="submit" name="submit" onclick="document.getElementById('notificationId').style.display='none';" value="CLOSE"/>
</form>
<?php
if(isset($_POST['submit'])){
	$link=mysqli_connect('localhost','root','','chat');
	$query = "SELECT DISTINCT WantToChat FROM chat WHERE notification='1' and Sender='user2' ";
	$result= mysqli_query($link,$query);
	if(mysqli_num_rows($result) > 0){
?>
<div class="container">
<ul id="notificationId" class="list-Group">
<?php
		while($row = mysqli_fetch_assoc($result)){
?>
            <li class="list-group-item">
            <a href="#"><?php echo $row["WantToChat"]; ?></a>
            <a href="#">GO</a>
            </li>
<?php
		}
	}
}
?>
</ul>
</div>
</body>
</html>