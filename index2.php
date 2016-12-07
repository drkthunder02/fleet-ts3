<?php

require_once __DIR__.'/functions/registry.php';
include __DIR__.'/functions/crest.php';

include('auth_functions.php');

RefreshToken();

if (!isset($_SESSION['fleet_url'])) {
    //If we do not have a fleet_url set, then let's print the form to make a new token
    PrintNoFleetIndexPage();
    //Stop performing code on the page until after the form is submitted
    exit();
} else {
    $fleetUrl = $_SESSION['fleet_url'];
    $fleetAuthToken = $_SESSION['fleet_auth_token'];
    $response = FleetContents($fleetUrl, $fleetAuthToken, $useragent);
    //Extract the fleet number from the fleetUrl
    $data = $fleetUrl;
    $fleetId = substr($data, strpos($data, "fleets/") + 1);
    $fleetId = str_replace("/", "", $fleetId);
    //Store the fleet in the database
    $expiry = $_SESSION['fleet_expiry'];
    StoreFleet($response, $fleetAuthToken, $fleetId, $expiry);
    
}

//Print the fleet listing
PrintFleetListingPage($response);
StoreFleet($response);

?>
