<?php
session_start();
    if(isset($_GET['LoginuserName'])){
        $Loginusername =  $_GET['LoginuserName'] ;// print_r($_GET);
        $_SESSION['Loginusername'] = $Loginusername;
        echo "You are Logged in as : ".$Loginusername."<br><br>"; 

    }else{
      echo "Url has no user";
    }
    /*
    echo "Name : ".$Loginusername."<br></br>";
	$sender = $Loginusername;
	$_SESSION['sendername']=$sender;
	*/
	include_once 'db_connection.php';
?>
<?php
$conn = mysqli_connect('localhost','root','','chat');
/*
$sql = mysqli_query($conn,"SELECT COUNT (DISTINCT WantToChat) FROM chat WHERE notification='1'");
*/
$sql1 = mysqli_query($conn,"SELECT * FROM chat WHERE notification='1' and Sender='user1'");
$sql2 = mysqli_query($conn,"SELECT * FROM chat WHERE notification='1' and Sender='user2'");
$sql3 = mysqli_query($conn,"SELECT * FROM chat WHERE notification='1' and Sender='user3'");
$sql4 = mysqli_query($conn,"SELECT * FROM chat WHERE notification='1' and Sender='user4'");
$sql5 = mysqli_query($conn,"SELECT * FROM chat WHERE notification='1' and Sender='user5'");
$sql6 = mysqli_query($conn,"SELECT * FROM chat WHERE notification='1' and Sender='user6'");
$sql7 = mysqli_query($conn,"SELECT * FROM chat WHERE notification='1' and Sender='user7'");

$result1=mysqli_num_rows($sql1);
//echo "One : $result1 Rows <br>";
$result2=mysqli_num_rows($sql2);
//echo "Two : $result2 Rows <br>";
$result3=mysqli_num_rows($sql3);
//echo "Three : $result3 Rows<br>";
$result4=mysqli_num_rows($sql4);
//echo "Four : $result4 Rows<br>";
$result5=mysqli_num_rows($sql5);
//echo "Five : $result5 Rows<br>";
$result6=mysqli_num_rows($sql6);
//echo "Six : $result6 Rows<br>";
$result7=mysqli_num_rows($sql7);
//echo "Seven : $result7 Rows<br>";

/*
$sql="SELECT * FROM chat WHERE notification='1'";

if ($result=mysqli_query($conn,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  printf("Result set has %d rows.\n",$rowcount);
  // Free result set
  mysqli_free_result($result);
  }
*/


?>

<?php


if (isset($_POST['recv'])) {
	//echo "ONE";
	$var = $_POST['recv'];
	$_SESSION['receivername'] = $var ;
	echo "$var";
	
	$query = "SELECT DISTINCT WantToChat FROM chat WHERE notification='1' and Sender='$var' ";
	$result= mysqli_query($conn,$query);
	if(mysqli_num_rows($result) > 0){
?>
<div class="container">

<?php
		while($row = mysqli_fetch_assoc($result)){
?>

<?php
$compname=$row['WantToChat'];
echo "<a href=index.php?compna=$compname class='list-group-item' style='max-width: 200px;overflow: auto;'>$compname</a>";
?>            
<?php
		}
		mysqli_query($conn,"UPDATE chat SET notification=0 WHERE notification=1 AND Sender='$var'");
	}

	
	header("Location: index.php?name=$var");
	
	

}
else if (isset($_POST['two'])) {
	//echo "ONE";
	$var = "User2";
	$_SESSION['receivername'] = $var ;
	
	
	
	header("Location: index.php");

}
else if (isset($_POST['three'])) {
	//echo "ONE";
	$var = "User3";
	$_SESSION['receivername'] = $var ;
	header("Location: index.php");

}
else if (isset($_POST['four'])) {
	//echo "ONE";
	$var = "User4";
	$_SESSION['receivername'] = $var ;
	header("Location: index.php");

}
else if (isset($_POST['five'])) {
	//echo "ONE";
	$var = "User5";
	$_SESSION['receivername'] = $var ;
	header("Location: index.php");

}
else if (isset($_POST['six'])) {
	//echo "ONE";
	$var = "User6";
	$_SESSION['receivername'] = $var ;
	header("Location: index.php");

}
else if (isset($_POST['seven'])) {
	//echo "ONE";
	$var = "User7";
	$_SESSION['receivername'] = $var ;
	header("Location: index.php");

}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Owner List</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
 
<script src="js/jquery-1.12.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
// Add the following into your HEAD section
var timer = 0;
function set_interval() {
  // the interval 'timer' is set as soon as the page loads
  timer = setInterval("auto_logout()", 10000);
  // the figure '10000' above indicates how many milliseconds the timer be set to.
  // Eg: to set it to 5 mins, calculate 5min = 5x60 = 300 sec = 300,000 millisec.
  // So set it to 300000
}

function reset_interval() {
  //resets the timer. The timer is reset on each of the below events:
  // 1. mousemove   2. mouseclick   3. key press 4. scroliing
  //first step: clear the existing timer

  if (timer != 0) {
    clearInterval(timer);
    timer = 0;
    // second step: implement the timer again
    timer = setInterval("auto_logout()", 10000);
    // completed the reset of the timer
  }
}

function auto_logout() {
  // this function will redirect the user to the logout script
  //window.location = "logout.php";
}
</script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel = "stylesheet" type="text/css" href ="chat.css"/> 
	<link rel = "stylesheet" type="text/css" href ="ownerlist.css"/> 
<script src="http://code.jquery.com/jquery-1.9.0.js"></script> 



</head>
<body class="w3-theme-l5" onload="set_interval()" onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="<?php echo  htmlspecialchars($_SERVER['HTTP_REFERER'])?>" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Logo</a>

  <a href="#logoutModal" data-toggle="modal" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account"><img src="<?php echo "$pic"?>" class="w3-circle" style="height:25px;width:25px" alt="Avatar"></a>
 </div>
</div>

<div class="modal bs-example-modal-sm" id="logoutModal"  tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header"><h4>Logout <i class="fa fa-lock"></i></h4></div>
      <div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to log-off?</div>
      <div class="modal-footer"><a href="logout.php" class="btn btn-primary btn-block">Logout</a></div>
    </div>
  </div>
</div>
       

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>
<div class="login-page">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <?php 
	$conn1 = mysqli_connect('localhost','root','','home');
	$query = "select * from users where userType='tenant'";
   
   $res = mysqli_query($conn1, $query);
   
   while($row=mysqli_fetch_row($res)){
	   $name=$row[2];
	?>
	<tr>
		<td><input type="submit" name="recv" class="button" value="<?php echo $name?>"></td>
        
<?php }?>
	</tr>
	
	<tr>
		
	
	</tr>
	</form>
</div>
<?php
if(isset($_POST['one1'])){
	$conn=mysqli_connect('localhost','root','','chat');
	$query = "SELECT DISTINCT WantToChat FROM chat WHERE notification='1' and Sender='user1' ";
	$result= mysqli_query($conn,$query);
	if(mysqli_num_rows($result) > 0){
?>
<div class="container">

<?php
		while($row = mysqli_fetch_assoc($result)){
?>

<?php
$compname=$row['WantToChat'];
echo "<a href=index.php?compna=$compname class='list-group-item' style='max-width: 200px;overflow: auto;'>$compname</a>";
?>            
<?php
		}
		mysqli_query($conn,"UPDATE chat SET notification=0 WHERE notification=1 AND Sender='USER1'");
	}
}
?>


<?php
if(isset($_POST['two1'])){
	$conn=mysqli_connect('localhost','root','','chat');
	$query = "SELECT DISTINCT WantToChat FROM chat WHERE notification='1' and Sender='user2' ";
	$result= mysqli_query($conn,$query);
	if(mysqli_num_rows($result) > 0){
?>
<div class="container">

<?php
		while($row = mysqli_fetch_assoc($result)){
?>

<?php
$compname=$row['WantToChat'];
echo "<a href=index.php?compna=$compname class='list-group-item' style='max-width: 200px;overflow: auto;'>$compname</a>";
?>            
<?php
		}
		mysqli_query($conn,"UPDATE chat SET notification=0 WHERE notification=1 AND Sender='USER2'");
	}
}
?>
<?php
if(isset($_POST['three1'])){
	$conn=mysqli_connect('localhost','root','','chat');
	$query = "SELECT DISTINCT WantToChat FROM chat WHERE notification='1' and Sender='user3' ";
	$result= mysqli_query($conn,$query);
	if(mysqli_num_rows($result) > 0){
?>
<div class="container">

<?php
		while($row = mysqli_fetch_assoc($result)){
?>

<?php
$compname=$row['WantToChat'];
echo "<a href=index.php?compna=$compname class='list-group-item' style='max-width: 200px;overflow: auto;'>$compname</a>";
?>            
<?php
		}
		mysqli_query($conn,"UPDATE chat SET notification=0 WHERE notification=1 AND Sender='USER3'");
	}
}
?>
<?php
if(isset($_POST['four1'])){
	$conn=mysqli_connect('localhost','root','','chat');
	$query = "SELECT DISTINCT WantToChat FROM chat WHERE notification='1' and Sender='user4' ";
	$result= mysqli_query($conn,$query);
	if(mysqli_num_rows($result) > 0){
?>
<div class="container">

<?php
		while($row = mysqli_fetch_assoc($result)){
?>

<?php
$compname=$row['WantToChat'];
echo "<a href=index.php?compna=$compname class='list-group-item' style='max-width: 200px;overflow: auto;'>$compname</a>";
?>            
<?php
		}
		mysqli_query($conn,"UPDATE chat SET notification=0 WHERE notification=1 AND Sender='USER4'");
	}
}
?>
<?php
if(isset($_POST['five1'])){
	$conn=mysqli_connect('localhost','root','','chat');
	$query = "SELECT DISTINCT WantToChat FROM chat WHERE notification='1' and Sender='user5' ";
	$result= mysqli_query($conn,$query);
	if(mysqli_num_rows($result) > 0){
?>
<div class="container">

<?php
		while($row = mysqli_fetch_assoc($result)){
?>

<?php
$compname=$row['WantToChat'];
echo "<a href=index.php?compna=$compname class='list-group-item' style='max-width: 200px;overflow: auto;'>$compname</a>";
?>            
<?php
		}
		mysqli_query($conn,"UPDATE chat SET notification=0 WHERE notification=1 AND Sender='USER5'");
	}
}
?>

<?php
if(isset($_POST['six1'])){
	$conn=mysqli_connect('localhost','root','','chat');
	$query = "SELECT DISTINCT WantToChat FROM chat WHERE notification='1' and Sender='user6' ";
	$result= mysqli_query($conn,$query);
	if(mysqli_num_rows($result) > 0){
?>
<div class="container">

<?php
		while($row = mysqli_fetch_assoc($result)){
?>

<?php
$compname=$row['WantToChat'];
echo "<a href=index.php?compna=$compname class='list-group-item' style='max-width: 200px;overflow: auto;'>$compname</a>";
?>            
<?php
		}
		mysqli_query($conn,"UPDATE chat SET notification=0 WHERE notification=1 AND Sender='USER6'");
	}
}
?>
<?php
if(isset($_POST['seven1'])){
	$conn=mysqli_connect('localhost','root','','chat');
	$query = "SELECT DISTINCT WantToChat FROM chat WHERE notification='1' and Sender='user7' ";
	$result= mysqli_query($conn,$query);
	if(mysqli_num_rows($result) > 0){
?>
<div class="container">

<?php
		while($row = mysqli_fetch_assoc($result)){
?>

<?php
$compname=$row['WantToChat'];
echo "<a href=index.php?compna=$compname class='list-group-item' style='max-width: 200px;overflow: auto;'>$compname</a>";
?>            
<?php
		}
		mysqli_query($conn,"UPDATE chat SET notification=0 WHERE notification=1 AND Sender='USER7'");
	}
}
?>


</body>
</html>