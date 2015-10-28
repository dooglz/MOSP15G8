<?php 
    require("preContent.php"); 
    require("secureAdmin.php");
    if($db === null){
      echo $dbmsg;
      include('postContent.php');
      die();
    }
    $query = " 
        SELECT * FROM locations
    "; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $rows = $stmt->fetchAll(); 
?> 
<h1>Locations</h1> 
<table class="table"> 
    <tr> 
        <th>ID</th> 
        <th>Name</th> 
        <th>Address</th>
        <th>Latitude</th> 
        <th>Longitude</th>
    </tr> 
    <?php foreach($rows as $row): ?> 
        <tr> 
            <td><?php echo $row['id']; ?></td> 
            <td><a href="locationTimetable.php?location=<?php echo $row['id']; ?>"><?php echo htmlentities($row['name'], ENT_QUOTES, 'UTF-8'); ?></a></td> 
            <td><?php echo htmlentities($row['address'], ENT_QUOTES, 'UTF-8'); ?></td> 
            <td><?php echo htmlentities($row['lat'], ENT_QUOTES, 'UTF-8'); ?></td> 
            <td><?php echo htmlentities($row['lon'], ENT_QUOTES, 'UTF-8'); ?></td> 
        </tr> 
    <?php endforeach; ?> 
</table> 
<a href="addLocation.php">Add Location</a><br />
<a href="admin.php">Go back?</a><br />

<?php 
    require("postContent.php"); 
?>