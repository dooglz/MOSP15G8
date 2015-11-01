<?php 
    require("preContent.php"); 
    require("secureAdmin.php");
    if($db === null){
      echo $dbmsg;
      include('postContent.php');
      die();
    }
    $query = " 
        SELECT * FROM news
    "; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $rows = $stmt->fetchAll(); 
?> 
<h1>News and Offers</h1> 
<table class="table"> 
    <tr> 
        <th>ID</th> 
        <th>Content</th> 
        <th>Date</th>
        <th>&nbsp;</th>
    </tr> 
    <?php foreach($rows as $row): ?> 
        <tr> 
            <td><?php echo $row['id']; ?></td>  
            <td><?php echo htmlentities($row['content'], ENT_QUOTES, 'UTF-8'); ?></td> 
            <td><?php echo htmlentities($row['date'], ENT_QUOTES, 'UTF-8'); ?></td> 
            <td><a href="deleteNews.php?news=<?php echo $row['id']; ?>">Delete</a></td>
        </tr> 
    <?php endforeach; ?> 
</table> 
<a href="addNews.php">Add News/Offer</a><br />
<a href="admin.php">Go back?</a><br />

<?php 
    require("postContent.php"); 
?>