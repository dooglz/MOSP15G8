<?php
	require('preContent.php');
    require("secureAdmin.php");

    $query = "SELECT c.id, c.title, c.start, c.end, l.name AS location 
    FROM courses as c 
    INNER JOIN locations AS l ON c.location = l.id
    WHERE c.status = 1"; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $rows = $stmt->fetchAll(); 
?> 
<h1>Course List</h1> 
<table class="table"> 
    <tr> 
        <th>Course ID</th> 
        <th>Title</th> 
        <th>Location</th> 
        <th>Start</th> 
        <th>End</th>
        <th>&nbsp;</th>
    </tr> 
    <?php foreach($rows as $row): ?> 
        <tr> 
            <td><?php echo $row['id']; ?></td> 
            <td><a href="#"><?php echo htmlentities($row['title'], ENT_QUOTES, 'UTF-8'); ?></a></td> 
            <td><a href="#"><?php echo htmlentities($row['location'], ENT_QUOTES, 'UTF-8'); ?></a></td>
            <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($row['start'])), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($row['end'])), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><a href="deleteCourse.php?course=<?php echo $row['id']; ?>">Cancel Course</a> ; <a href="#">Modify Course</a></td>
        </tr> 
    <?php endforeach; ?> 
</table> 

<p> <a href="addCourse.php">Add Course</a><br />
	<a href="admin.php">Go back?</a>
</p>

<?php
    include('afterContent.php');
?>