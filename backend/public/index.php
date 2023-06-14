<?php 

define('ROOT_PATH', dirname(__DIR__));
require ROOT_PATH . '/vendor/autoload.php';

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

// Create Router instance
$app = new \Bramus\Router\Router();
$app->setNamespace('\keycloak\App\Controllers');

$app->get('/','IndexController@render');
$app->get('/connect','LoginController@connect');

// Run it!
$app->run();