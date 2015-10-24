<?php
  $activePage = "home";
	include('preContent.php');
	require("common.php");

	if(empty($_SESSION['user']))  {
		echo "You are not logged in! <a href=\"logIn.php\">Log in</a>";
	} else {
		include('userHome.php');
	}
?>


<?php
	include('postContent.php');
?>