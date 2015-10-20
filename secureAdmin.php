<?php
	if(empty($_SESSION['user'])) { 
		echo "<meta http-equiv=\"refresh\" content=\"0; url=logIn.php?continue=" . basename($_SERVER["SCRIPT_FILENAME"]) . "\" />";
	 } 
	 echo "This is an Admin only page";
 ?>