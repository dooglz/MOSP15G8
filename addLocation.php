<?php 
    require("preContent.php"); 
    require("secureAdmin.php");

    if($db === null){
      echo $dbmsg;
      include('postContent.php');
      die();
    }

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
            die("Please enter a location name."); 
        } 
        if(empty($_POST['lat'])) { 
            die("Please enter a location latitude."); 
        } 
        if(empty($_POST['lon'])) { 
            die("Please enter a location longitude."); 
        } 
        if(empty($_POST['address'])) { 
            die("Please enter a location address."); 
        } 


    	$query = " 
            INSERT INTO locations ( 
                name, 
                lat, 
                lon,
                address
            ) VALUES ( 
                :name, 
                :lat, 
                :lon,
                :address
            ) 
        "; 

        $query_params = array( 
            ':name' => $_POST['name'], 
            ':lat' => $_POST['lat'], 
            ':lon' => $_POST['lon'],
            ':address' => $_POST['address']
        ); 
         
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        }

        echo "Location Successfully Created!";
    }
?>

<h1>Create Location</h1> 
<form action="addLocation.php" method="post"> 
    Location Name:<br /> 
    <input type="text" name="name" value=""/> 
    <br /><br /> 
    Latitude:<br /> 
    <input type="text" name="lat" value=""  /> 
    <br /><br /> 
    Longitude:<br /> 
    <input type="text" name="lon" value=""  /> 
    <br /><br /> 
    Address:<br /> 
    <input type="text" name="address" value=""  /> 
    <br /><br /> 
    <input type="submit" value="Create" /> 
</form> 
<br />
<a href="locationManagement.php">Go back?</a>

<?php 
    require("postContent.php"); 
?>