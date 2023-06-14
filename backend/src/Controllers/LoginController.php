<?php

namespace keycloak\App\Controllers;
use Exception;

class LoginController
{
    public function connect()
    {
        $provider = new \keycloak\App\Provider\Keycloak([
            'authServerUrl'         => $_ENV['KEYCLOAK_URL'],
            'realm'                 => $_ENV['KEYCLOAK_REALM'],
            'clientId'              => $_ENV['KEYCLOAK_CLIENT_ID'],
            'clientSecret'          => $_ENV['KEYCLOAK_CLIENT_SECRET'],
            'redirectUri'           => $_ENV['HOST_URL'].'/connect',
            'version'               => '21.1.1'
        ]);
        
        if (!isset($_GET['code'])) {
        
            // If we don't have an authorization code then get one
            $authUrl = $provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $provider->getState();
            header('Location: '.$authUrl);
            exit;
        
        // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
        
            unset($_SESSION['oauth2state']);
            exit('Invalid state, make sure HTTP sessions are enabled.');
        
        } else {

            // Try to get an access token (using the authorization coe grant)
            try {
                $token = $provider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);
                
            } catch (Exception $e) {
                exit('Failed to get access token: '.$e->getMessage());
            }
        
            // Optional: Now you have a token you can look up a users profile data
            try {
        
                // We got an access token, let's now get the user's details
                $user = $provider->getResourceOwner($token);
        
                // Use these details to create a new profile
                printf('Hello %s!', $user->getName());
        
            } catch (Exception $e) {
                exit('Failed to get resource owner: '.$e->getMessage());
            }

            echo '<br>';
        
            // Use this to interact with an API on the users behalf
            echo $token->getToken();
        }
    }
}