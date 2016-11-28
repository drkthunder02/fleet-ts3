<?php

function PrintFleetListingPage($response) {
    printf("<html>
            <head>
                <title>Fleet Tracker Example</title>
            </head>
            <body>
                <table>
                <tr><th>Name</th><th>Location</th><th>Docked at</th><th>Ship</th></tr>");
    
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
    
    printf("</table>
                </body>
            </html>");
}