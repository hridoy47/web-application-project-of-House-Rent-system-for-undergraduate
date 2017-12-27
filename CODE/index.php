<?php
include_once("db_connection.php");
$q="SELECT ip from visitors";
$number= mysqli_query($conn, $q);
$visitor=mysqli_num_rows($number);
?>
<form class="form-group">
<center><table>

<tr>
<th>
<?php

echo "Total Count:";

?>

<?php
echo "$visitor <br/>";
?>
</td>
</tr>
<tr>
    <th>IP List</th>
    <th>Date & Time</th>
    
  </tr>
<?php
$sql1 = "SELECT ip,date FROM visitors order by date desc";
$result1 = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result1) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result1)) {
                echo "<tr> <td>" . $row["ip"]. "</td><td> " . $row["date"].  "</td></tr>";
    }
} else {
    echo "0 results";
}
?>
</table></center>
</form>
<?php



mysqli_close($conn);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
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
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
	margin-left:50px;
	margin-top:25px;
	
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>

<body>
</body>
</html>