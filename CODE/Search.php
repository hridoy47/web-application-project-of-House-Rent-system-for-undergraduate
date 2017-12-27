<?php
 ob_start();
 session_start();
include_once("db_connection.php");
include_once("login.php");

?>
<?php
 
 
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
             <p class="text-center"><a href="ad_details.php?id='.$row[0].'" class="btn btn-success" role="button">Details</a></p>
              
              <hr>
              
            </div>
          </div>
        </div>';
	
}


 //////////////////////////////////////////
 
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
       <img style="height:35px; width:200px"src="image/HouseLogo.png"/>
     <!-- <span class="glyphicon glyphicon-home" aria-hidden="true"></span>-->
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
     <center><h2 >Log in</h2></center>
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
            	  	
  
  <br>



</form>
</div>
        <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
       <a href="registration.php"> <button class="btn btn-primary" type="button" >Sign up</button></a>
        </div>
</div>
</div>
</div>

<div class="container">

  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
    

<p><br><br><br><?php echo $search_list;?></p>
</div>
<br><br>
   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
      <div class="well">
        <h3 class="text-center">Find Your Home</h3>
        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
          <div class="form-group">
            <label for="location1" class="control-label">Location</label>
            <select class="form-control" name="location" id="location1">
              <option value="">Any</option>
              <option value="Mirpur">Mirpur</option>
              <option value="Uttora">uttora</option>
              <option value="Badda">Badda</option>
            </select>
             <?php echo $loc?>
            
          </div>
          <div class="form-group">
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
            <?php echo $size?>
          </div>
          <div class="form-group">
            <label for="pricefrom" class="control-label">Price From</label>
            <div class="input-group">
              <div class="input-group-addon" id="basic-addon1">Tk</div>
              <input type="text" class="form-control" name="low_price" id="pricefrom" aria-describedby="basic-addon1" value="<?php echo $low?>">
            </div>
          </div>
          <div class="form-group">
            <label for="priceto" class="control-label">Price To</label>
            <div class="input-group">
              <div class="input-group-addon" id="basic-addon2">Tk</div>
              <input type="text" class="form-control" name="high_price" id="priceto" aria-describedby="basic-addon1" value="<?php echo $high?>">
            </div>
          </div>
                <div align="center">
      <button type="submit" class="btn btn-primary" >Search</button>
      </div>
        </form>
      </div>
     
    </div>
</div>
<!--////////pagination//////////-->
  <div id="pagination_controls" style="background:#F9F3F3" align="center"><?php echo $search_paginationctrls;?></div>
  <!--/////////////-->
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