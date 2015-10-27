<?php 
    require("preContent.php"); 
    require("secureUser.php"); 
    $activePage = "account";
    if($db === null){
        echo $dbmsg;
        include('postContent.php');
        die();
    }

    $query = "SELECT DISTINCT c.id, c.title, c.start
    FROM courses as c 
    INNER JOIN course_enrollment as ce on ce.course_id = c.id
    WHERE c.status = 1 AND ce.user_id = ".$_SESSION['user']['id']; 
     
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    $rows = $stmt->fetchAll(); 
?> 

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
               My courses
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <?php if(count($rows) == 0){ echo "<h4>You're not registered to any courses yet.</h4>"; } ?>
                    <?php foreach($rows as $row): ?> 
                        <li class="list-group-item"><a href="viewCourse.php?course=<?php echo $row['id'] . "\">". $row['title'] . " - <i>" . $row['start']; ?></i></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Other stuff
            </div>
            <div class="panel-body">
            </div>
        </div>
    </div>
 </div>
<div class="row">
	<a href="logOut.php"><button class="btn btn-info">Log Out</button></a>
 </div>

<?php
    require("postContent.php"); 
?>