<?php
	if(empty($_SESSION['user'])) { 
		echo "<meta http-equiv=\"refresh\" content=\"0; url=logIn.php?continue=" . basename($_SERVER["SCRIPT_FILENAME"]) . "\" />";
	 }  else {
	 	$query = "SELECT u.permissionLevel
  			FROM users AS u
  			WHERE u.username = '" . $_SESSION['user']['username'] . "'";
     
	    try { 
	         $stmt = $db->prepare($query); 
	         $stmt->execute(); 
	    } catch(PDOException $ex) { 
	        die("Failed to run query: " . $ex->getMessage()); 
	    } 
	         
	    $row = $stmt->fetch();
	    if($row['permissionLevel'] != 1){
	    	echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\" />";
	    } 
	 }
	 
 ?>