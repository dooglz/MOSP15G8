<?php
    $username = 'mosp';
    $password = 'napier';
    $host = 'localhost';
    $port = '3306';
    $dbname = 'mosp'; 

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 

    try { 
        $db = new PDO("mysql:host={$host};port={$port};dbname={$dbname};charset=utf8", $username, $password, $options); 
    } catch(PDOException $ex) { 
        //die("Failed to connect to the database: " . $ex->getMessage()); 
        $db = null;
        $dbmsg =  "Failed to connect to the database<br> Error Code: " . $ex->getMessage();
    } 
    if($db !== null){
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
      $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    }
   // header('Content-Type: text/html; charset=utf-8'); 

    if(!isset($_SESSION)){
        session_start();
    }
?>