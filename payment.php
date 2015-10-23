<?php
    include('preContent.php');
?>


<h3>Payment</h3>

<p>To enroll in this course you need to pay £<?php echo $_GET['price']; ?></p>

<a href="registerForCourse.php?course=<?php echo $_GET['course']; ?>"><img src="/mosp/img/paypal_logo.png"></img>

<br /><br />
<a href="courses.php">Cancel</a>

<?php 
    require("postContent.php"); 
?>