<?php
 ob_start();
 session_start();
if(isset($_SESSION["username"]))
{
 if((time() - $_SESSION['last_time']) > 60) // Time in Seconds
 {
 header("location:logout.php");
 }
}

 include_once 'db_connection.php';

 /*if (isset($_GET['logout'])) {
  unset($_SESSION['user']);
  session_unset();
  session_destroy();
  header("Location: loginModal.php");
  exit;
 }*/

 $error = false;

 if ( isset($_POST['btn-signup']) ) {
  
  // clean user inputs to prevent sql injections

$nid=$_POST['nid'];
echo "$nid";
$price=$_POST['price'];
$size=$_POST['size'];
$location=$_POST['address'];
  
  // basic name validation

  //NID validation
    if (empty($nid)) {
   $error = true;
   $nidError = "Please enter your correct NID. ";
  } else if (strlen($nid) !=17) {
   $error = true;
   $nidError = "Please enter your correct NID.";
  } 

  //profile pic
  $file_name=$_FILES['image']['name'];
    $file_type=$_FILES['image']['type'];
    $file_size=$_FILES['image']['size'];
    $file_tmp_name=$_FILES['image']['tmp_name'];
	
	if($file_name){
	move_uploaded_file($file_tmp_name,"img/$file_name");
	$profile_pic="img/$file_name";
	
}

  

   
   $query = "INSERT INTO add_house(nid,location,price,size,img) VALUES('$nid','$location','$price','$size','$profile_pic')";
   $res = mysqli_query($connection, $query);
    if(!$res){die("fail");}
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully add for to-let";
    unset($name);
    unset($email);
    unset($pass);
	unset($nid);
	unset($address);
	unset($dob);
	unset($gender);
	
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
    
 
  
 
  
  
  
  
 }



?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>profile &mdash; house rent</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	

  <!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FreeHTML5.co
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Source+Code+Pro" rel="stylesheet">
	
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="assets/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
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
      <li ><a href="#" style="color:#FFFFFF">হোম <span class="sr-only">(current)</span></a></li>
        
        


        

            <li><a href="#loginModal" data-toggle="modal" style="color:#FFFFFF">চ্যাট</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#newadd" data-toggle="modal" style="color:#FFFFFF">অ্যাড</a></li>
        
       
      </ul>
       <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php" data-toggle="modal" style="color:#FFFFFF">লগ আউট </a></li>

       
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
<br>
<br>
	<div id="fh5co-header" style="background-image: url(image/polygon.png);" data-stellar-background-ratio="0.5">

        <div class="overlay"></div>
		<div class="bio-photo text-center">
			<a href="index.html"><img src="image/accion-directa.jpg" width="300" height="300" alt="Free HTML5 Bootstrap Template by FreeHTML5.co"></a>
		</div>
	</div>

	<br><br><br><br><br><br><hr>
    <div class="container">
           <div class="col-lg-9 col-md-12">
<div class="row">

   <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6" id="newadd">


           

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
    
        
         <div class="form-group">
             <h2 class="">নতুন বিজ্ঞাপন</h2>
      </div>
        
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
                           <label class="col-lg-2 control-label" for="inputEmail">NID</label>
               <div class="col-lg-10">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="nid" class="form-control" placeholder="Enter National ID number" maxlength="50" value="<?php echo $nid;?>" />
              </div>
              <br>
              </div>
              </div>
              <div class="form-group">
                           <label class="col-lg-2 control-label" for="inputEmail">Price</label>
               <div class="col-lg-10">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="price" class="form-control" placeholder="Enter National ID number" maxlength="50" value="<?php echo $nid;?>" />
              </div>
              <br>
              </div>
              </div>
              <div class="form-group">
               <label class="col-lg-2 control-label" for="inputEmail">Size</label>
               <div class="col-lg-10">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="size" class="form-control" placeholder="Enter National ID number" maxlength="50" value="<?php echo $nid;?>" />
              </div>
              <br>
              </div>
              </div>
              <div class="form-group">
                           <label class="col-lg-2 control-label" for="inputEmail">Address</label>
               <div class="col-lg-10">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="address" class="form-control" placeholder="Enter National ID number" maxlength="50" value="<?php echo $nid;?>" />
              </div>
              <br>
              </div>
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
            
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Submit</button>
             
            </div>
            
          
        
        
   
    </form>
    </div> 

</div>
         
 
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
          <div class="thumbnail"> <img src="dhaka-metropolitan-police-logo.png" alt="Thumbnail Image 1" class="img-responsive" style=" width:300px;height:200px">
            <div class="caption">
              <h3>NID varification</h3>
              <p>Check tanent NID</p>
              <hr>
              <p class="text-center"><a href="dmpchange.php" class="btn btn-success" role="button">Check</a></p>
            </div>
          </div>
        </div>
     
           <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
          <div class="thumbnail"> <img src="image/Pc-Bubble.png" alt="Thumbnail Image 1" class="img-responsive" style=" width:300px;height:200px">
            <div class="caption">
              <h3>Comunicate</h3>
              <p>Chat</p>
              <hr>
              <p class="text-center"><a href="du.php" class="btn btn-success" role="button">Chat</a></p>
            </div>
          </div>
        </div>
      </div>
  
    </div>
		</div>

	</body>
</html>

