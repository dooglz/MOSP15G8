<?php
  $activePage = "courses";
  include('preContent.php');
  if($db === null){
    echo $dbmsg;
    include('postContent.php');
    die();
  }
  
  $query = "SELECT c.id, c.title, c.price, c.start, c.end, count(ce.course_id) as enrolled, c.maxEnrolled, l.id as locId, l.name as locName 
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
    </tr> 
    <?php foreach($rows as $row): ?> 
        <tr> 
            <td><?php echo $row['id']; ?></td> 
            <td><a href="viewCourse.php?course=<?php echo $row['id']; ?>"><?php echo htmlentities($row['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
            <td><a href="viewLocation.php?loc=<?php echo $row['locId']; ?>"><?php echo htmlentities($row['locName'], ENT_QUOTES, 'UTF-8'); ?></a></td>
            <td><?php echo $row['enrolled']; ?>/<?php echo $row['maxEnrolled']; ?></td>
            <td>£<?php echo $row['price']; ?></td>
            <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($row['start'])), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($row['end'])), ENT_QUOTES, 'UTF-8'); ?></td>
        </tr> 
    <?php endforeach; ?> 
</table> 


<br /> <br />
<b>You can sign up for courses offline by sending <a href="offline-pdf.pdf">this application form</a> to the enclosed address, with a cheque written out to "Napier Management Training".</b>
<?php
    	include('postContent.php');
?>