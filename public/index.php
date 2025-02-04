<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Controllers\HomeController;
use Controllers\AuthController;
use Core\Router;

// Define Routes
$routes = [
    'home' => ['controller' => 'Controllers\\HomeController', 'method' => 'index'],
    'login' => ['controller' => 'Controllers\\AuthController', 'method' => 'login'],
    'logout' => ['controller' => 'Controllers\\AuthController', 'method' => 'logout'],
    'register' => ['controller' => 'Controllers\\AuthController', 'method' => 'register'],
];

Router::add('home', 'HomeController', 'index');
Router::add('login', 'AuthController', 'login');
Router::add('logout', 'AuthController', 'logout');
Router::add('register', 'AuthController', 'register');


$url = $_GET['url'] ?? 'home';

Router::dispatch($url);

