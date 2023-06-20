<?php

define('ROOT_PATH', dirname(__DIR__));
require ROOT_PATH . '/vendor/autoload.php';

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

// Create Router instance
$app = new \Bramus\Router\Router();
$app->setNamespace('\keycloak\App\Controllers');

$app->get('/', 'IndexController@render');
$app->get('/connect', 'AuthController@connect');
$app->get('/admin', 'AuthController@admin');
$app->get('/id-token', 'AuthController@idToken');
$app->get('/access-token', 'AuthController@accessToken');
$app->get('/refresh-token', 'AuthController@refreshToken');
$app->get('/logout', 'AuthController@logout');

// Run it!
$app->run();
