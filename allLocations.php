<?php 

    require("preContent.php"); 

    if($db === null){
      echo $dbmsg;
      include('postContent.php');
      die();
    }

    $query = "SELECT loc.id, loc.name, loc.address FROM locations as loc"; 
     
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
        <th>Name</th>
        <th>Address</th>
    </tr>
    <?php foreach($rows as $row): ?>
        <tr>
            <td>
                <a href="viewLocation.php?loc=<?php echo $row['id']; ?>">
                    <?php echo htmlentities($row['name'], ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </td>
            <td>
                <?php echo htmlentities($row['address'], ENT_QUOTES, 'UTF-8'); ?>
            </td>
        </tr>
        <?php endforeach; ?>
</table>
<?php 
    require("postContent.php"); 
?>