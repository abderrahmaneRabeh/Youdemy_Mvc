<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Database;
use Controllers\HomeController;


$controller = new HomeController();
$controller->index();

Database::getInstance();
