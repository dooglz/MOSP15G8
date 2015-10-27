<?php 
    require("preContent.php"); 
    require("secureUser.php");
    if($db === null){
      echo $dbmsg;
      include('postContent.php');
      die();
    }
    if(!isset($_GET['course']) || empty($_GET['course']))  {
        echo  "<a href='courses.php'>Go Back</a><br>";
        die("Course get request invalid");
    }

    $query = "SELECT * FROM course_enrollment WHERE course_id = " . $_GET['course'] ." AND user_id=". $_SESSION['user']['id'];  
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    }  
    $row = $stmt->fetch(); 
    if($row) { 
        echo  "<a href='courses.php'>Go Back</a><br>";
        die("You are already registered on this course");
    } 
    
    $query = "INSERT INTO course_enrollment ( course_id,  user_id ) VALUES ( :course_id, :user_id )";  
    $query_params = array( 
        ':course_id' =>$_GET['course'] , 
        ':user_id' => $_SESSION['user']['id'], 
    );   
      
    try { 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
    } catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    } 

    $query = "SELECT c.title, c.start, l.name, c.price FROM courses AS c INNER JOIN locations as l ON l.id = c.location WHERE c.id = ".$_GET['course'];  
    try { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    }  
    $row = $stmt->fetch(); 

    // Email!
    $to  = $_SESSION['user']['email'];
    $subject = 'Course Confirmation';

    $message = '
    <html>
    <head>
      <title>Course confirmation</title>
    </head>
    <body>
      <p>Confirmation of course booking with Napier Management Training</p>
      <table>
        <tr>
          <th>Course</th><th>When</th><th>Where</th><th>Price</th>
        </tr>
        <tr>
          <td>'.$row['title'].'</td><td>'.$row['start'].'</td><td>'.$row['name'].'</td><td>'.$row['price'].'</td>
        </tr>
      </table>

      Thankyou for choosing Napier Management Training.
    </body>
    </html>
    ';

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'To: Customer <'.$_SESSION['user']['email'].'>' . "\r\n";
    $headers .= 'From: Napier Management Training <noreply@napiermanagementtraining.com>' . "\r\n";

    mail($to, $subject, $message, $headers);
    
    echo "<meta http-equiv=\"refresh\" content=\"2; url=viewCourse.php?course=".$_GET['course']."\" />";
    die("<h4>Payment Accepted!</h4> <br />Successfully enrolled");
 ?>

