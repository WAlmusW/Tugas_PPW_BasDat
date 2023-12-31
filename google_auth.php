<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'google_config.php';
require 'config/db_config.php';

// authenticate code from Google OAuth Flow 
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    
    if(!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);

        $_SESSION['access_token'] = $token['access_token'];

        // get profile info 
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        $_SESSION['email'] = $google_account_info['email'];
        $email = $google_account_info['email'];

        global $db_host, $db_username, $db_password, $db_name;
        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        $queryEmail = "SELECT * FROM user_auth WHERE email = '$email'";
        $resultEmail = mysqli_query($conn, $queryEmail);

        if (mysqli_num_rows($resultEmail) > 0) { // This is login  
            $_SESSION['mode'] = "login";
            header("Location: pages/controller/register_login_controller.php");
            exit();
        } else { // This is register
            $_SESSION['mode'] = "register";
            header("Location: pages/controller/register_login_controller.php");
            exit();
        }
    }
}

?>