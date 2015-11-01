<?php
	require('preContent.php');
    require("secureAdmin.php");

    $query = "SELECT c.id, c.title, c.price, c.start, c.end, count(ce.course_id) as enrolled, c.maxEnrolled, l.name AS location 
    FROM courses as c 
    INNER JOIN locations AS l ON c.location = l.id
    LEFT JOIN  course_enrollment as ce ON ce.course_id = c.id
    WHERE c.status = 1 and c.start >= NOW()
    GROUP BY c.id
    ORDER BY c.start ASC"; 
     
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
        <th>Enrolled</th>
        <th>Price</th>  
        <th>Start</th> 
        <th>End</th>
        <th>&nbsp;</th>
    </tr> 
    <?php foreach($rows as $row): ?> 
        <tr> 
            <td><?php echo $row['id']; ?></td> 
            <td><a href="editCourse.php?courseID=<?php echo $row['id']; ?>"><?php echo htmlentities($row['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $row['enrolled']; ?>/<?php echo $row['maxEnrolled']; ?></td>
            <td>£<?php echo $row['price']; ?></td>
            <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($row['start'])), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($row['end'])), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><a href="deleteCourse.php?course=<?php echo $row['id']; ?>">Cancel Course</a> <?php 
            if(strtotime("+17 days") > strtotime($row['start']) && strtotime("+14 days") < strtotime($row['start']) && $row['enrolled'] < 5) { 
                ?> ; <b style="color: red">3 Day Warning</b><?php } ?>
            <?php if(strtotime("+14 days") > strtotime($row['start']) && $row['enrolled'] < 5) { ?> ; <b style="color: red">Undersubscribed!</b> <?php } ?></td>
        </tr> 
    <?php endforeach; ?> 
</table> 

<p> <a href="addCourse.php">Add Course</a><br />
	<a href="admin.php">Go back?</a>
</p>

<?php
   include('postContent.php');
?>