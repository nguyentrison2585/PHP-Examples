<?php

//google_api_config.php

//Include Google Client Library for PHP autoload file
require_once '../vendor/GoogleClientAPI/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('490528805043-981kvf3l9bmu94d6aus0tj1a5mj6asle.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('q8EORKNeUnXaiA22wcDS3N4');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/PHPExamples/php/login.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
?>
