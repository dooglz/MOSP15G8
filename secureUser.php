<?php
	if(empty($_SESSION['user'])) { 
	        header("Location: logIn.php"); 
	        die("Redirecting to logIn.php"); 
	 } 
 ?>