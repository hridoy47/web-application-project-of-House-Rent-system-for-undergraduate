<?php

 // this will avoid mysql_connect() deprecation error.
 error_reporting( ~E_DEPRECATED & ~E_NOTICE );
 // but I strongly suggest you to use PDO or MySQLi.
 
 define('DBHOST', 'localhost');
 define('DBUSER', 'root');
 define('DBPASS', '');
 define('DBNAME', 'home');
 
 $conn = mysql_connect(DBHOST,DBUSER,DBPASS);
 $dbcon = mysql_select_db(DBNAME);
 
 if ( !$conn ) {
  die("Connection failed : " . mysql_error());
 }
 
 if ( !$dbcon ) {
  die("Database Connection failed : " . mysql_error());
 }
 $name="";
 $nid="";
 if(isset($_POST['submit']))
 {
	 
	 $nid = $_POST['nid'];
	 $sql="SELECT * FROM forms1 where Nid=$nid";
	 $records=mysql_query($sql);
	 $qu=mysqli_fetch_row($sql);
	 if(!$qu){
		 header("Location: notfound.php");
	 }
	 if(!$records){die("Please enter your correct NID.");}
	 
	 if (empty($nid)) {
		 header("Location: nonid.php");
   
  } if (strlen($nid) <17) {
	  header("Location: lessthan17.php");
   $error = true;
   $nidError = "Please enter your correct NID.";
   echo "<center style='font-size:25px;font-weight:bold;font-family: helvetica; margin-top: 20%;'>Too less characters.NID must be of 17 digit</center>";
  } 
   if (strlen($nid) >17) {
	   header("Location: greater17.php");
   $error = true;
   $nidError = "Please enter your correct NID.";
   echo "<center style='font-size:25px;font-weight:bold;font-family: helvetica; margin-top: 20%;'>Too many characters.NID must be of 17 digit</center>";
  }


 
 
 
 $id = "";
 $name= "";
 $nid= "";
 $comment="";
 while($row=mysql_fetch_row($records))
 {
	 $id = $row[0];
	 $name = $row[1];
	 $nid = $row[2];
	 $comment = $row[3];
 }
 }
 ?>
 
 <html>
 <head>
 <title>
 NID verification
 </title>
 </head>
 <style>
 
 #formwrapper{
 	width: auto;
	height:auto;
	background-color:#E1E1E1;
 }
 </style>
 <body>
 
 <img style="position: absolute;margin-left: 450px;" src="dhaka-metropolitan-police-logo1.png"/>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

 
 <form method="post" action="<?php $_SERVER['PHP_SELF']?>" accept-charset='UTF-8' >
<fieldset style="margin-left: 290px; margin-right: 320px; ">


 
<label  for='nid'  >Give National ID Card number: *:</label>
<input style="margin-left: 90px;" type="text" name="nid" maxlength="50">
<input style="position: absolute;margin-left: 120px;" type="submit" name="submit" value="Submit">


 
 <p>
 
 ID: <?php
 echo $id;
 ?>
 </p>
 <p>
 Name: <?php
 echo $name;
 ?>
 </p>
 <p>
 NID: <?php
 echo $nid;
 ?>
 </p>
 Comment from DMP: <?php
 echo $comment;
 ?>
 </fieldset>
 </form>
 </body>
 </html>