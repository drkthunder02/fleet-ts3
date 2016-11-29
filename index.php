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
    //If we have a fleet_url, let's check for the fleet in the database.
    //If it's not present then let's add the fleet to the database.
    $fleetUrl = $_SESSION['fleet_url'];
    $fleetAuthToken = $_SESSION['fleet_auth_token'];
    $useragent="TS3 Fleet Permissions";
    $response = FleetContents($fleetUrl, $fleetAuthToken, $useragent);
    //Extract the fleet number from the fleetUrl
    $fleetIdTemp = GetNumerics($fleetUrl);
    //Store the value into fleet Id to be stored in the database
    $fleetId = $fleetIdTemp[0];
    
    //Store the fleet in the database
    $expiry = $_SESSION['fleet_expiry'];
    //Store the fleet in the database
    //StoreFleet($response, $fleetAuthToken, $fleetId, $expiry);
}

//PrintFleetListingPage($response);

?>

<html>
<head><title>Fleet Tracker Example</title></head>
<body>
<table>
<tr><th>Name</th><th>Location</th><th>Docked at</th><th>Ship</th></tr>
<?php
foreach ($response->items as $member) {
    print "<tr><td>".$member->character->name."</td>";
    print "<td>".$member->solarSystem->name."</td>";
    if (isset($member->station)) {
        print "<td>".$member->station->name."</td>";
    } else {
        print "<td>Undocked</td>";
    }
    print "<td>".$member->ship->name."</td>";
    print "</tr>";

}
?>
</table>
</body>
</html>
