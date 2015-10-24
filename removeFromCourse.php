<?php
    include('preContent.php');

    if(!isset($_GET['course']) || empty($_GET['course']))  {
        echo  "<a href='courses.php'>Go Back</a><br>";
        die("Request invalid");
    }

    $query = "DELETE FROM course_enrollment WHERE course_id = " . $_GET['course'] . " AND user_id = " . $_SESSION['user']['id'];

	try { 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
    } catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    }

    echo 'You are no longer registered to this course. If you are eligible for a refund it may take 5-8 working days. Please contact billing for more details.';
?>

<br />
<a href="courses.php">Go back?</a>

<?php
   include('postContent.php');
?>


