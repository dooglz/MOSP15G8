<?php 
  include('preContent.php');
  if($db === null){
    echo $dbmsg;
    include('postContent.php');
    die();
  }
  $validationError = '';
  $submitted_username = ''; 
  
  if(!empty($_POST)) { 
    $query = "SELECT * FROM users WHERE username = :username"; 
    $query_params = array(':username' => $_POST['username']); 
    
    try { 
      $stmt = $db->prepare($query); 
      $result = $stmt->execute($query_params); 
    } catch(PDOException $ex) { 
      die("Failed to run query: " . $ex->getMessage()); 
    } 
    
    $login_ok = false; 
    
    $row = $stmt->fetch(); 
    if($row) { 
      $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
      for($round = 0; $round < 65536; $round++) { 
          $check_password = hash('sha256', $check_password . $row['salt']); 
      } 
        
      if($check_password === $row['password']) { 
          $login_ok = true; 
      } 
    } 
    
    if($login_ok) { 
      unset($row['salt']); 
      unset($row['password']); 
      
      $_SESSION['user'] = $row; 
      
      if(!empty($_GET['continue'])) { 
          echo "<meta http-equiv=\"refresh\" content=\"2; url=" . $_GET['continue'] . "\" />";
          die("Successfully logged in, redirecting.");
      } else {
          echo "<meta http-equiv=\"refresh\" content=\"2; url=index.php\" />";
          die("Successfully logged in, redirecting.");
      }
    } else { 
      $validationError = 'Login Failed';
      $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
    } 
  }
?>
<div class="col-md-8 col-md-offset-2">
  <h1>Login</h1> 
  <span style="color: red"><?php echo $validationError; ?></span>
  <form action="logIn.php?continue=<?php if(!empty($_GET['continue'])) { echo $_GET['continue'];   } else { echo "index.php";}?>" method="post"> 
      Username:<br /> 
      <input type="text" name="username" value="<?php echo $submitted_username; ?>" /> 
      <br />
      Password:<br /> 
      <input type="password" name="password" value="" /> 
      <br /><br />
      <input type="submit" class="btn btn-primary" value="Login" />
  </form> 
  <br /><br />
  <a href="register.php"> <button type="button" class="btn btn-primary">Register New Account</button></a>
</div>
<?php
    include('postContent.php');
?>