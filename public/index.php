<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Core\Router;

// Home
Router::add('home', 'HomeController', 'index');

// Auth Pages
Router::add('login', 'AuthController', 'login');
Router::add('logout', 'AuthController', 'logout');
Router::add('register', 'AuthController', 'register');

// Registration Processing
Router::add('processRegistration', 'AuthController', 'processRegistration');
Router::add('processLogin', 'AuthController', 'processLogin');

// Categories
Router::add('categoryList', 'CategoryController', 'index');

// Courses
Router::add('coursesList', 'CourseController', 'index');
Router::add('FetchCourses', 'CourseController', 'fetchCourses');
Router::add('courseDetail', 'CourseController', 'CourseDetails');
Router::add('myCourses', 'CourseController', 'MyCourses');

// Tags
Router::add('tagList', 'TagController', 'index');

// Dasgboard
Router::add('userPanel', 'DashboardController', 'Utilisateurs');
Router::add('statistiques', 'DashboardController', 'Statistiques');
Router::add('coursAdminPanel', 'DashboardController', 'GestionCoursAdmin');
Router::add('tagsPanel', 'DashboardController', 'GestionTags');
Router::add('categoriesPanel', 'DashboardController', 'GestionCategories');
// Routing
$url = $_GET['url'] ?? 'home';
Router::dispatch($url);

