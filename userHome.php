<?php 
    $query = "SELECT DISTINCT c.id, c.title, c.start
    FROM courses as c 
    INNER JOIN course_enrollment as ce on ce.course_id = c.id
    WHERE c.status = 1 AND ce.user_id = 4"; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $rows = $stmt->fetchAll(); 
?> 

<h3>My courses</h3>
<ul class="list-group">
	<?php if(count($rows) == 0){ echo "<h4>You're not registered to any courses yet.</h4>"; } ?>
	<?php foreach($rows as $row): ?> 
		<li class="list-group-item"><a href="viewCourse.php?course=<?php echo $row['id'] . "\">". $row['title'] . " - <i>" . $row['start']; ?></i></a></li>
	<?php endforeach; ?>
</ul>



<p>
	<a href="logOut.php">Log Out</a>
</p>

<?php
if(!empty($_SESSION['user']['permissionLevel']) && $_SESSION['user']['permissionLevel'] >0)  {
            echo "<p><a href=\"admin.php\">Adminstrator Status</a></p>";
        }

?>