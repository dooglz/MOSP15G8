<?php 
    $activePage = "admin";
    require("preContent.php"); 
    require("secureAdmin.php");

    // Number of users
    $query = "SELECT count(id) as num
    FROM users";
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    }  
    $numOfUsers = $stmt->fetch();

    // Users enrolled
    $query = "SELECT count(DISTINCT user_id) as num
    FROM course_enrollment";
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    }  
    $numEnrolled = $stmt->fetch();

    // Courses
    $query = "SELECT count(DISTINCT id) as num
    FROM courses WHERE status = 1";
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    }  
    $courses = $stmt->fetch();

    // Locations
    $query = "SELECT count(DISTINCT id) as num
    FROM locations";
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    }  
    $locations = $stmt->fetch();

 ?>
 
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Administrator Functions
            </div>
            <div class="panel-body">
                <a href="users.php">Manage Users</a> <br />
                <a href="courseManagement.php">Manage Courses</a><br />
                <a href="locationManagement.php">Manage Locations</a><br />
                <a href="newsManagement.php">Manage News / Offer</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Site Status
            </div>
            <div class="panel-body">
                Registered Users: <?php echo $numOfUsers['num']; ?><br>
                Users Enrolled on Courses: <?php echo $numEnrolled['num']; ?><br>
                Total Courses: <?php echo $courses['num']; ?><br>
                Course Locations: <?php echo $locations['num']; ?><br>
            </div>
        </div>
    </div>
 </div>
 
<?php 
    require("postContent.php");
?> 