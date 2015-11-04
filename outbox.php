<?php
  $activePage = "admin";
  include('preContent.php');
  if($db === null){
    echo $dbmsg;
    include('postContent.php');
    die();
  }
  ?> 
  
  <h1>Email outbox</h1> 
<table class="table"> 
    <tr> 
        <th>Email</th> 
        <th>subject</th> 
    </tr> 
    
  <?php
  $query = "SELECT c.id, c.title FROM courses as c "; 
  
  try { 
    $stmt = $db->prepare($query); 
    $stmt->execute(); 
  } 
    catch(PDOException $ex) { 
    die("Failed to run query: " . $ex->getMessage()); 
  } 
    
  $rows = $stmt->fetchAll(); 
  
  foreach ($rows as $course) {
    $query = "SELECT DISTINCT u.id, u.email
        FROM users as u 
        INNER JOIN course_enrollment as ce on ce.user_id = u.id
        WHERE ce.course_id = ".$course['id']; 
  
  try { 
    $stmt = $db->prepare($query); 
    $stmt->execute(); 
  } 
    catch(PDOException $ex) { 
    die("Failed to run query: " . $ex->getMessage()); 
  } 
    
  $usersoncourse = $stmt->fetchAll(); 
   foreach ($usersoncourse as $user) {
    echo "<tr><td>";
    echo $user['email'];
    echo "</td><td>";
    echo "You have been enroleld on course: ".$course['title'];
    echo "</td>/<tr>";
   }
  
  }
  
?> 
</table> 


<br /> <br />
<b>You can sign up for courses offline by sending <a href="offline-pdf.pdf" target="_blank">this application form</a> to the enclosed address, with a cheque written out to "Napier Management Training".</b>
<?php
    	include('postContent.php');
?>