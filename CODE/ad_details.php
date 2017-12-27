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

if(isset($_GET['id'])){
	
$id=$_GET['id'];
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
	

}
 mysqli_close($conn);
?>
<!DOCTYPE html>
<html >
<head>
  <title>House Rent app</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" type="text/css" href="css/style2.css">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBH4ryoBScvkV4FxwP4UTlzbsA37EX9z1g&sensor=false"></script>
    <script type="text/javascript" src="js/map.js"></script>
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
 <style>
  body {
      position: relative; 
  }
  .affix {
      top:0;
      width:100%;
      
  }
  .navbar {
      margin-bottom: 0px;
  }

  .affix ~ .container-fluid {
     position: relative;
     top: 50px;
  }


  </style>
</head>
<body style="background-image:url(image/abf5746d091f4ee9fc182d4f07079a17.jpg); background-repeat:no-repeat; background-size:cover" data-spy="scroll" data-target=".navbar" data-offset="50">


<nav class="navbar navbar-default navbar-fixed-top"  >
  <div class="container-fluid" style="background-color:#23527c" >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <a href="loginModal.php"><button type="button" class="btn btn-lg btn-link active" style="color:#fff">
      <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
      </button></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <li class="active"><a href="loginModal.php">Home<span class="sr-only">(current)</span></a></li>
        
        


        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">For Tenant<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#loginModal" data-toggle="modal">Profile</a></li>
            <li><a href="#loginModal" data-toggle="modal">Chat</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#loginModal" data-toggle="modal">Search</a></li>
          </ul>
        </li>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">For House Owner<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#loginModal" data-toggle="modal">Profile</a></li>
            <li><a href="#loginModal" data-toggle="modal">Chat</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#loginModal" data-toggle="modal">AD</a></li>
          </ul>
        </li>
       
      </ul>
       <ul class="nav navbar-nav navbar-right">
        <li><a href="#loginModal" data-toggle="modal">Log in</a></li>

        <li><a href="registration.php">Registration</a></li>
        </ul>
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
      </form>
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

        <div class="modal fade" id="loginModal">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <button class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>

        </div>
        <div class="modal-body">
        


    <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" >
     <center><h2 >Log In</h2></center>
     <div class="form-group">
             <hr />
            </div>
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
        <div class="form-group">
             <div class="alert alert-danger">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
   <div class="form-group">
   <label class="col-lg-2 control-label" for="inputEmail"></label>
    <div class="col-lg-10">
             <div class="input-group">
			  <input type="radio" name="user_type" value="house_owner"/>
                House Owner
                 <input type="radio" name="user_type" value="tenant"/>
                Tenant
				</div>
                </div>
                <span class="text-danger"><?php echo $genderError; ?></span>
                
      </div>
             <div class="form-group">
               <label class="col-lg-2 control-label" for="inputEmail">Email</label>
               <div class="col-lg-10">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
                </div>
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
          <div class="form-group">
            <label class="col-lg-2 control-label" for="inputPass">Password</label>
               <div class="col-lg-10">
                <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
                
                </div>
               <br>
                <button type="submit" class="btn btn-success pull-right" name="btn-login">Log in</button>
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            	  	  	
        
            
     
    </form>



        </div>
        <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
       <a href="registration.php"> <button class="btn btn-primary" type="button" >Sign up</button></a>
        </div>
</div>
</div>
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