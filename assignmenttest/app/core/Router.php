<?php

namespace App\Core;

class Router {
    protected $routes = [];

    public function __construct(array $routes) {
        $this->routes = $routes;
    }

    public function dispatch($uri) {
        foreach ($this->routes as $route => $handler) {
            // Replace URL parameters with regex pattern
            $pattern = str_replace('/', '\/', $route);
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>\w+)', $pattern);

            if (preg_match('/^' . $pattern . '$/', $uri, $matches)) {
                // Extract controller, method, and parameters
                $handlerParts = explode('@', $handler);
                $controller = $handlerParts[0];
                $method = $handlerParts[1];
                $params = array_slice($matches, 1); // Exclude the full match

                return compact('controller', 'method', 'params');
            }
        }

        return false; // Route not found
    }
}