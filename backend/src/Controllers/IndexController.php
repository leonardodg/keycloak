<?php

namespace keycloak\App\Controllers;

use Jenssegers\Blade\Blade;

class IndexController
{
    public $blade;

    public function __construct()
    {
        $this->blade = new Blade(ROOT_PATH.'/views', ROOT_PATH.'/cache');
    }

    public function render()
    {
        $data = [
            'url' => $_ENV['KEYCLOAK_URL'] ?? "http://mn01l:8080/",
            'realm' => $_ENV['KEYCLOAK_REALM'] ?? "education" ,
            'client_id' => $_ENV['KEYCLOAK_CLIENT_ID'] ?? "app-backend-default"
        ];

        if (isset($_SESSION['token'])) {
            $data['logged'] = true;
        } else {
            $data['logged'] = false;
        }

        echo $this->blade->render('index', $data);
    }
}
