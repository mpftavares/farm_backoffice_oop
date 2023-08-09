<?php namespace Mpftavares\FarmBackofficeOop\Core;

use Exception;
use ReflectionClass;

class Application {

    private Router $router;

    public function __construct() {
        $this->router = new Router();
    }

    public function run(): void{
        $path = $this->getPath();

        try {
            $route = $this->router->getRoute($path);
            $this->callAction($route);
        } catch (Exception $e) {
            $this->showError($e);
        }
    }

    private function callAction(array $route): void {
        extract($route); // extrai controller e action do route

        $reflector = new ReflectionClass($controller);

        if (!$reflector->isInstantiable()) {
            throw new Exception('Internal Server Error', 500); // uma classe abstracta não é instanciável
        }

        $instance = $reflector->newInstance();
        $method = $reflector->getMethod($action);

        $method->invoke($instance);
    }

    private function showError(Exception $e): void {
        $code = $e->getCode();
        $message = $e->getMessage();

        header("HTTP/1.1 $code $message");
        die("$code $message");
    }

    public function getPath(): string {
        return $_SERVER['PATH_INFO'] ?? '/login';
    }
}