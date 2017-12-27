<?php
 ob_start();
 session_start();
 
/*if(isset($_SESSION["username"]))
{
	
 if((time() - $_SESSION['last_time']) > 10) // Time in Seconds
 {
 header("location:logout.php");
 }
 else{
	   $_SESSION['last_time']=time();     
}
}*/


 include_once 'db_connection.php';

 /*if (isset($_GET['logout'])) {
  unset($_SESSION['user']);
  session_unset();
  session_destroy();
  header("Location: loginModal.php");
  exit;
 }*/

$user_id=$_SESSION['userid'];

$sql = "SELECT * FROM users WHERE id='$user_id' AND activated='1' LIMIT 1";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($query);
		$db_id = $row[0];
		$db_NID = $row[1];
        $db_username = $row[2];
		$db_address = $row[5];
        $db_birth = $row[6];		
$pic="user/$db_username/profiledemo.jpg";
 $error = false;

 if ( isset($_POST['btn-signup']) ) {
  
  // clean user inputs to prevent sql injections



$price=$_POST['price'];
$size=$_POST['size'];
$location=$_POST['location'];
 $Full_address=$_POST['Full_address'];
 $details=$_POST['details'];
  // basic name validation
   if (empty($price)) {
   $error = true;
   $priceError = "Please enter your price. ";
  }
    if (empty($size)) {
   $error = true;
   $sizeError = "Please enter your size. ";
  }
    if (empty($location)) {
   $error = true;
   $locationError = "Please enter your location. ";
  }
    if (empty($Full_address)) {
   $error = true;
   $Full_addressError = "Please enter your Full address. ";
  }
    if (empty($details)) {
   $error = true;
   $detailsError = "Please enter your details. ";
  }

  //NID validation


  //profile pic
  $file_name=$_FILES['image']['name'];
    $file_type=$_FILES['image']['type'];
    $file_size=$_FILES['image']['size'];
    $file_tmp_name=$_FILES['image']['tmp_name'];
	
	if($file_name){
	move_uploaded_file($file_tmp_name,"image/$file_name");
	$profile_pic="image/$file_name";
	
}

  

   if(!$error){
   $query = "INSERT INTO add_house (nid,location,Full_address,price,space,details,img) VALUES('$db_NID','$location','$Full_address','$price','$size','$details','$profile_pic')";
   
   $res = mysqli_query($conn, $query);

      if($res){
    $errTyp = "success";
    $errMSG = "Successfully add for to-list";
    unset($name);
    unset($email);
    unset($pass);
	unset($nid);
	unset($address);
	unset($dob);
	unset($gender);
	  }
	  else{
		  $errTyp = "danger";
    $errMSG = "$query";
		  }
  
   }
   else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
    
 
 
  
  
 }

$sql = "SELECT * FROM add_house WHERE NID='$db_NID'";
$query = mysqli_query($conn, $sql);
while($row = mysqli_fetch_row($query)){
		$db_id1 = $row[0];
		$db_NID1= $row[1];
        $house_pic = $row[2];}
		

/////////delete post
if(isset($_GET['del'])){
	
	$delete_item=$_GET['del'];
	$query = "delete from add_house where id=$delete_item";
    $res = mysqli_query($conn, $query);
	
}

if(isset($_GET['request'])){
	
	$request_item=$_GET['request'];
	header("location: request.php?request_item=".$request_item );
	
}


?>
<!DOCTYPE html>
<html>
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
  window.location = "logout.php";
}
</script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5" onload="set_interval()" onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Logo</a>

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

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">My Profile</h4>
         <p class="w3-center"><img src="<?php echo "$pic"?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> <?php echo $db_username?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> <?php echo $db_address?></p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?php echo $db_birth?></p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card-2 w3-round">
        
      </div>
      <br>
      
      <!-- Interests --> 
      <div class="w3-card-2 w3-round w3-white w3-hide-small">
        
      </div>
      <br>
      
      <!-- Alert Box -->
      <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        
      </div>
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
    
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card-2 w3-round w3-white">
            <div class="w3-container w3-padding">
              <h2 class="w3-opacity">New AD Post</h2>
              
      
             
    <form  method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
    
        

        
         <div class="form-group">
             <hr />
      </div>
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
        </div>
      </div>
                <?php
   }
   ?>
            			
			<div class="form-group">
                           <label class="col-lg-2 control-label" for="inputEmail">Location</label>
               <div class="col-lg-10">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="location" class="form-control-static" placeholder="Enter your location" maxlength="50" value="<?php echo $location;?>" />
              </div>
              <br>
              </div>
              <span class="text-danger"><?php echo $locationError; ?></span>
              </div>
              <div class="form-group">
                           <label class="col-lg-2 control-label" for="inputEmail">Price</label>
               <div class="col-lg-10">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="price" class="form-control-static" placeholder="Enter Price" maxlength="50" value="<?php echo $price;?>" />
              </div>
              <br>
              </div>
              <span class="text-danger"><?php echo $priceError; ?></span>
              </div>
              <div class="form-group">
               <label class="col-lg-2 control-label" for="inputEmail">Size</label>
               <div class="col-lg-10">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="size" class="form-control-static" placeholder="Enter Size" maxlength="50" value="<?php echo $size;?>" />
              </div>
              <br>
              </div>
              <span class="text-danger"><?php echo $sizeError; ?></span>
              </div>
              <div class="form-group">
                           <label class="col-lg-2 control-label" for="inputEmail">Address</label>
               <div class="col-lg-10">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="Full_address" class="form-control-static" placeholder="Enter Full Address" maxlength="50" value="<?php echo $Full_address;?>" />
              </div>
              <br>
              </div>
              <span class="text-danger"><?php echo $Full_addressError; ?></span>
              </div>
               <div class="form-group">
                           <label class="col-lg-2 control-label" for="inputEmail">Details</label>
               <div class="col-lg-10">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="details" class="form-control-static" placeholder="Details about house" maxlength="50" value="<?php echo $details;?>" />
              </div>
              <br>
              </div>
              <span class="text-danger"><?php echo $detailsError; ?></span>
              </div>             
              
                
                       <hr />
           <div class="form-group">
             <div class="input-group">
            <label>upload Image</label>
        <input type="file" name="image"><br>
        <input type="submit" value="Upload Image" name="upload_img">
            </div>
            </div>
            <div class="form-group">
             <div class="col-lg-4">
             </div>
            
             
            </div>
            
          
              <button type="submit" class="w3-button w3-theme" name="btn-signup" ><i class="fa fa-pencil"></i>  Post</button> 
        
        
   
    </form>
   
      
              
              
              
            </div>
          </div>
        </div>
      </div>
      
<!-- /////////////// -->
    
<?php 
$sql = "SELECT * FROM add_house WHERE NID='$db_NID'";
$query = mysqli_query($conn, $sql);
while($row = mysqli_fetch_row($query)){
		$db_id1 = $row[0];
		$db_NID1= $row[1];
        $house_pic = $row[2];
		$house_loc = $row[3];
?>
       <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
        <img src="<?php echo "$house_pic"?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity">1 min</span>
        <h4><?php echo "$house_loc"?></h4><br>
        <hr class="w3-clear">
        <p></p>
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
              <img src="<?php echo "$house_pic"?>" style="width:100%" alt="Northern Lights" class="w3-margin-bottom">
            </div>
            <div class="w3-half">
              <img src="<?php echo "$house_pic"?>" style="width:100%" alt="Nature" class="w3-margin-bottom">
          </div>
        </div>
       
        <form method="get" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
        <button type="text" class="w3-button w3-theme-d1 w3-margin-bottom"  name="del" value="<?php echo "$db_id1"?>"><i class="fa fa-trash"></i>  Delete</button> 
        
        <button type="submit" class="w3-button w3-theme-d2 w3-margin-bottom" name="request" value="<?php echo "$db_id1"?>"><i class="fa fa-edit"></i> See Request</button> 
        </form>
      </div>
      
      
       <!--delete------>
   <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
    <div id="Delete" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom w3-padding-large">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('Delete').style.display='none'" class="fa fa-remove w3-button w3-xlarge w3-right w3-transparent"></i>
      <h2 class="w3-wide">Delete</h2>
      <p align="center">You are going to delete the post.Are You Sure?</p>
      
      <a href="profile1.php?k=<?php echo $_GET['del']?>" <button type="submit" class="w3-button w3-padding-large w3-red w3-margin-bottom" name="btn-delete" >Delete</button></a>
    </div>
  </div>
</div>
    </form>  
<?php 

}?>
    <!-- End Middle Column -->
    </div>
    
   
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card-2 w3-round w3-white w3-center">
        <div class="w3-container">
          <p></p>
          <img src="image/Pc-Bubble.png" alt="Forest" style="width:100%;">
          
          <a href="chat/ownerlist.php?LoginuserName=<?php echo $_SESSION['username']?>"><p><button class="w3-button w3-block w3-theme-l4">Chat</button></p></a>
        </div>
      </div>
      <br>
      
   
      <br>
      
      
      
      <div class="w3-card-2 w3-round w3-white w3-padding-32 w3-center">
        <p><i class="fa fa-bug w3-xxlarge"></i></p>
      </div>
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>
 
<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else { 
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html> 
