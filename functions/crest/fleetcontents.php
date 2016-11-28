<?php

function FleetContents($fleetUrl, $fleetAuthToken, $useragent) {
    
    $url=$fleetUrl;
    $ch = curl_init();
    $header='Authorization: Bearer ' . $fleetAuthToken;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    $result = curl_exec($ch);
    $response = json_decode($result);
    $url = $response->members->href;
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    $response = json_decode($result);
    
    return $response;
}