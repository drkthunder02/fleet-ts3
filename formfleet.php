<?php
//Start the session
session_start();
//Include the registry files and crest variables
require_once __DIR__.'/functions/registry.php';
include __DIR__.'/functions/crest.php';

//Refresh the token
RefreshToken();

if (!isset($_GET['url'])) {
    echo "Need a fleet URL";
    exit();
}

if (!preg_match('#^https://crest-tq.eveonline.com/fleets/\d+/$#', $_GET['url'])) {
    echo "Need a valid fleet URL";
    exit();
}

$_SESSION['fleet_url']=$_GET['url'];
session_write_close();
header('Location: /fleet-ts3/');
