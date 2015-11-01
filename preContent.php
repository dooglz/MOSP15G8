<?php 
    require("common.php"); 
    $activePage = isset($activePage) ? $activePage : "";
    $loggedIn = !empty($_SESSION['user']);
    $isAdmin = isset($isAdmin) ? $isAdmin :  $loggedIn && (!empty($_SESSION['user']['permissionLevel']) && $_SESSION['user']['permissionLevel'] >0);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>Napier Management Training</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="js/jquery-1.11.1.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- FONT AWESOME ICONS  -->
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- DateTime picker -->
	<script src="js/bootstrap-datetimepicker.js"></script>
	<link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
    <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="header-logo">
                    <a href="index.php">
                        <h2>Napier Management Training</h2>
                    </a>
                </div>
            </div>
            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav"></ul>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a <?php if($activePage == "home"){echo "class='menu-top-active' ";}?>href="index.php">Home</a></li>
                            <li><a <?php if($activePage == "courses"){echo "class='menu-top-active' ";}?>href="courses.php">Courses</a></li>
                            <li><a <?php if($activePage == "locations"){echo "class='menu-top-active' ";}?>href="allLocations.php">Locations</a></li>
                            <li><a <?php if($activePage == "forum"){echo "class='menu-top-active' ";}?>href="forum/">Forum</a></li>
                            <li><a <?php 
                                if(!$loggedIn){
                                    if($activePage == "login"){echo 'class="menu-top-active" ';}
                                    echo 'href="logIn.php">Login';
                                }else{
                                     if($activePage == "account"){echo 'class="menu-top-active" ';}
                                    echo 'href="userHome.php">Account';
                                }
                            ?></a></li>
                            <?php  
                                if($isAdmin)  {
                                    echo "<li><a ";
                                    if($activePage == "admin"){echo "class='menu-top-active' ";}
                                    echo 'href="admin.php">Admin</a></li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <?php
    if($loggedIn)  {
      echo '<section><div class="container"><div class="col-md-12 menu-username">';
      echo "You are logged in as: <b>".$_SESSION['user']['username']."</b>";
      if($isAdmin)  {echo ", Adminstrator Status Granted";}
      echo ', <a href="logOut.php">Log Out</a>';
      echo '</div></div></div></section>'; 
    }
  ?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container"> 