<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Controllers\HomeController;
use Controllers\AuthController;
use Core\Router;


Router::add('home', 'HomeController', 'index');
Router::add('login', 'AuthController', 'login');
Router::add('logout', 'AuthController', 'logout');
Router::add('register', 'AuthController', 'register');
Router::add('processRegistration', 'AuthController', 'processRegistration');
Router::add('processLogin', 'AuthController', 'processLogin');
Router::add('categoryList', 'CategoryController', method: 'categoryList');


$url = $_GET['url'] ?? 'home';

Router::dispatch($url);

