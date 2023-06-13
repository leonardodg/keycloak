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

    public function render(){
        echo $this->blade->render('index');
    }
}