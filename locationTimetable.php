<?php
	require('preContent.php');
    require("secureAdmin.php");

    $query = "SELECT c.id, c.title, c.start, c.end, l.name AS location 
    FROM courses as c 
    INNER JOIN locations AS l ON c.location = l.id
    WHERE c.status = 1 AND l.id" = .$_GET['location'] .
    "ORDER BY c.start ASC"; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $rows = $stmt->fetchAll(); 
?> 
<h1>Venue Timetable</h1> 
<table class="table"> 
    <tr> 
        <th>Course ID</th> 
        <th>Title</th> 
        <th>Start</th> 
        <th>End</th>
    </tr> 
    <?php foreach($rows as $row): ?> 
        <tr> 
            <td><?php echo $row['id']; ?></td> 
            <td><a href="viewCourse.php?course=<?php echo $row['c.id']; ?>"><?php echo htmlentities($row['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
            <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($row['start'])), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($row['end'])), ENT_QUOTES, 'UTF-8'); ?></td>
        </tr> 
    <?php endforeach; ?> 
</table> 

<p> <a href="locationManagement.php">Go back?</a>
</p>

<?php
   include('postContent.php');
?>