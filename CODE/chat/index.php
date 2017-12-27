<?php
session_start();
include_once 'db_connection.php';
?>

<?php

    if($_GET){

        $compname = $_GET['compna']; 
      //  echo $compname."<br>" ;
        $_SESSION['receivername'] = $_GET['name'];

    }else{
      //echo "Url has no user<br></br>";
    	//echo "not get<br>";
    }
?>


<?php
	
//	echo '<span style="color:#ffffff;text-align:center;">Receiver Name : </span>'. $_SESSION['receivername'] ."<br>";
//	echo "Receiver Name :". $_SESSION['receivername']."<br></br>";
//	echo '<span style="color:#ffffff;text-align:center;">Sender Name   : </span>'.$_SESSION['Loginusername']."<br></br>";
//	echo "Sender Name : ". $_SESSION['Loginusername']."<br></br>";
?>
<?php
/*
	$conn = mysqli_connect('localhost','root','','chat');
	if (isset($_POST['sendsms'])) {
		$update_query = "UPDATE chat SET notification=1 WHERE notification=0";
  		mysqli_query($conn , $update_query);
	}
*/
?>


<!DOCTYPE html>
<html> 
<head> 
<title>Chat Box</title> 

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
<link rel = "stylesheet" type="text/css" href ="index.css"/> 
<script src="http://code.jquery.com/jquery-1.9.0.js"></script> 
<script type="text/javascript"></script>
<script> 
function submitChat()
{ 
	if(form1.msg.value == '' ){ 
	alert('ALL FIELDS ARE MANDATORY!!!!'); 
	return; 
	} 

	//form1.uname.readOnly = true; 
	//form1.uname.style.border = 'none'; 
	//var uname = form1.uname.value; 
	var msg = form1.msg.value; 
	var xmlhttp = new XMLHttpRequest(); 
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{ 
				document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
			} 
	} 
			xmlhttp.open('GET','insert.php?msg='+msg, true);

			xmlhttp.send(); 
}


$(document).ready(function(e){ 
	$.ajaxSetup({cache:false}); 
setInterval(function(){$('#chatlogs').load('logs.php');}, 2000); 
}); 
</script> 
<script type="text/javascript">

 $("#reply").on('keydown', function(e) {
    var code = e.keyCode || e.which;
      if(code == 13) { //Enter keycode
       event.preventDefault();
       var s = $(this).val();
       $(this).val(s+"\n");
      }     
 });
</script>
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
<div class="container">
          
</div>
<div class="over">Chat Box</div>
<div class="coverfull">
<div id="chatlogs" class="chatlogs"> 
LOADING CHATLOGS PLEASE WAIT... 
</div> 
<div class="input">
<form name = "form1"> 
<table>
	
	<td> </td><td><textarea name= "msg" style ="width:600px; height: 70px" class="output" id="reply"></textarea><br /> </td>
	
	
		<td><a href= "#" onclick= "submitChat()" name="sendsms" class="button">Send</a><br /><br /></td>
	
</table>
</form>
</div>


</div>
</body>

</html>