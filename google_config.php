<?php

require_once 'vendor/autoload.php';

// init configuration 
$clientID = '592023174326-nqujobap8u1gt8fv8gp739vesao741fq.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/Tugas_PPW_BasDat/google_auth.php';

// create Client Request to access Google API 
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>