<?php
    include('preContent.php');

    unset($_SESSION['user']); 
     
    echo "<meta http-equiv=\"refresh\" content=\"2; url=index.php\" />";
                die("Logged out, redirecting.");

    include('postContent.php');
?>