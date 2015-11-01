<?php
    include('preContent.php');
    if($db === null){
      echo $dbmsg;
      include('postContent.php');
      die();
    }
    if(!isset($_GET['news']) || empty($_GET['news']))  {
        echo  "<a href='newsManagement.php'>Go Back</a><br>";
        die("Request invalid");
    }

    $query = "DELETE FROM news
    WHERE id = " . $_GET['news'];

	try { 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
    } catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); 
    }

    echo 'News/Offer Deleted!';
?>

<br />
<a href="newsManagement.php">Go back?</a>

<?php
   include('postContent.php');
?>


