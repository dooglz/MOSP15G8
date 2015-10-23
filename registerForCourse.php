<?php 
    require("preContent.php"); 
    require("secureUser.php");
    
    if(!isset($_GET['course']) || empty($_GET['course']))  {
        echo  "<a href='courses.php'>Go Back</a><br>";
        die("Course get request invalid");
    }
    $query = "SELECT * FROM course_enrollment WHERE course_id = " . $_GET['course'] ." AND user_id=". $_SESSION['user']['id']; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $row = $stmt->fetch(); 
    if($row) { 
        echo  "<a href='courses.php'>Go Back</a><br>";
        die("You are already registered on this course");
    } 
    
    $query = "INSERT INTO course_enrollment ( course_id,  user_id ) VALUES ( :course_id, :user_id )"; 
     
    $query_params = array( 
        ':course_id' =>$_GET['course'] , 
        ':user_id' => $_SESSION['user']['id'], 
    );   
      
    try { 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
    } catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
    
    echo "<meta http-equiv=\"refresh\" content=\"2; url=viewCourse.php?course=".$_GET['course']."\" />";
    die("<h4>Payment Accepted!</h4> <br />Successfully enrolled");
 ?>

