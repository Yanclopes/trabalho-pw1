<?php

namespace App\Core;

use App\Controller\NotFoundController;

class Core
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->setRoutes($routes);
    }

    public function run(): void
    {
        $url = '/';

        isset($_GET['url']) ? $url .= $_GET['url'] : '';

        $url = ($url != '/') ? rtrim($url, '/') : $url;

        $method = $_SERVER['REQUEST_METHOD'];
        $routerFound = false;

        foreach ($this->getRoutes() as $routeMethod => $routes) {
            if ($method === $routeMethod) {
                foreach ($routes as $path => $controllerAndAction) {
                    $pattern = '#^' . preg_replace('/{id}/', '([\w-]+|\d+)', $path) . '$#';

                    if (preg_match($pattern, $url, $matches)) {
                        array_shift($matches);

                        $routerFound = true;

                        [$currentController, $action] = explode('@', $controllerAndAction);

                        $controllerClass = "App\\Controller\\" . $currentController;
                        if (class_exists($controllerClass)) {
                            $controller = new $controllerClass();
                            if (method_exists($controller, $action)) {
                                $controller->$action($matches);
                            } else {
                                $this->handleError("Método $action não encontrado no controlador $currentController.");
                            }
                        } else {
                            $this->handleError("Controlador $currentController não encontrado.");
                        }
                    }
                }
            }
        }

        if (!$routerFound) {
            require_once __DIR__ . "/../Controller/NotFoundController.php";
            $controller = new NotFoundController();
            $controller->index();
        }
    }

    protected function getRoutes(): array
    {
        return $this->routes;
    }

    protected function setRoutes(array $routes): void
    {
        $this->routes = $routes;
    }

    private function handleError(string $message): void
    {
        http_response_code(404);
        echo $message;
        exit;
    }
}
