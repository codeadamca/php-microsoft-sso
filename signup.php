<?php

include('config.php');

session_start();

require "vendor/autoload.php";

use myPHPnotes\Microsoft\Auth;

$tenant = "common";
$client_id = CLIENT_ID;
$client_secret = CLIENT_SECRET;
$callback = "http://localhost:8888/callback.php";
$scopes = ["User.Read"];

$microsoft = new Auth(
    $tenant, 
    $client_id, 
    $client_secret,
    $callback, 
    $scopes
);

header("location: " . $microsoft->getAuthUrl());