<?php
/*
    roleID: ID of the member’s role. Possible values:
    1 - fleet commander - Admin
    2 - wing commander - Global Moderator
    3 - squad commander - Moderator
    4 - squad member - Normal
     */
//Include the required files
require_once __DIR__.'/../functions/registry.php';
//Open the database connection
$db = DBOpen();

//Teamspeak 3 Variables
$ts3_username = $db->fetchColumn('SELECT ts3_username FROM TS3Configuration');
$ts3_password = $db->fetchColumn('SELECT ts3_password FROM TS3Configuration');
$ts3_address = $db->fetchColumn('SELECT ts3_address FROM TS3Configuration');
$ts3_port = $db->fetchColumn('SELECT ts3_port FROM TS3Configuration');
$ts3_sq_port = $db->fetchColumn('SELECT ts3_sq_port FROM TS3Configuration');
//Connect to the teamspeak3 server
$serverquery = "serverquery://" . $ts3_username . ":" . $ts3_password . "@" . $ts3_address . ":" . $ts3_sq_port . "/?server_port=" . $ts3_port;
//$ts3_VirtualServer = TeamSpeak3::factory("serverquery://username:password@127.0.0.1:10011/?server_port=9987");
$ts3_Server = Teamspeak3::factory($serverquery);
//Get the client list
$clients = $ts3_Server->clientList();

//Get the list of fleets
$fleets = $db->fetchRowMany('SELECT * FROM Fleets WHERE FleetActive= :active', array('active' => 1));

//For each of the active fleets

//Close the database connection
DBClose($db);

?>