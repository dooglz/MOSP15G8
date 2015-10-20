<?php
    include('preContent.php');

    if(!isset($_GET['course']) || empty($_GET['course']))  {
        echo  "<a href='cources.php'>Go Back</a><br>";
        die("Course get request invalid");
    }

	$query = "SELECT c.title, c.description, l.name as locName, l.id as locId
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
         
    $row = $stmt->fetch(); 
?>
<h2><?php echo $row['title']; ?></h2>
<br />
<b>Description: </b> <?php echo $row['description']; ?>
<br /><br />
<b>Location: </b> <a href="viewLocation.php?loc=<?php echo $row['locId']; ?>"><?php echo htmlentities($row['locName'], ENT_QUOTES, 'UTF-8'); ?></a>
<br /><br />
<b>Number of people on course: </b>0 / 15
<br /><br />
<a href="registerForCourse.php?course=<?php echo $_GET['course']; ?>"><button type="submit" class="btn btn-primary ">Sign up for this course!</button></a>
<br />
<a href="courses.php">Go back?</a>

<?php
    include('afterContent.php');
?>


