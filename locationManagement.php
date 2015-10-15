<?php 
    require("preContent.php"); 
    require("secureUser.php");
     
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
        <th>Latitude</th> 
        <th>Longitude</th>
        <th>&nbsp;</th>
    </tr> 
    <?php foreach($rows as $row): ?> 
        <tr> 
            <td><?php echo $row['id']; ?></td> 
            <td><a href="#"><?php echo htmlentities($row['name'], ENT_QUOTES, 'UTF-8'); ?></a></td> 
            <td><?php echo htmlentities($row['lat'], ENT_QUOTES, 'UTF-8'); ?></td> 
            <td><?php echo htmlentities($row['lon'], ENT_QUOTES, 'UTF-8'); ?></td> 
            <td><a href="#">Delete Location</a> ; <a href="#">Modify Location</td> 
        </tr> 
    <?php endforeach; ?> 
</table> 
<a href="addLocation.php">Add Location</a><br />
<a href="admin.php">Go Back</a><br />

<?php 
    require("postContent.php"); 
?>