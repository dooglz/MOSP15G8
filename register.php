<?php
    include('preContent.php');
    if($db === null){
      echo $dbmsg;
      include('postContent.php');
      die();
    }      
    function Register($db) {
        if(empty($_POST['username'])) { 
            return("Please enter a username."); 
        } 
         
        if(empty($_POST['password'])) { 
            return("Please enter a password."); 
        } 
         
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { 
           return("Invalid E-Mail Address"); 
        } 
         
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                username = :username 
        "; 
         
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
         
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } catch(PDOException $ex) { 
            return("Failed to run query: " . $ex->getMessage()); 

        } 

        $row = $stmt->fetch(); 
         
        if($row) { 
            return("This username is already in use"); 
        } 

        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                email = :email 
        "; 
         
        $query_params = array( 
            ':email' => $_POST['email'] 
        ); 
         
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } catch(PDOException $ex) { 
            return("Failed to run email query: " . $ex->getMessage()); 
        } 
         
        $row = $stmt->fetch(); 
         
        if($row) { 
            return("This email address is already registered"); 
        } 
         
        $query = " 
            INSERT INTO users ( 
                username, 
                password, 
                salt, 
                email 
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email 
            ) 
        "; 
         
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        $password = hash('sha256', $_POST['password'] . $salt); 

        for($round = 0; $round < 65536; $round++) { 
            $password = hash('sha256', $password . $salt); 
        } 

        $query_params = array( 
            ':username' => $_POST['username'], 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => $_POST['email'] 
        ); 
         
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } catch(PDOException $ex) { 
            return("Failed to run Register query: " . $ex->getMessage()); 
        } 
         
        echo "<meta http-equiv=\"refresh\" content=\"2; url=logIn.php\" />";
        return("Successfully registered, please log in.");
    } 
    $validationError = "";
    if(!empty($_POST)) { 
      $validationError = Register($db);
    }
?> 
<div class="col-md-8 col-md-offset-2">
  <h1>Register</h1> 
  <span style="color: red"><?php echo $validationError; ?></span>
  <form action="register.php" method="post"> 
      Username:<br /> 
      <input type="text" name="username" value="" /> 
      <br />
      E-Mail:<br /> 
      <input type="text" name="email" value="" /> 
      <br />
      Password:<br /> 
      <input type="password" name="password" value="" /> 
      <br /><br /> 
      <input type="submit" class="btn btn-primary" value="Register New Account" /> 
  </form>
</div>
<?php
    include('postContent.php');
?>