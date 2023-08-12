<?php

namespace Mpftavares\FarmBackofficeOop\Core;

use Mpftavares\FarmBackofficeOop\Core\Exception\NotFoundException;

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

    public function addRoute(string $endpoint, Route | callable $route): void // só se quisermos adicionar rotas manuais porque nesta app existe o ficheiro routes.config
    {
        if (!isset($this->routes[$endpoint])) {
            $this->routes[$endpoint] = is_callable($route) ? $route : sprintf('%s::%s', $route->getController(), $route->getAction());
        }
    }

    public function getRoute(string $path)
    {

        if (strpos($path, ':') === false && isset($this->routes[$path])) {

            return new Route($this->routes[$path]);
            
        } else {    
               
            // (strpos($path, ':') === true significa que temos segmentos dinâmicos 

            $segments = explode('/', $path);

            $segmentsCount = count($segments);

            $routeData = [];

            foreach ($this->routes as $key => $value) {
                $routeSegments = explode('/', $key);

                if ($segmentsCount === count($routeSegments)) {
                    $match = true;

                    for ($i = 0; $i < $segmentsCount; $i++) {
                        if (isset($routeSegments[$i][0]) && $routeSegments[$i][0] === ':') { // verifica se existe segmento dinâmico
                            $routeData[substr($routeSegments[$i], 1)] = $segments[$i]; //ignora os :
                            continue;
                        }

                        if ($segments[$i] !== $routeSegments[$i]) {
                            $match = false;
                            break;
                        }
                    }

                    if ($match) {
                        return new Route($value, $routeData);
                    }
                }
            }
        }

        throw new NotFoundException();
    }
}
