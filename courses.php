<?php
    include('preContent.php');
     
    $query = "SELECT c.id, c.title, s.description AS status, c.start, c.end, l.name AS location 
    FROM courses as c 
    INNER JOIN locations AS l ON c.location = l.id
    INNER JOIN status AS s ON c.status = s.id"; 
     
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
        <th>ID</th> 
        <th>Title</th> 
        <th>Status</th> 
        <th>Location</th> 
        <th>Start</th> 
        <th>End</th>
    </tr> 
    <?php foreach($rows as $row): ?> 
        <tr> 
            <td><?php echo $row['id']; ?></td> 
            <td><a href="#"><?php echo htmlentities($row['title'], ENT_QUOTES, 'UTF-8'); ?></a></td> 
            <td><?php echo htmlentities($row['status'], ENT_QUOTES, 'UTF-8'); ?></td> 
            <td><a href="#"><?php echo htmlentities($row['location'], ENT_QUOTES, 'UTF-8'); ?></a></td>
            <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($row['start'])), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($row['end'])), ENT_QUOTES, 'UTF-8'); ?></td>
        </tr> 
    <?php endforeach; ?> 
</table> 


<?php
    include('afterContent.php');
?>