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

Router::add('categoryList', 'CategoryController', 'index');

Router::add('coursesList', 'CourseController', 'index');
Router::add('FetchCourses', 'CourseController', 'fetchCourses');
Router::add('courseDetail', 'CourseController', 'CourseDetails');

Router::add('tagList', 'TagController', 'index');

$url = $_GET['url'] ?? 'home';

Router::dispatch($url);

