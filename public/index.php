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

Router::add('AddCategory', 'CategoryController', 'AddCategory');
Router::add('processAjouterCategory', 'CategoryController', 'processAjouterCategory');


Router::add('EditCategory', 'CategoryController', 'EditCategory');
Router::add('processEditCategory', 'CategoryController', 'processEditCategory');

// Courses
Router::add('coursesList', 'CourseController', 'index');
Router::add('FetchCourses', 'CourseController', 'fetchCourses');
Router::add('courseDetail', 'CourseController', 'CourseDetails');
Router::add('myCourses', 'CourseController', 'MyCourses');

Router::add('AddCourse', 'CourseController', 'AddCourse');
Router::add('processAjouterCours', 'CourseController', 'processAjouterCours');



// Tags
Router::add('tagList', 'TagController', 'index');

Router::add('AddTag', 'TagController', 'AddTag');
Router::add('processAjouterTag', 'TagController', 'processAjouterTag');


Router::add('EditTag', 'TagController', 'EditTag');
Router::add('processEditTag', 'TagController', 'processEditTag');

// Dasgboard
Router::add('userPanel', 'DashboardController', 'Utilisateurs');
Router::add('statistiques', 'DashboardController', 'Statistiques');
Router::add('coursAdminPanel', 'DashboardController', 'GestionCoursAdmin');
Router::add('tagsPanel', 'DashboardController', 'GestionTags');
Router::add('categoriesPanel', 'DashboardController', 'GestionCategories');

Router::add('StatistiquesEnseignant', 'DashboardController', method: 'StatistiquesEnseignant');
Router::add('GestionCoursEnseignant', 'DashboardController', method: 'GestionCoursEnseignant');
Router::add('GestionInscription', 'DashboardController', method: 'GestionInscription');
// Delete Routes
Router::add('deleteEtudiant', 'UserController', method: 'DeleteEtudiant');
Router::add('deleteEnseignant', 'UserController', method: 'DeleteEnseignant');
Router::add('SupprimerTag', 'TagController', 'SupprimerTag');
Router::add('DeleteCourse', 'CourseController', 'DeleteCourse');
Router::add('SupprimerCategory', 'CategoryController', 'SupprimerCategory');


// active enseignant
Router::add('ActiveEnseignant', 'UserController', method: 'ActiveEnseignant');

// banner etudiant
Router::add('banEtudiant', 'UserController', method: 'BanEtudiant');

// Routing
$url = $_GET['url'] ?? 'home';
Router::dispatch($url);

