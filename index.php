<?php
require("common.php");

if(empty($_SESSION['user']))  {
	echo "You are not logged in! <a href=\"logIn.php\">Log in</a>";
} else {
	echo "Welcome back " . $_SESSION['user']['username'];
}

?>

<div>
<p>
<a href="courses.php">View Courses</a>
</p>
</div>

</html>