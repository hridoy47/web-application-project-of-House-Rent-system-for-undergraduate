<?php
 ob_start();
 session_start();
include_once("db_connection.php");
include_once("login.php");

?>
<?php





//////////////////


 $error = false;

 if ( isset($_POST['btn-signup']) ) {
  
  // clean user inputs to prevent sql injections
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  
  $address = trim($_POST['address']);

  $address = strip_tags($address);
  $address = htmlspecialchars($address);
  $nid = trim($_POST['nid']);
  $nid = strip_tags($nid);
  $nid = htmlspecialchars($nid);
  
  
  $birth = trim($_POST['birth']);
  $birth = strip_tags($birth);
  $birth = htmlspecialchars($birth);
  
  $phn = trim($_POST['phn']);
  $phn = strip_tags($phn);
  $phn = htmlspecialchars($phn);
  $gender = trim($_POST['gender']);
  $gender = strip_tags($gender);
  $gender = htmlspecialchars($gender);
  $user_type = trim($_POST['user_type']);
  $user_type= strip_tags($user_type);
  $user_type= htmlspecialchars($user_type);
  
    $sql = "SELECT id FROM users WHERE email='$email' LIMIT 1";
    $query = mysqli_query($conn, $sql); 
    $email_check=mysqli_num_rows($query);
	 if ($email_check >= 1) {
		    $error = true;
               $emailError = "Email Already Exist.";
	 }
	 
	     $sql = "SELECT id FROM users WHERE NID='$nid' LIMIT 1";
    $query = mysqli_query($conn, $sql); 
    $nid_check=mysqli_num_rows($query);
	 if ($nid_check >= 1) {
		    $error = true;
               $nidError = "NID Already Exist.";
	 }
  	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
    $c="Bangladesh";
  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your full name.";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
  }
  //adress validation
    if (empty($address)) {
   $error = true;
   $addressError = "Please enter your full address";
  } 
  
  //NID validation
    if (empty($nid)) {
   $error = true;
   $nidError = "Please enter your correct NID. ";
  } else if (strlen($nid) !=17) {
   $error = true;
   $nidError = "Please enter your correct NID.";
  } 
    if (empty($birth)) {
   $error = true;
   $birthError = "Please enter your Date of birth";
  }
  // phn validation
  if (empty($phn)) {
   $error = true;
   $phnError = "Please enter your contact number";
  }
 else if (strlen($phn) !=11) {
   $error = true;
  $phnError = "Please enter your correct Correct phone number.";
  } 
  if (empty($gender)) {
   $error = true;
   $genderError = "Please enter your full address";
  }
  if (empty($user_type)) {
   $error = true;
   $user_type_Error= "Please select user type";
  }  
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } 
 
  
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }
  
  // password encrypt using SHA256();
  $password =$pass;
  
  // if there's no error, continue to signup
  if( !$error ) {
       	// END FORM DATA ERROR HANDLING
	    // Begin Insertion of data into the database
		// Hash the password and apply your own mysterious unique salt
		/////////
		$p_hash=md5($pass);
		//$cryptpass = crypt($pass);
		//include_once ("randStrGen.php");
		//$p_hash = randStrGen(20)."$cryptpass".randStrGen(20);
		// Add user info into the database table for the main site table
		$sql = "INSERT INTO users (NID,username, email, phone, address, birth, password, gender, userType, country, ip, signup, lastlogin, notescheck)
		VALUES('$nid','$name','$email','$phn','$address','$birth','$p_hash','$gender','$user_type','$c','$ip',now(),now(),now())";
		$query = mysqli_query($conn, $sql); 
		if(! $query){
			echo "error";
			exit();
		}
		$uid = mysqli_insert_id($conn);
		// Establish their row in the useroptions table
		$sql = "INSERT INTO useroptions (id, username, background) VALUES ('$uid','$name','original')";
		$query = mysqli_query($conn, $sql);
		// Create directory(folder) to hold each user's files(pics, MP3s, etc.)
		if (!file_exists("user/$name")) {
			mkdir("user/$name", 0755);
		}
		// Email the user their activation link
		$to = "$email";							 		
		
		//////////////////////
		require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'hridoy537047@gmail.com';          // SMTP username
$mail->Password = '316384372Hr'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                          // TCP port to connect to

$mail->setFrom('hridoy537047@gmail.com', 'hridoy');
$mail->addReplyTo($to, 'hridoy');
$mail->addAddress($to);   // Add a recipient
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');
$mail->addAttachment('1.cpp');
$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '<h1>Confirmation Mail</h1>';
$bodyContent= '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>yoursitename Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;"><a href="#"><img src="v.jpg" width="36" height="30" alt="yoursitename" style="border:none; float:left;"></a>House Rent Account Activation</div><div style="padding:24px; font-size:17px;">Hello '.$name.',<br /><br />Click the link below to activate your account when ready:<br /><br /><a href="http://localhost/sites/project_House_rent/activation.php?id='.$uid.'&name='.$name.'&email='.$email.'&pass='.$password.'">Click here to activate your account now</a><br /><br />Login after successful activation using your:<br />* E-mail Address: <b>'.$email.'</b></div></body></html>';

$mail->Subject = 'Email from Localhost';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Sent Successful';
}
		///////////
		
		
   //$query = "INSERT INTO User_tenant(userName,userEmail,userPass,n_id,adress,phone_num,gender,user_type) //VALUES('$name','$email','$password','$nid','$address','$phn','$gender','$user_type')";
  // $res = mysql_query($query);
    
   
   if ($query) {
    $errTyp = "success";
    $errMSG1 = "OK ".$name.", check your email inbox and junk mail box at ".$email."<u></u> in a moment to complete the sign up process by activating your account. You will not be able to do anything on the site until you successfully activate your account.";
    unset($name);
    unset($email);
    unset($pass);
	unset($nid);
	unset($address);
	unset($phn);
	unset($gender);
	unset($birth);
   }
   
  
  }
  
  
 }
?>
<!DOCTYPE html>
<html>
<head>


  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Coding Cage - Login & Registration System</title>

<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="datetimepicker-master/jquery.datetimepicker.css">
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

<br><br><br>
<div class="container well">
    <div class="row" align="center">
    <div class="col-lg-4 col-md-4  ">
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
 <div id="login-form" >
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" >
    
     <div class="col-md-12">
        
         <div class="form-group">
             <h2 class="">Sign Up.</h2>
      </div>
        
         <div class="form-group">
             <hr />
      </div>
            
       <?php
   if ( isset($errMSG1) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
             
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG1; ?>
        </div>
      </div>
                <?php
   }
   ?>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
              </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
              </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
			<div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="address" class="form-control" placeholder="Enter your full address" maxlength="50" value="<?php echo $address ?>" />
              </div>
                <span class="text-danger"><?php echo $addressError; ?></span>
            </div>
			
			<div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="number" name="nid" class="form-control" placeholder="Enter National ID number" maxlength="50" value="<?php echo $nid ?>" />
              </div>
                <span class="text-danger"><?php echo $nidError; ?></span>
            </div>
			
            			<div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" id="datetimepicker8" name="birth" class="form-control" placeholder="Date of Birth" maxlength="50" value="<?php echo $birth ?>" />
              </div>
                <span class="text-danger"><?php echo $birthError; ?></span>
            </div>
            
<script src="datetimepicker-master/jquery.js"></script>
<script src="datetimepicker-master/jquery.datetimepicker.js"></script>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="datetimepicker-master/build/jquery.datetimepicker.full.js"></script>
<script>
$('#datetimepicker8').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date')
			.toggleClass('xdsoft_disabled');
			
	},
	format:'d/m/Y',
	formatDate:'Y/m/d',
	minDate:'-1970/01/2',
	maxDate:'+1970/01/2',
	timepicker:false
});
</script>
            
            
            <div class="form-group">
             <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="number" name="phn" class="form-control" placeholder="Enter Your Contact Number" maxlength="50" value="<?php echo $phn?>" />
              </div>
                <span class="text-danger"><?php echo $phnError; ?></span>
            </div>
			

            
                        
			
            
      <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
        </div>
                <span class="text-danger"><?php echo $passError; ?></span>
      </div>   
	  	<div class="form-group">
             <div class="input-group">
			  <input type="radio" name="gender" value="male"/>
                Male
                 <input type="radio" name="gender" value="female"/>
                Female
				</div>
                <span class="text-danger"><?php echo $genderError; ?></span>
      </div>
	  <p>Select user type
	  </p>
	  	  	<div class="form-group">
             <div class="input-group">
			  <input type="radio" name="user_type" value="house_owner"/>
                House Owner
                 <input type="radio" name="user_type" value="tenant"/>
                Tenant
				<input type="radio" name="user_type" value="dmp"/>
                DMP
				</div>
                <span class="text-danger"><?php echo $genderError; ?></span>
      </div>
           <hr />
            
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <a href="#"></a>
            </div>
        
        </div>
   
    </form>
    </div> 
</div>
</div>
</div>

</body>
</html>
