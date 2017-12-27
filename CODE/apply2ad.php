<?php
 ob_start();
 session_start();
include_once("db_connection.php");
include_once("login.php");

?>
<?php


$location="";
$img="";
$price="";
$size="";
$address="";
$details="";
$db_id="";
if(isset($_GET['house_id'])){
	
$id=$_GET['house_id'];
$sql="select * from add_house where id=$id ";
$query=mysqli_query($conn,$sql);
while($row = mysqli_fetch_row($query)){
    
    $img=$row[2];
	$location=$row[3];
	$address=$row[4];
    $price=$row[5];
    $size=$row[6];
    $details=$row[7];
	}
	
	$house_id=$_GET['house_id'];
	$db_id=$_GET['db_id'];
	
    $sql="select nid from add_house where id=$house_id ";
    $query=mysqli_query($conn,$sql);
	$row = mysqli_fetch_row($query);
	$owner_nid=$row[0];
	
	
	
	$sql="select NID from users where id=$db_id ";
    $query=mysqli_query($conn,$sql);
	$row = mysqli_fetch_row($query);
	$tenant_nid=$row[0];

}
if(isset($_POST['apply'])){
	
	
	$owner_nid=$_POST['owner'];
	$tenant_nid=$_POST['tenant'];
	$house_id=$_POST['house'];
	$db_id=$_POST['db_id'];
	$sql="INSERT INTO apply (house_id, owner_nid, tenant_nid) VALUES ('$house_id','$owner_nid','$tenant_nid')";
    $query=mysqli_query($conn,$sql);
	
	if($query){
		$msg="You Apply succesfully";
	header("Location: apply2ad.php?db_id=$db_id &house_id=$house_id &msg=$msg");
	
	}
	
}
 mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />

<link href="css/style.css" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" type="text/css" href="css/style2.css">
     <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBH4ryoBScvkV4FxwP4UTlzbsA37EX9z1g&sensor=false"></script>
    <script type="text/javascript" src="js/map.js"></script>
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

<br><br><br>
<div class="container well">
  <div class="row">
<div class="col-xs-4 col-sm-4 col-lg-4 col-md-4"> <span class="text-right">
      </span>

 <img src="<?php echo $img?>" alt="Thumbnail Image 1" class="img-responsive" style=" width:400px;height:400px" >

</div>
 
<div class="col-xs-4 col-sm-4 col-lg-4 col-md-4"> <span class="text-right">
      </span>
      <h3>Details</h3>
      <p><b>Location: </b><?php echo $location?></p>
      <p><b>Rent Amount:</b> <?php echo $price?></p>
      <p><b>Space: </b><?php echo $size?></p>
      <p><b>Address:</b> <?php echo $address?></p>
      <p><b>Room details:</b> <?php echo $details?></p>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      
      <input type="hidden" name="owner" value="<?php echo $owner_nid;?>" />
      <input type="hidden" name="tenant" value="<?php echo $tenant_nid;?>" />
      
      <input type="hidden" name="house" value="<?php echo $house_id;?>" />
      <input type="hidden" name="db_id" value="<?php echo $db_id;?>" />
      
      <button type="submit" class="w3-button w3-theme-d2 w3-margin-bottom" name="apply"><i class="fa fa-edit"></i>  Apply</button>
                  <?php
   if ( isset($_GET['msg']) ) {
    
    ?>
        <div class="form-group">
             <div class="alert alert-success">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $_GET['msg']; ?>
                </div>
             </div>
                <?php
   }
   ?>
      </form>
      </div>
      
      <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4"> <span class="text-right">
      </span>
         <div>
      Enter an address <input type="text" id="address-input" value="<?php echo $address?>" onFocus="searchAddress()">
   
    </div>   
    <div id="map-canvas"></div>
      </div>
      
</div>



</div>

<br>




<div class="container well">
  <div class="row">
<div class="col-xs-6 col-sm-6 col-lg-4 col-md-4"> <span class="text-right">
      </span>
  <h3>About Us</h3>
  <hr>
  <p></p> <!-- Write something about us -->
  <p></p> <!-- Write something about us  -->
</div>
<div class="col-xs-6 col-sm-6 col-lg-4 col-md-4 hidden-sm hidden-xs"> <span class="text-right"> </span>
  <h3>Latest News</h3>
  <hr>
  <div class="media-object-default">
  <div class="media">
  <div class="media-body">
        <h4 class="media-heading">1</h4>
 </div>
  
</div>
<div class="media">
  <div class="media-body">
    <h4 class="media-heading">2</h4>
</div>
 
</div>
</div>
</div>
<div class="col-xs-6 col-sm-6 col-lg-4 col-md-4" id="Contact"> <span class="text-right"> </span>
  <h3>Contact Us</h3>
  <hr>
<div class="media">
  <div class="media-left"> <a href="#"> <img class="media-object" src="image/logo.png" style="width:75px; height:75px" alt="placeholder image"></a></div>
  <div class="media-body">
    <address>
      <strong>MIST</strong><br>
      Mirpur Cantonment<br>
      Mirpur, Dhaka-1216<br>
  <abbr title="Phone"><span class="glyphicon glyphicon-phone-alt"></span></abbr> 90213166
      </address>
      </div>
</div>
<div class="media">

 <div class="media-left"> <a href="#"> <img class="media-object" src="image/Picture2.png" style="width:75px; height:75px"  alt="placeholder image"></a></div>
 <div class="media-body">
      <address>
        <strong>Ferdousur Rahman</strong><br>
        <a href="mailto:#" style="color:#2510D3">ferdousurrahman1994@gmail.com</a><br>
        <strong>Saleh Mohammed Nur Mokarrom</strong><br>
        <a href="mailto:#" style="color:#2510D3">mokarrom@yahoo.com</a><br>
        <strong>Shadman Faysal</strong><br>
        <a href="mailto:#" style="color:#2510D3">shadmanfaysal053@gmail.com</a><br>
         <strong>Rahul</strong><br>
        <a href="mailto:#" style="color:#2510D3">ferdousurrahman1994@gmail.com</a><br>
        <strong>Toki Tahmid Inan</strong><br>
        <a href="mailto:#" style="color:#2510D3">mokarrom@yahoo.com</a><br>
        <strong>Mahmudul Hasan Pious</strong><br>
        <a href="mailto:#" style="color:#2510D3">shadmanfaysal053@gmail.com</a>
      </address>
      </div>
      </div>
</div>
  </div>
</div>
<footer class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p>Copyright © Group-1. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>

</body>
</html>