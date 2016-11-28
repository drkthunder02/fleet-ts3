<?php
    //Start the session
    session_start();
    include __DIR__.'/functions/crest.php';
    //Throw login redirect.
    $authsite = 'https://login.eveonline.com';
    $authurl = '/oauth/authorize';
    $client_id = '123652c2803f49f9aa942b42960141a0';
    $state = uniqid();

    $redirecturl = $_SERVER['HTTP_REFERER'];
    
    //$redirecturl = "https://ts3.astrocomical.com/fleet-ts3/";

    $_SESSION['auth_state'] = $state;
    $_SESSION['auth_redirect'] = $redirect_to;
    
    //Close the write session
    session_write_close();
    //Set the header variables
    header(
        'Location:'.$authsite.$authurl
        .'?response_type=code&redirect_uri='.$redirect_uri
        .'&client_id='.$client_id.'&scope=fleetRead&state='.$state
    );
    
    exit;
?>