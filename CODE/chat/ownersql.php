<?php


?>
<?php
    if(isset($_POST['nw_update'])){
        $uname = "user1";
			if (isset($_POST['user1'])) {
			mysqli_query($link,"INSERT INTO chat(Sender) VALUES('$uname')"); 
	
        //and then execute a sql query here
    }
    else {
    header("Location: ownerlist.php");
    }
}
?>