<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microsoft SSO</title>
</head>
<body>

<h1>Microsoft SSO</h1>

<?php

include('config.php');

session_start();

require "vendor/autoload.php";

use myPHPnotes\Microsoft\Auth;
use myPHPnotes\Microsoft\Handlers\Session;
use myPHPnotes\Microsoft\Models\User;

/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

echo '<pre>';
print_r($_GET);
echo '</pre>';
*/

$auth = new Auth(
    Session::get("tenant_id"), 
    Session::get("client_id"), 
    Session::get("client_secret"), 
    Session::get("redirect_uri"), 
    Session::get("scopes")
);

$tokens = $auth->getToken(
    $_REQUEST['code'], 
    Session::get("state")
);

$accessToken = $tokens->access_token;

$auth->setAccessToken($accessToken);

$user = new User;

echo "Name: "  . $user->data->getDisplayName() . "<br>";
echo "Email: " . $user->data->getUserPrincipalName() . "";

?>

<hr>

<a href="logout.php">Login with a Different Account</a> 

</body>
</html>