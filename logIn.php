<?php 
    require("common.php"); 

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
                header("Location: " . $_GET['continue']); 
                die("Redirecting to: " . $_GET['continue']); 
            } else {
                header("Location: userHome.php"); 
                die("Redirecting to: userHome.php"); 
            }
        } else { 
            print("<span style=\"color: red\">Login Failed.</span>"); 

            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 

    if(!empty($_GET['continue'])) { 
        echo "<p>You must log in to access this page.</p>";
    }
?>

<h1>Login</h1> 
<form action="logIn.php?continue=<?php echo $_GET['continue']?>" method="post"> 
    Username:<br /> 
    <input type="text" name="username" value="<?php echo $submitted_username; ?>" /> 
    <br /><br /> 
    Password:<br /> 
    <input type="password" name="password" value="" /> 
    <br /><br /> 
    <input type="submit" value="Login" /> 
</form> 
<a href="register.php">Register</a>