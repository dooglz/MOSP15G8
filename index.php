<?php
  $activePage = "home";
	include('preContent.php');
	require("common.php");

	if(empty($_SESSION['user']))  {
		echo "You are not logged in! <a href=\"logIn.php\">Log in</a>";
	} else {
		echo "Welcome back " . $_SESSION['user']['username'];
		if(!empty($_SESSION['user']['permissionLevel']) && $_SESSION['user']['permissionLevel'] >0)  {
			echo "<br><b>Adminstrator Status</b><br>";
		}
		echo "<br><a href=\"logOut.php\">Log out</a><br><br>";
	}
?>

<p>
<a href="courses.php">View Courses</a>
</p>

<?php
	include('postContent.php');
?>