<?php namespace Mpftavares\FarmBackofficeOop\Core;

use Exception;
use Mpftavares\FarmBackofficeOop\Core\Exception\HttpException;
use Mpftavares\FarmBackofficeOop\Core\Exception\InternalServerErrorException;
use ReflectionClass;
use ReflectionException;

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
        } catch (HttpException $e) {
            $this->showError($e);
        }
    }

    private function callAction(Route $route): void {
        if ($route->isCallable()) { // verifica que estou a adicionar uma função para ser executada em vez de um controlador
            $action = $route->getCallable();
            $action($route->getData());
            return;
        }

        $controller = $route->getController();
        $action = $route->getAction();

        try {
            $reflector = new ReflectionClass($controller);

            if (!$reflector->isInstantiable()) {
                throw new InternalServerErrorException();
            }

            $instance = $reflector->newInstance();
            $method = $reflector->getMethod($action);

            if ($route->hasData()) {
                $method->invokeArgs($instance, $route->getData());

            } else {
                $method->invoke($instance);
            }

        } catch (ReflectionException $e) {
            throw new InternalServerErrorException($e->getMessage());
        }
    }

    private function showError(Exception $e): void {
        $code = $e->getCode();
        $message = $e->getMessage();

        Response::status($code, $message);
        die("$code $message");
    }

    public function getPath(): string {
        return $_SERVER['PATH_INFO'] ?? '/login';
    }
}