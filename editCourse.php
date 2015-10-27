<?php 
    require("preContent.php"); 
    require("secureAdmin.php");
    
    if(!isset($_GET['courseID']) || empty($_GET['courseID']))  {
        echo  "<a href='users.php'>Go Back</a><br>";
        die("courseget request invalid");
    }
    
    if($db === null){
      echo $dbmsg;
      include('postContent.php');
      die();
    }
    
    $query = "SELECT c.id, c.title, c.start, c.end, l.name AS location 
        FROM courses as c 
        INNER JOIN locations AS l ON c.location = l.id
        WHERE c.id =" .$_GET['courseID']; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $course = $stmt->fetch(); 
    
    $query = "SELECT DISTINCT u.id, u.username
        FROM users as u 
        INNER JOIN course_enrollment as ce on ce.user_id = u.id
        WHERE ce.course_id = ".$_GET['courseID']; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $delegates = $stmt->fetchAll(); 
    

?> 
<div class="row"><h3>Course Info</h3></div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Course Info
            </div>
            <table class="table">  
                <tr> 
                    <th>Course ID</th> 
                    <th>Title</th> 
                    <th>Location</th> 
                    <th>Start</th> 
                    <th>End</th>
                    <th>&nbsp;</th>
                </tr><tr> 
                    <td><?php echo $course['id']; ?></td> 
                    <td><a href="#"><?php echo htmlentities($course['title'], ENT_QUOTES, 'UTF-8'); ?></a></td> 
                    <td><?php echo $course['location']; ?></td>
                    <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($course['start'])), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($course['end'])), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href="deleteCourse.php?course=<?php echo $course['id']; ?>">Cancel Course</a> ; <a href="#">Modify Course</a></td>
                </tr>  
            </table>
        </div>
    </div>
 </div>
 <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               Delegates Enrolled on this Course.
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <?php if(count($delegates) == 0){ echo "<h4>User not registered to any courses yet.</h4>"; } ?>
                    <?php foreach($delegates as $row): ?> 
                        <li class="list-group-item"><a href="editUser.php?userID=<?php echo $row['id'] . "\"> ID: ".$row['id']." Username:". $row['username'] ?></i></a></li>
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