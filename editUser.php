<?php 
    require("preContent.php"); 
    require("secureAdmin.php");
    
    if(!isset($_GET['userID']) || empty($_GET['userID']))  {
        echo  "<a href='users.php'>Go Back</a><br>";
        die("userID get request invalid");
    }
    
    if($db === null){
      echo $dbmsg;
      include('postContent.php');
      die();
    }
    
    $query = " SELECT id, username, email, permissionLevel
                FROM users 
                where id =".$_GET['userID']; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $user = $stmt->fetch(); 
    
    $query = "SELECT DISTINCT c.id, c.title, c.start
    FROM courses as c 
    INNER JOIN course_enrollment as ce on ce.course_id = c.id
    WHERE c.status = 1 AND ce.user_id = ".$_GET['userID']; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $courses = $stmt->fetchAll(); 
?> 
<div class="row"><h3>User Info</h3></div>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                User Info
            </div>
            <table class="table">  
            <?php 
                echo "<tr><th>ID</th> <th>" . $user['id']."</th></tr>";
                echo "<tr><th>username</th> <th>" . $user['username']."</th></tr>";
                echo "<tr><th>email</th> <th>" . $user['email']."</th></tr>";
                echo "<tr><th>permissionLevel</th> <th>" . $user['permissionLevel']."</th></tr>";
            ?>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
               Courses
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <?php if(count($courses) == 0){ echo "<h4>User not registered to any courses yet.</h4>"; } ?>
                    <?php foreach($courses as $row): ?> 
                        <li class="list-group-item"><a href="viewCourse.php?course=<?php echo $row['id'] . "\">". $row['title'] . " - <i>" . $row['start']; ?></i></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <a href="users.php">Go back?</a>
</div>
<?php 
    require("postContent.php"); 
?>