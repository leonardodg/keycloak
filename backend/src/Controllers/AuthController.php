<?php

namespace keycloak\App\Controllers;

use Jenssegers\Blade\Blade;
use Exception;

class AuthController
{
    private $provider;
    private $view;

    public function __construct()
    {
        $this->provider = new \keycloak\App\Provider\Keycloak([
            'authServerUrl'         => $_ENV['KEYCLOAK_URL'],
            'realm'                 => $_ENV['KEYCLOAK_REALM'],
            'clientId'              => $_ENV['KEYCLOAK_CLIENT_ID'],
            'clientSecret'          => $_ENV['KEYCLOAK_CLIENT_SECRET'],
            'redirectUri'           => $_ENV['HOST_URL'].'/connect',
            'version'               => $_ENV['KEYCLOAK_VERSION']
        ]);

        $this->view = new Blade(ROOT_PATH.'/views', ROOT_PATH.'/cache');
    }

    public function connect()
    {

        if (!isset($_GET['code'])) {

            // If we don't have an authorization code then get one
            $authUrl = $this->provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $this->provider->getState();
            header('Location: '.$authUrl);
            exit;

            // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

            unset($_SESSION['oauth2state']);
            exit('Invalid state, make sure HTTP sessions are enabled.');

        } else {

            // Try to get an access token (using the authorization coe grant)
            try {
                $_SESSION['token'] = $this->provider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);
                header('Location: /admin');
                exit;
            } catch (Exception $e) {
                exit('Failed to get access token: '.$e->getMessage());
            }

        }
    }

    public function admin()
    {

        if (!isset($_SESSION['token'])) {
            header('location: /connect');
            exit();
        }
        $accessToken = $_SESSION['token'];

        // Optional: Now you have a token you can look up a users profile data
        try {

            // We got an access token, let's now get the user's details
            $user = $this->provider->getResourceOwner($accessToken);

        } catch (Exception $e) {
            exit('Failed to get resource owner: '.$e->getMessage());
        }

        echo $this->view->render('admin', ["user" => $user->toArray()]);
    }

    public function logout()
    {
        if (!isset($_SESSION['token'])) {
            header('location: /');
            exit();
        }

        $options = [];
        $accessToken = $_SESSION['token'];
        $version = $_ENV['KEYCLOAK_VERSION'];
        unset($_SESSION['token']);

        // test in version '18.0.0'
        // if (isset($version) && version_compare($version, '18.0.0', '>=')) {
        //     $options['access_token'] = $accessToken->getToken();
        // }

        $url = $this->provider->getLogoutUrl($options);

        header('Location: '.$url);
        exit;
    }


    public function idToken()
    {
        if (!isset($_SESSION['token'])) {
            header('location: /');
            exit();
        }

        $accessToken = $_SESSION['token'];

        // Optional: Now you have a token you can look up a users profile data
        try {

            // We got an access token, let's now get the user's details
            $user = $this->provider->getResourceOwner($accessToken);

        } catch (Exception $e) {
            exit('Failed to get resource owner: '.$e->getMessage());
        }

        $json = $accessToken->jsonSerialize();
        $result =  $this->provider->getJWTDecode($json['id_token']);

        $data = [
                    "title" => "ID TOKEN",
                    "token" => $json['id_token'],
                    "json" => $result
                ];

        echo $this->view->render('contents', $data);
    }

    public function accessToken()
    {
        if (!isset($_SESSION['token'])) {
            header('location: /');
            exit();
        }

        $accessToken = $_SESSION['token'];

        // Optional: Now you have a token you can look up a users profile data
        try {

            // We got an access token, let's now get the user's details
            $user = $this->provider->getResourceOwner($accessToken);

        } catch (Exception $e) {
            exit('Failed to get resource owner: '.$e->getMessage());
        }

        $json = $accessToken->jsonSerialize();
        $result =  $this->provider->getJWTDecode($json['access_token']);

        $data = [
                    "title" => "ACCESS TOKEN",
                    "token" => $json['access_token'],
                    "json" => $result
                ];

        echo $this->view->render('contents', $data);
    }

    public function refreshToken()
    {
        if (!isset($_SESSION['token'])) {
            header('location: /');
            exit();
        }

        $accessToken = $_SESSION['token'];

        // Optional: Now you have a token you can look up a users profile data
        try {

            // We got an access token, let's now get the user's details
            $user = $this->provider->getResourceOwner($accessToken);

        } catch (Exception $e) {
            exit('Failed to get resource owner: '.$e->getMessage());
        }

        $json = $accessToken->jsonSerialize();
        $result =  $this->provider->getJWTDecode($json['refresh_token']);

        $data = [
                    "title" => "REFRESH TOKEN",
                    "token" => $json['refresh_token'],
                    "json" => $result
                ];

        echo $this->view->render('contents', $data);
    }
}
