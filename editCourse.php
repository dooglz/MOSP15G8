<?php 
    require("preContent.php"); 
    require("secureAdmin.php");

    if(!empty($_POST)) {
        $query = " 
            UPDATE courses
            SET title = :name, 
                description = :description, 
                status = :status, 
                location = :location,
                maxEnrolled = :max,
                price = :price,
                start = :start,
                end = :end
            WHERE id =".$_GET['courseID']; 

        $query_params = array( 
            ':name' => $_POST['name'], 
            ':description' => $_POST['description'], 
            ':status' => 1,
            ':location' => $_POST['location'],
            ':max' => $_POST['max'],
            ':price' => $_POST['price'],
            ':start' => $_POST['start'],
            ':end' => $_POST['end']
        ); 
         
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 

        echo "Course Updated";
    }
    
    if(!isset($_GET['courseID']) || empty($_GET['courseID']))  {
        echo  "<a href='users.php'>Go Back</a><br>";
        die("courseget request invalid");
    }
    
    if($db === null){
      echo $dbmsg;
      include('postContent.php');
      die();
    }
    
    $query = "SELECT c.id, c.description, c.maxEnrolled as max, c.title, c.price, c.start, c.end, l.name AS location, l.id as locID
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
                Updating Course Info
            </div>
            <form action="editCourse.php?courseID=<?php echo $_GET['courseID']; ?>" method="post"> 
                <table class="table">  
                    <tr> 
                        <th>ID</th> 
                        <th>Title</th> 
                        <th>Description</th>
                        <th>Location</th>
                        <th>Price</th> 
                        <th>Max People</th>
                        <th>Start</th> 
                        <th>End</th>
                        <th>&nbsp;</th>
                    </tr><tr> 
                        <td><?php echo $course['id']; ?></td> 
                        <td><input type="text" size="10" class="form-control" name="name" value="<?php echo htmlentities($course['title'], ENT_QUOTES, 'UTF-8'); ?>"/></td> 
                        <td><textarea maxlength="2000" class="form-control" name="description" class="form-control"><?php echo htmlentities($course['description'], ENT_QUOTES, 'UTF-8'); ?></textarea></td> 
                        <td><select name="location" class="form-control">
                            <option value="">Select...</option>
                            <?php foreach($locations as $lRow): ?> 
                            <option value='<?php echo $lRow['id']; ?>' 
                                <?php 
                                if($course['locID'] == $lRow['id']) { 
                                    echo " selected=\"selected\" "; 
                                } ?> > <?php echo $lRow['name']; ?></option>
                            <?php endforeach; ?> 
                        </select></td>
                        <td><input type="text" size="3" class="form-control" name="price" value="<?php echo $course['price']; ?>"  /></td>
                        <td><input type="text" size="3" class="form-control" name="max" value="<?php echo $course['max']; ?>"  /></td>
                        <td><input name="start" size="12" type="text" value="<?php echo htmlentities(date( 'Y-m-d H:i', strtotime($course['start'])), ENT_QUOTES, 'UTF-8'); ?>" readonly class="form_datetime form-control"></td>
                        <td><input name="end" size="12" type="text" value="<?php echo htmlentities(date( 'Y-m-d H:i', strtotime($course['end'])), ENT_QUOTES, 'UTF-8'); ?>" readonly class="form_datetime form-control"></td>
                        <td><input type="submit" value="Save" class="btn-primary" /> </td>
                    </tr>  
                </table>
            </form>
            <script>
                $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
            </script>
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
    <a href="courseManagement.php">Go back?</a>
</div>
<?php 
    require("postContent.php"); 
?>