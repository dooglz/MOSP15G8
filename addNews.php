<?php
$activePage = "admin";
include('preContent.php');
include('secureAdmin.php');

if(!empty($_POST)) { 
$query = " 
INSERT INTO news ( 
    content
    ) VALUES ( 
    :content
    ) 
"; 

$query_params = array( 
    ':content' => $_POST['content']
    ); 

try { 
    $stmt = $db->prepare($query); 
    $result = $stmt->execute($query_params); 
} catch(PDOException $ex) { 
    die("Failed to run query: " . $ex->getMessage()); 
}

echo "News / Offer Successfully Created!";
}

?>

<h1>Add News / Offer</h1> 
<form action="addNews.php" method="post" role="form"> 

	<div class="row">
		<div class="form-group">
			<div class='col-sm-6'>
				<label for="name">Content:</label>
				<input type="text" name="content" value="" class="form-control"/>
			</div>
		</div>
	</div>
	<br />
	<div class="row">
		<div class="form-group">
			<div class='col-sm-3'>
				<input type="submit" value="Create" class="btn btn-primary"/> 
			</div>
		</div>
	</div>
</form>

<br />
<br />
<a href="newsManagement.php">Go back?</a>
<?php
include('postContent.php');
?>