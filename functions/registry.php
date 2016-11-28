<?php

//--------DO NOT EDIT ANYTHING BELOW THIS LINE --------------------
//Vendor Autoload functions
require_once __DIR__.'/../vendor/autoload.php';

//Database Functions
require_once __DIR__.'/../functions/database/dbclose.php';
require_once __DIR__.'/../functions/database/dbopen.php';

//Fleet Functions
require_once __DIR__.'/../functions/fleet/storefleet.php';

//Teamspeak3 Functions


//HTML Functions
require_once __DIR__.'/../functions/html/printfleetlisting.php';
require_once __DIR__.'/../functions/html/printnofleetindex.php';

//CREST Functions
require_once __DIR__.'/../functions/crest/autherror.php';
require_once __DIR__.'/../functions/crest/fleetcontents.php';
require_once __DIR__.'/../functions/crest/refreshtoken.php';

?>