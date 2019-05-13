<?php
session_start();
//unset($_SESSION['face_access_token']);
require_once 'lib/GoogleAPI/vendor/autoload.php';
//include_once 'conexao.php';
$gClient = new Google_Client();
$gClient->setClientId("331544039513-00i2c5edfjmrf0hnhpem4lefh3rign0m.apps.googleusercontent.com");
$gClient->setClientSecret("f5BHaEPSfH4J0lqVqJfv2ojh");
$gClient->setApplicationName("Voyage GoAbroad Login");
$gClient->setRedirectUri("http://localhost/Voyage/g-callback.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
