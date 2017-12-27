<?php
include_once("check_login_status.php");
// If user is already logged in, header that weenis away
//if($user_ok == true){
//	header("location: profile1.php?u=".$_SESSION["username"]);
//    exit();
//}
?>
<?php
 ob_start();
 session_start();
include_once("db_connection.php");
 $email=$_POST['email'];
 // it will never let you open index(login) page if session is set


 $error = false;
 
 if( isset($_POST['btn-login']) ) { 
  
  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  $user_type=$_POST['user_type'];
  // prevent sql injections / clear user invalid inputs
  
  if(empty($email)){
   $error = true;
   $emailError = "Please enter your email address.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  }
  
  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }
  
  // if there's no error, continue to login
  if (!$error) {
	  $password = md5($pass);
	  //////
	  	$sql = "SELECT id, username, password FROM users WHERE email='$email' AND activated='1' LIMIT 1";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($query);
		$db_id = $row[0];
		$db_username = $row[1];
        $db_pass_str = $row[2];
		if($password != $db_pass_str){
			echo "login_failed";
            exit();
		} else {
			// CREATE THEIR SESSIONS AND COOKIES
			$_SESSION['userid'] = $db_id;
			$_SESSION['username'] = $db_username;
			$_SESSION['password'] = $db_pass_str;
			$_SESSION['last_time'] = time();
			//setcookie("id", $db_id, strtotime( '+30 days' ), "/", "", "", TRUE);
			
			//setcookie("user", $db_username, strtotime( '+30 days' ), "/", "", "", TRUE);
			
    		//setcookie("pass", $db_pass_str, strtotime( '+30 days' ), "/", "", "", TRUE); 
			setcookie("id", $db_id, strtotime( '+30 seconds' ), "/", "", "", TRUE);
			
			setcookie("user", $db_username, strtotime( '+30 seconds' ), "/", "", "", TRUE);
			
    		setcookie("pass", $db_pass_str, strtotime( '+30 seconds' ), "/", "", "", TRUE);
			// UPDATE THEIR "IP" AND "LASTLOGIN" FIELDS
			$sql = "UPDATE users SET ip='$ip', lastlogin=now() WHERE id='$db_id' LIMIT 1";
            $query = mysqli_query($conn, $sql);
			echo $db_username;
		    
		}
	  ////
   
    // password hashing using SHA256
  
   $res=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
   if(!$res){
	   echo "error";
   }
   $row=mysqli_fetch_array($res);
   $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
  
   
   if( $count == 1 && $row['password']==$password && $row['userType']==$user_type ) {
	   if($row['activated']==1){
    $_SESSION['user'] = $row['userId'];
	if($row['userType']=='house_owner'){
    header("Location: profile1.php?id='$row[0]'");}
	else{
		
    header("Location: profile2.php?id='$row[0]'");}
	   }
	   else{
		   $errMSG = "Please active your account, Try again...";
	   }
	
   } else {
    $errMSG = "Incorrect Credentials, Try again...";
   }
    
  }
  
 }
 ?>