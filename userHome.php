<?php 
    require("common.php"); 
    require("secureUser.php");
?> 

Hello <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>, this is your account management page!<br />

<p>
	<a href="logOut.php">Log Out</a>
</p>