<?php
	require('preContent.php');
    require("secureAdmin.php");

    if(!empty($_POST)) {
        $query = " 
            UPDATE locations
            SET name = :name, 
                address = :address, 
                lat = :lat, 
                lon = :lon
            WHERE id =".$_GET['location']; 

        $query_params = array( 
            ':name' => $_POST['name'], 
            ':address' => $_POST['address'], 
            ':lat' => $_POST['lat'],
            ':lon' => $_POST['lng']
        ); 
         
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 

        echo "Location Updated";
    }

    $query = "SELECT c.id, c.title, c.start, c.end, l.name AS location 
    FROM courses as c 
    INNER JOIN locations AS l ON c.location = l.id
    WHERE c.status = 1 AND l.id =" .$_GET['location']; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $rows = $stmt->fetchAll(); 

    $query = "SELECT * FROM locations
        WHERE locations.id =" .$_GET['location']; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $location = $stmt->fetch(); 
?> 

<div class="row"><h3>Location Info</h3></div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Update Location Info
            </div>
            <form action="locationTimetable.php?location=<?php echo $_GET['location']; ?>" method="post"> 
                <table class="table">  
                    <tr> 
                        <th>ID</th> 
                        <th>Name</th> 
                        <th>Address</th>
                        <th>Lat</th>
                        <th>Lng</th>
                    </tr><tr> 
                        <td><?php echo $location['id']; ?></td> 
                        <td><input type="text" name="name" class="form-control" value="<?php echo htmlentities($location['name'], ENT_QUOTES, 'UTF-8'); ?>"/></td> 
                        <td><input type="text" size="20" class="form-control" name="address" value="<?php echo $location['address']; ?>"  /></td>
                        <td><input type="text" size="10" class="form-control" name="lat" value="<?php echo $location['lat']; ?>"  /></td>
                        <td><input type="text" size="10" class="form-control" name="lng" value="<?php echo $location['lon']; ?>"  /></td>
                        <td><input type="submit" value="Save" class="btn-primary"/> </td>
                    </tr>  
                </table>
            </form>
        </div>
    </div>
 </div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Venue Timetable</div>
                <table class="table"> 
                    <tr> 
                        <th>Course ID</th> 
                        <th>Title</th> 
                        <th>Start</th> 
                        <th>End</th>
                    </tr> 
                    <?php foreach($rows as $row): ?> 
                        <tr> 
                            <td><?php echo $row['id']; ?></td> 
                            <td><a href="viewCourse.php?course=<?php echo $row['id']; ?>"><?php echo htmlentities($row['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                            <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($row['start'])), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlentities(date( 'd/m/Y H:i', strtotime($row['end'])), ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr> 
                    <?php endforeach; ?> 
                </table> 
            </div>
        </div>
</div>

<p> <a href="locationManagement.php">Go back?</a>
</p>

<?php
   include('postContent.php');
?>