<?php
    include('preContent.php');

    if(!isset($_GET['course']) || empty($_GET['course']))  {
        echo  "<a href='courses.php'>Go Back</a><br>";
        die("Course get request invalid");
    }

	$query = "SELECT c.title, c.description, c.maxEnrolled, l.name as locName, l.id as locId
    FROM courses AS c 
    INNER JOIN locations AS l ON c.location = l.id
    WHERE c.id = " . $_GET['course'];
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    }  
    $course = $stmt->fetch(); 


    $query2 = "SELECT count(c.course_id) as count
    FROM course_enrollment AS c 
    WHERE c.course_id = " . $_GET['course'];
     
    try { 
        $stmt = $db->prepare($query2); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    }          
    $enrolled = $stmt->fetch(); 

    $query3 = "SELECT count(c.user_id) as isEnrolled
    FROM course_enrollment AS c 
    WHERE c.user_id = " . $_SESSION['user']['id'];
     
    try { 
        $stmt = $db->prepare($query3); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $isUserEnrolled = $stmt->fetch(); 
?>
<h2><?php echo $course['title']; ?></h2>
<br />
<b>Description: </b> <?php echo $course['description']; ?>
<br /><br />
<b>Location: </b> <a href="viewLocation.php?loc=<?php echo $course['locId']; ?>"><?php echo htmlentities($course['locName'], ENT_QUOTES, 'UTF-8'); ?></a>
<br /><br />
<b>Number of people on course: </b><?php echo $enrolled['count'] ?> / <?php echo $course['maxEnrolled'] ?>
<br /><br />
<?php 
    if(!empty($_SESSION['user'])  && $enrolled['count'] != $course['maxEnrolled'] && $isUserEnrolled['isEnrolled'] != 1) { 
        echo '<a href="registerForCourse.php?course='.$_GET['course'].'"><button type="submit" class="btn btn-primary ">Sign up for this course!</button></a>';
    } else if($isUserEnrolled['isEnrolled'] == 1) {
        echo '<button type="submit" class="btn btn-danger">You\'re already signed up for this course!</button>';
    } else if($enrolled['count'] == $course['maxEnrolled']) {
        echo '<button type="submit" class="btn btn-info">This course is full.</button>';
    }
?>

<br />
<a href="courses.php">Go back?</a>

<?php
    include('afterContent.php');
?>


