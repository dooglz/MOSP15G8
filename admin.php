<?php 
    $activePage = "admin";
    require("preContent.php"); 
    require("secureAdmin.php");
 ?>
 
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Adminstrator Functions
            </div>
            <div class="panel-body">
                <a href="users.php">Manage Users</a> <br />
                <a href="courseManagement.php">Manage Courses</a><br />
                <a href="locationManagement.php">Manage Locations</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Site Status
            </div>
            <div class="panel-body">
                Registered Users: 10 <br>
                Users Enrolled on Courses: 10<br>
                Total Courses: 10<br>
                Course Locations: 3<br>
            </div>
        </div>
    </div>
 </div>
 
<?php 
    require("postContent.php");
?> 