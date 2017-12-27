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
$pic="user/$db_username/hridoy.jpg";
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

 ////////////////pagination//////////////////////////
 
$loc = $_GET['location'];
$low = $_GET['low_price'];
$high = $_GET['high_price'];
$size=$_GET['size'];

$sql="select count(id) from add_house ";

if($loc!="" && $size=="" && $low=="" && $high==""  )
 {
	$sql .= "where location='$loc' "; 
 }
 
elseif($loc=="" && $size=="" && $low!="" && $high!="" )
 {
	$sql .= " where price between $low and $high "; 
 }

if($loc=="" && $size!="" && $low=="" && $high=="" )
 {
	$sql .= " where space='$size' "; 
 }
 if($loc!="" && $size=="" && $low!="" && $high!="" )
 {
	$sql .= "where location='$loc' and price between $low and $high "; 
 }
 if($loc!="" && $size!="" && $low=="" && $high=="" )
 {
	$sql .= "where location='$loc' and space='$size' "; 
 }
 if($loc=="" && $size!="" && $low!="" && $high!="" )
 {
	$sql .= " where space='$size' and price between $low and $high "; 
 }
if($loc!="" && $size!="" && $low!="" && $high!="" )
 {
	$sql .= "where location='$loc' and space='$size' and price between $low and $high "; 
 }
 

$query=mysqli_query($conn,$sql);
$row= mysqli_fetch_row($query);
$rows=$row[0];
$page_rows=3;
$search_last=ceil($rows/$page_rows);

if($search_last<1)
{
	$search_last=1;
}
$search_pagenum=1;

if(isset($_GET['page'])){
$search_pagenum=preg_replace('#[^0-9]#','',$_GET['page']);
}
if($search_pagenum<1){
$search_pagenum=1;
}
else if($search_pagenum>$search_last){
$search_pagenum=$search_last;
}
$search_limit='LIMIT ' .($search_pagenum-1)*$page_rows.','.$page_rows;
////////

///echo "<br><br><br><br><br><br> $loc $low $high $size";
$sql ="SELECT * FROM add_house ";

  if($loc!="" && $size=="" && $low=="" && $high==""  )
 {
	$sql .= "where location='$loc' "; 
 }
 
elseif($loc=="" && $size=="" && $low!="" && $high!="" )
 {
	$sql .= " where price between $low and $high "; 
 }

if($loc=="" && $size!="" && $low=="" && $high=="" )
 {
	$sql .= " where space='$size' "; 
 }
 if($loc!="" && $size=="" && $low!="" && $high!="" )
 {
	$sql .= "where location='$loc' and price between $low and $high "; 
 }
 if($loc!="" && $size!="" && $low=="" && $high=="" )
 {
	$sql .= "where location='$loc' and space='$size' "; 
 }
 if($loc=="" && $size!="" && $low!="" && $high!="" )
 {
	$sql .= " where space='$size' and price between $low and $high "; 
 }
if($loc!="" && $size!="" && $low!="" && $high!="" )
 {
	$sql .= "where location='$loc' and space='$size' and price between $low and $high "; 
 }
 

$sql .="order by id DESC $search_limit";


/////////////////
///echo $sql;
$query=mysqli_query($conn,$sql);
///if(!$query){echo "<br><br><br><br><br><br><br><br>error";}
$textline1="Test <b>$rows</b>";
$textline2="page  <b>$search_pagenum</b> of <b>$search_last</b>";
$search_paginationctrls='';
 
if($search_last !=1){
  
   if($search_pagenum>1){
      $search_previous=$search_pagenum-1;
	  $search_paginationctrls .='<a href="'.$_SERVER['PHP_SELF'].'?page='.$search_previous.'&location='.$loc.'&size='.$size.'&low_price='.$low.'&high_price='.$high.'">Previous</a>&nbsp; &nbsp;';
	  for($j=$search_pagenum-4;$j<$search_pagenum;$j++){
		  if($j>0){
		     $search_paginationctrls .='<a href="'.$_SERVER['PHP_SELF'].'?page='.$j.'&location='.$loc.'&size='.$size.'&low_price='.$low.'&high_price='.$high.'">'.$j.'</a>&nbsp;';
			 
		  }
	  }
	  
   }
   
   $search_paginationctrls.=''.$search_pagenum.'&nbsp;';
   
   for($j=$search_pagenum+1;$j<=$search_last;$j++){
		$search_paginationctrls .='<a href="'.$_SERVER['PHP_SELF'].'?page='.$j.'&location='.$loc.'&size='.$size.'&low_price='.$low.'&high_price='.$high.'">'.$j.'</a>&nbsp;';
		if($j>=$search_pagenum+4){
			break;
		  }
	  }
	  
 if($search_pagenum!=$search_last){
	
   $search_next=$search_pagenum+1;
   $search_paginationctrls .='&nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?page='.$search_next.'&location='.$loc.'&size='.$size.'&low_price='.$low.'&high_price='.$high.'">Next</a>';
  
 }

}

$search_list='';
while($row = mysqli_fetch_array($query)){
	
	
	$search_list .='<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
          <div class="thumbnail"> <img src="'.$row[2].' " alt="Thumbnail Image 1" class="img-responsive" style=" width:300px;height:200px">
            <div class="caption">
              <h3>Location</h3>'.$row[3].' 
              <p>Rent amount &nbsp;: &nbsp;'.$row[5].' </p>
			  <p>space &nbsp;: &nbsp;'.$row[6].'</p>
             <p class="text-center"><a href="apply2ad.php?db_id='.$db_id.' &house_id='.$row[0].'" class="btn btn-success" role="button">Details</a></p>
              
              <hr>
              
            </div>
          </div>
        </div>';
	
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
              
      
             
    <p><?php echo $search_list;?></p>
   
       <div id="pagination_controls" style="background:#F9F3F3" align="center"><?php echo $paginationctrls;?></div>
              
              
              
            </div>
          </div>
        </div>
      </div>
      
<!-- /////////////// -->
    

    <!-- End Middle Column -->
    </div>
    
   
    
    <!-- Right Column -->
    <div class="w3-col m2">
       <div class="w3-card-2 w3-round w3-white w3-center">  
      <div class="well">
        <h3 class="text-center">Find Your Home</h3>
        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
          <div class="form-group row">
            <label for="location1" class="control-label">Location</label>
            <select class="form-control" name="location" id="location1">
              <option value="">Any</option>
              <option value="Mirpur">Mirpur</option>
              <option value="Uttora">uttora</option>
              <option value="Badda">Badda</option>
            </select>
          </div>
          <div class="form-group row">
            <label for="type1" class="control-label">Space</label>
            <select class="form-control" name="size" id="type1">
              <option value="">Any</option>
              <option value="1000">1000</option>
              <option value="1100">1100</option>
              <option value="1200">1200</option>
              <option value="1300">1300</option>
              <option value="1400">1400</option>
              <option value="1500">1500</option>
           
              <option value="1800">1800</option>
              <option value="2000">2000</option>
              <option value="2200">2200</option>
              <option value="2500">2500</option>
              <option value="3200">4200</option>
            </select>
          </div>
          <div class="form-group">
            <label for="pricefrom" class="control-label">Price From</label>
            <div class="input-group">
              <div class="input-group-addon" id="basic-addon1">Tk</div>
              <input type="text" class="form-control" name="low_price" id="pricefrom" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="form-group row">
            <label for="priceto" class="control-label">Price To</label>
            <div class="input-group">
              <div class="input-group-addon" id="basic-addon2">Tk</div>
              <input type="text" class="form-control" name="high_price" id="priceto" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="form-group row">
                <div align="center">
      <button type="submit" class="btn btn-primary" name="search" >Search</button>
      </div>
      </div>
        </form>
      </div>
      
      
 <br>
   
    </div>
      <br>
      
       <div class="w3-card-2 w3-round w3-white w3-center">
        <div class="w3-container">
          <p></p>
          <img src="image/Pc-Bubble.png" alt="Forest" style="width:100%;">
          
          <a href="chat/ownerlist1.php?LoginuserName=<?php echo $_SESSION['username']?>"><p><button class="w3-button w3-block w3-theme-l4">Chat</button></p></a>
        </div>
      </div>
      <br>
      
      <div class="w3-card-2 w3-round w3-white w3-padding-16 w3-center">
        <p>ADS</p>
      </div>
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
