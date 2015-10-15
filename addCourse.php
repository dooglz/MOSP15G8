<?php 
    require("preContent.php"); 

    // Should make a secureAdmin
    require("secureUser.php");


	$locationsQuery = "SELECT id, name FROM locations"; 
     
    try { 
        $stmt = $db->prepare($locationsQuery); 
        $stmt->execute(); 
    } catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $locations = $stmt->fetchAll(); 

    if(!empty($_POST)) { 

		if(empty($_POST['name'])) { 
            die("Please enter a course name."); 
        } 
        if(empty($_POST['description'])) { 
            die("Please enter a course description."); 
        } 
        if(empty($_POST['location'])) { 
            die("Please enter a course location."); 
        } 
        if(empty($_POST['start'])) { 
            die("Please enter a course start date."); 
        } 
        if(empty($_POST['end'])) { 
            die("Please enter a course end date."); 
        } 

    	$query = " 
            INSERT INTO courses ( 
                title, 
                description, 
                status, 
                location,
                start,
                end
            ) VALUES ( 
                :name, 
                :description, 
                :status, 
                :location,
                :start,
                :end 
            ) 
        "; 

        $query_params = array( 
            ':name' => $_POST['name'], 
            ':description' => $_POST['description'], 
            ':status' => 1,
            ':location' => $_POST['location'],
            ':start' => $_POST['start'],
            ':end' => $_POST['end']
        ); 
         
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        }

        echo "Course Successfully Created!";
    }
?>

<h1>Create Course</h1> 
<form action="addCourse.php" method="post"> 
    Course Name:<br /> 
    <input type="text" name="name" value=""/> 
    <br /><br /> 
    Course Description:<br /> 
    <input type="text" name="description" value=""  /> 
    <br /><br /> 
    Course Location:<br /> 
    <select name="location">
  		<option value="">Select...</option>
  		<?php foreach($locations as $row): ?> 
  		<option value="1"><?php echo $row['name']; ?></option>
  		<?php endforeach; ?> 
	</select>
    <br /><br />
    Start Date / Time <br />
    <input name="start" size="35" type="text" value="" readonly class="form_datetime">
    <br /><br />
    End Date / Time <br />
    <input name="end" size="35" type="text" value="" readonly class="form_datetime">
    <br /> 
    <input type="submit" value="Create" /> 
</form> 

<script>
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script>
<br />
<a href="courseManagement.php">Go back?</a>

<?php 
    require("postContent.php"); 
?>