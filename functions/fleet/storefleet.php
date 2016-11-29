<?php
//This function is called once when the fleet is created.  As the fleet is updated, the cron job will use a different file
function StoreFleet($response, $fleetAuthToken, $fleetNumber, $expiry) {
    //Open the database connection
    $db = DBOpen();
    //Store the auth token for future use
    $db->insert('CrestVariables', array('FleetID' => $fleetNumber, 'AuthToken' => $fleetAuthToken, 'AuthTokenExpiry' => $expiry));
    
    //We need to store each member of the fleet in the database, and the roles they should acquire for when the cron job runs
    foreach($response->items as $member) {
        $role = $member->roleID;
        $character = $member->character->name;
        $db->insert('FleetMembers', array('Character' => $character, 'FleetRole' => $role, 'FleetID' => $fleetNumber));
    }
    
    //Close the database connection
    DBClose($db);
    /*
    roleID: ID of the member’s role. Possible values:
    1 - fleet commander
    2 - wing commander
    3 - squad commander
    4 - squad member
     */
}