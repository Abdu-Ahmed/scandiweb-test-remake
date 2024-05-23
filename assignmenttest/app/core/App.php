<?php

namespace App\Core;

class App {
    protected $router;
    protected $db;

    public function __construct(Router $router, Database $db) {
        $this->router = $router;
        $this->db = $db;
    }

    public function run() {
        // Parse the current URI
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

        // Route to the appropriate controller
        $route = $this->router->dispatch($uri);

        if ($route !== false) {
            // Extract controller, method, and parameters
            $controllerName = 'App\\Controllers\\' . $route['controller'];
            $method = $route['method'];
            $params = $route['params'];

            // Create an instance of the controller class and pass the db instance
            $controller = new $controllerName($this->db);

            // Call the method with parameters
            call_user_func_array([$controller, $method], $params);
        } else {
            $this->abort();
        }
    }

    protected function abort($code = 404) {
        http_response_code($code);
        require_once "../app/views/{$code}.php";
        die();
    }
}