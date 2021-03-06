<?php
session_start();
//Includes
require_once __DIR__.'/functions/registry.php';
include('auth_functions.php');

RefreshToken();

if (!isset($_SESSION['fleet_url'])) {
    //If we do not have a fleet_url set yet, then let's print the form to make a new token
    PrintNoFleetIndexPage();
    //Stop performing code on the page until after the form is submitted.
    exit();
} else {
    
    $fleetUrl = $_SESSION['fleet_url'];
    $fleetAuthToken = $_SESSION['fleet_auth_token'];    
    $response = FleetContents($fleetUrl, $fleetAuthToken, $useragent);
}

if($response) {
    //Print the fleet listing
    PrintFleetListingPage($response);
    //Store the fleet for future use
}


?>


