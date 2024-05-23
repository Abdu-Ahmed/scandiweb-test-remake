<?php
define('BASE_URL', 'http://localhost/assignmenttest/public');

require_once 'autoload.php';
use App\Core\App;
use App\Core\Router;
use App\Core\Database;

// create an instance of the Router class
$routes = require('../app/routes.php');
$router = new Router($routes);

// create an instance of the Database class
$db = new Database();

// initialize the App with the Router and Database instances
$app = new App($router, $db);

// run the application
$app->run();