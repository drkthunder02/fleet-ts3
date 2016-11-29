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
    $url=$_SESSION['fleet_url'];
    $ch = curl_init();
    $header='Authorization: Bearer '.$_SESSION['fleet_auth_token'];
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    $result = curl_exec($ch);
    $response=json_decode($result);
    $url=$response->members->href;
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    $response=json_decode($result);
}

PrintFleetListingPage($response);

?>


