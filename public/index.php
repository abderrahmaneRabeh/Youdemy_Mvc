<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Controllers\HomeController;
use Controllers\AuthController;

// Define Routes
$routes = [
    'home' => ['controller' => 'Controllers\\HomeController', 'method' => 'index'],
    'login' => ['controller' => 'Controllers\\AuthController', 'method' => 'login'],
    'logout' => ['controller' => 'Controllers\\AuthController', 'method' => 'logout'],
    'register' => ['controller' => 'Controllers\\AuthController', 'method' => 'register'],
];


$url = $_GET['url'] ?? 'home';


if (array_key_exists($url, $routes)) {
    $controllerName = $routes[$url]['controller'];
    $actionName = $routes[$url]['method'];

    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        if (method_exists($controller, $actionName)) {
            $controller->$actionName();
        } else {
            echo "La méthode <b>$actionName</b> n'existe pas dans le contrôleur <b>$controllerName</b>";
        }
    } else {
        echo "Le contrôleur <b>$controllerName</b> n'existe pas";
    }
} else {
    echo "Page non trouvée";
}

