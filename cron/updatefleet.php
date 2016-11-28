<?php
require_once __DIR__.'/../functions/registry.php';
//This is where we will call CREST again to update the fleet
$db = DBOpen();
//Get the active fleets from the database
$activeFleets = $db->fetchRowMany('SELECT * FROM Fleet WHERE FleetActive= :active', array('active' => 1));

//For each active fleet, we need to get their information from crest
foreach($activeFleets as $fleet) {
    //Build the fleet URL for use later
    $url = "https://crest-tq.eveonline.com/fleets/" . $fleet["FleetID"] . "/";
    //Get the expire time of the auth token from the database
    $tokenExpiry = $db->fetchColumn('SELECT AuthTokenExpiry FROM CrestVariables WHERE FleetID= :id', array('id' => $fleet["FleetID"]));
    
}
