<?php

 // this will avoid mysql_connect() deprecation error.
 error_reporting( ~E_DEPRECATED & ~E_NOTICE );
 // but I strongly suggest you to use PDO or MySQLi.
 
 define('DBHOST', 'localhost');
 define('DBUSER', 'root');
 define('DBPASS', '');
 define('DBNAME', 'home');
 
 $conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

 
 if ( !$conn ) {
  die("Connection failed : " . mysql_error());
 }
 

 ?>