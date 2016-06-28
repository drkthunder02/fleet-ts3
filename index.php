<?php
require_once('../vendor/autoload.php');
session_start();

$provider = new Evelabs\OAuth2\Client\Provider\EveOnline([
    'clientId'          => '0ec717c4e93146a9913396bedb3720b5',
    'clientSecret'      => 'tJkSWgWnoIGKmsRcoyOqZQP2xyTC8fJRWw4wB2ci ',
    'redirectUri'       => 'http://ts3.astrocomical.com/fleet-ts3/index.php',
]);

if (!isset($_GET['code'])) {
    printf("In !isset GET");
    // here we can set requested scopes but it is totally optional
    // make sure you have them enabled on your app page at
    // https://developers.eveonline.com/applications/
    $options = [
        'scope' => ['publicData','characterLocationRead']
    ];

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl($options);
    $_SESSION['oauth2state'] = $provider->getState();
    unset($_SESSION['token']);
    header('Location: '.$authUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    printf("unset oauth2state");
    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {
    // In this example we use php native $_SESSION as data store
    if(!isset($_SESSION['token']))
    {
        printf("session token");
        // Try to get an access token (using the authorization code grant)
        $_SESSION['token'] = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

    }elseif($_SESSION['token']->hasExpired()){
        printf("token expired");
        // This is how you refresh your access token once you have it
        $new_token = $provider->getAccessToken('refresh_token', [
            'refresh_token' => $_SESSION['token']->getRefreshToken()
        ]);
        // Purge old access token and store new access token to your data store.
        $_SESSION['token'] = $new_token;
    }

    // Optional: Now you have a token you can look up a users profile data
    try {
        printf("try");
        // We got an access token, let's now get the user's details
        $user = $provider->getResourceOwner($_SESSION['token']);

        // Use these details to create a new profile
        printf('Hello %s! ', $user->getCharacterName());

    } catch (\Exception $e) {
        printf("catch");
        // Failed to get user details
        exit('Oh dear...');
    }

    // Use this to interact with an API on the users behalf
    printf('Your access token is: %s', $_SESSION['token']->getToken());
}
