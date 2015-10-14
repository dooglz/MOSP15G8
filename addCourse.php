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
                1, 
                :location,
                now(),
                now() 
            ) 
        "; 

        $query_params = array( 
            ':name' => $_POST['name'], 
            ':description' => $_POST['description'], 
            ':location' => $_POST['location'], 
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
    <input type="submit" value="Create" /> 
</form> 

<a href="courseManagement.php">Go back?</a>

<?php 
    require("postContent.php"); 
?>