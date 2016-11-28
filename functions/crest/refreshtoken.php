<?php

function RefreshToken() {
    
    if (!isset($_SESSION['fleet_expiry'])) {
        header("location: /fleet-ts3/login.php");
    }
    if (time() > $_SESSION['fleet_expiry']) {
        //Include the variables needed for CREST authorization
        include(__DIR__.'/../functions/crest.php');
        
        $url = 'https://login.eveonline.com/oauth/token';
        $header = 'Authorization: Basic '.base64_encode($clientid.':'.$secret);
        $fields_string = '';
        $fields = array(
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $_SESSION['fleet_refresh_token']
            );
        
        foreach ($fields as $key => $value) {
            $fields_string .= $key.'='.$value.'&';
        }
        rtrim($fields_string, '&');
        //Initialize the curl channel
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $result = curl_exec($ch);

        if ( $result===false ) {
            auth_error( curl_error($ch) );
        }
        //Close the curl channel
        curl_close($ch);
        //Decode the response
        $response = json_decode($result);
        //Get the access and refresh token
        $auth_token = $response->access_token;
        $refresh_token = $response->refresh_token;
        //Save the session variables
        $_SESSION['fleet_auth_token'] = $auth_token;
        $_SESSION['fleet_refresh_token'] = $refresh_token;
        $_SESSION['fleet_expiry'] = time()+(60*19);
        //Close the session
        session_write_close();
    }

}

?>