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
    
    $query = "SELECT c.id, c.description, c.title, c.price, c.start, c.end, l.name AS location, l.id as locID
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

    $locationsQuery = "SELECT id, name FROM locations"; 
    try { 
        $stmt = $db->prepare($locationsQuery); 
        $stmt->execute(); 
    } catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    }     
    $locations = $stmt->fetchAll(); 
    

?> 
<div class="row"><h3>Course Info</h3></div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Course Info
            </div>
            <form action="editCourse.php?courseID=<?php echo $_GET['courseID']; ?>" method="post"> 
                <table class="table">  
                    <tr> 
                        <th>ID</th> 
                        <th>Title</th> 
                        <th>Description</th>
                        <th>Location</th>
                        <th>Price</th> 
                        <th>Start</th> 
                        <th>End</th>
                        <th>&nbsp;</th>
                    </tr><tr> 
                        <td><?php echo $course['id']; ?></td> 
                        <td><input type="text" name="name" value="<?php echo htmlentities($course['title'], ENT_QUOTES, 'UTF-8'); ?>"/></td> 
                        <td><textarea maxlength="2000"  name="description"><?php echo htmlentities($course['description'], ENT_QUOTES, 'UTF-8'); ?></textarea></td> 
                        <td><select name="location">
                            <option value="">Select...</option>
                            <?php foreach($locations as $lRow): ?> 
                            <option value='<?php echo $lRow['id']; ?>' 
                                <?php 
                                if($course['locID'] == $lRow['id']) { 
                                    echo " selected=\"selected\" "; 
                                } ?> > <?php echo $lRow['name']; ?></option>
                            <?php endforeach; ?> 
                        </select></td>
                        <td><input type="text" size="5" name="price" value="<?php echo $course['price']; ?>"  /></td>
                        <td><input name="start" size="16" type="text" value="<?php echo htmlentities(date( 'd/m/Y H:i', strtotime($course['start'])), ENT_QUOTES, 'UTF-8'); ?>"></td>
                        <td><input name="end" size="16" type="text" value="<?php echo htmlentities(date( 'd/m/Y H:i', strtotime($course['end'])), ENT_QUOTES, 'UTF-8'); ?>"></td>
                        <td><input type="submit" value="Save" /> </td>
                    </tr>  
                </table>
            </form>
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
                    <?php if(count($delegates) == 0){ echo "<h4>No users enrolled on this course yet.</h4>"; } ?>
                    <?php foreach($delegates as $row): ?> 
                        <li class="list-group-item"><a href="editUser.php?userID=<?php echo $row['id'] . "\"> ID: ".$row['id']." Username: ". $row['username'] ?></i></a></li>
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