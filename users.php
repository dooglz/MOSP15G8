<?php 
    require("preContent.php"); 
    require("secureAdmin.php");
    if($db === null){
      echo $dbmsg;
      include('postContent.php');
      die();
    }
    $query = " 
        SELECT 
            id, 
            username, 
            email 
        FROM users 
    "; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $rows = $stmt->fetchAll(); 
?> 
<div class="row">
    <div class="col-md-12">
        <h1>Member List</h1> 
        <table class="table"> 
            <tr> 
                <th>ID</th> 
                <th>Username</th> 
                <th>E-Mail Address</th> 
            </tr> 
            <?php foreach($rows as $row): ?> 
                <tr> 
                    <td><?php echo $row['id']; ?></td> 
                    <td><a href="editUser.php?userID=<?php echo $row['id']; ?>"><?php echo htmlentities($row['username'], ENT_QUOTES, 'UTF-8'); ?></a></td> 
                    <td><?php echo htmlentities($row['email'], ENT_QUOTES, 'UTF-8'); ?></td> 
                </tr> 
            <?php endforeach; ?> 
        </table> 
    </div>
</div>
<a href="admin.php">Go Back?</a>

<?php 
    require("postContent.php"); 
?>