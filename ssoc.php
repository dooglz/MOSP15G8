<?php

/**
 * 
 * You do not have to edit sso.php file
 * 
 * This file/code should get executed when Codoforum sends a request
 * to the path <SSO Get User Path> as defined in SSO plugin settings
 * in Codoforum backend
 * 
 * 
 */

require 'sso.php';

/**
 * 
 * The SSO client id and secret MUST be same as that set in the Codoforum
 * SSO plugin settings
 */
$settings = array(
    
  "client_id" => 'codoforum',
  "secret" => 'Xe24!rf',
  "timeout" => 6000  
);

$sso = new codoforum_sso($settings);

$account = array();

/**
 * 
 * Here comes your logic to check if the user is logged in or not.
 * A simple example would be using PHP SESSION
 */
     if(!isset($_SESSION)){
        session_start();
    }
 if(!empty($_SESSION['user'])) { 
    $account['uid'] = $_SESSION['user']['id'];; //Your logged in user's userid
    $account['name'] = $_SESSION['user']['username']; //Your logged in user's username
    $account['mail'] = $_SESSION['user']['email']; //Your logged in user's email id
    $account['avatar'] = ''; //not used as of now
}

$sso->output_jsonp($account); //output above as JSON back to Codoforum
exit();