<?php
	if(empty($_SESSION['user'])) { 
	        header("Location: logIn.php?continue=" . basename($_SERVER["SCRIPT_FILENAME"])); 
	        die("Redirecting to logIn.php"); 
	 } 
 ?>