<?php
  include('preContent.php');
  
  if($db === null){
    echo $dbmsg;
    include('postContent.php');
    die();
  }
  
  $query = "SELECT c.id, c.title, c.maxEnrolled, c.start, c.end, l.name AS locName, l.id AS locId
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
    </tr> 
    <?php foreach($rows as $row): ?> 
        <tr> 
            <td><?php echo $row['id']; ?></td> 
            <td><a href="viewCourse.php?course=<?php echo $row['id']; ?>"><?php echo htmlentities($row['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
            <td><a href="viewLocation.php?loc=<?php echo $row['locId']; ?>"><?php echo htmlentities($row['locName'], ENT_QUOTES, 'UTF-8'); ?></a></td>
            <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($row['start'])), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($row['end'])), ENT_QUOTES, 'UTF-8'); ?></td>
        </tr> 
    <?php endforeach; ?> 
</table> 

<?php
    	include('postContent.php');
?>