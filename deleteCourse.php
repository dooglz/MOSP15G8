<?php
    include('preContent.php');

    if(!isset($_GET['course']) || empty($_GET['course']))  {
        echo  "<a href='courseManagement.php'>Go Back</a><br>";
        die("Request invalid");
    }

    $query = "UPDATE courses
    SET courses.status = 2
    WHERE courses.id = " . $_GET['course'];

	try { 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
    } catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    }

    echo 'Course Deleted!';
?>

<br />
<a href="courseManagement.php">Go back?</a>

<?php
    include('afterContent.php');
?>


