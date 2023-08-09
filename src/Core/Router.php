<?php

namespace Mpftavares\FarmBackofficeOop\Core;

use Exception;

class Router
{
    private array $routes;

    public function __construct()
    {
        if (file_exists('../config/routes.config.php')) {
            $this->routes = require '../config/routes.config.php';
        } else {
            $this->routes = [];
        }
    }

    public function addRoute(array $route)
    {
        $this->routes[] = $route;
    }

    public function getRoute(string $path)
    {
        if (!isset($this->routes[$path])) {
            throw new Exception('Not Found', 404);
        }

        return $this->routes[$path];
    }
}
