<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\MethodNotFoundException;
use App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes = [];

    public function get(string $route, callable|array $action): self
    {
        $this->routes['get'][$route] = $action;

        return $this;
    }

    public function post(string $route, callable|array $action): self
    {
        $this->routes['post'][$route] = $action;

        return $this;
    }

    public function resolve(string $requestUri, string $requestMethod)
    {
        $path = preg_replace('#\?.*#', '', $requestUri);

        foreach ($this->routes[$requestMethod] as $route => $action) {
            $pattern = $this->createPattern($route);

            if (preg_match($pattern, $path, $params)) {
                array_shift($params);

                if (! $action) {
                    throw new RouteNotFoundException();
                }

                if (is_callable($action)) {
                    return call_user_func($action);
                }

                if (is_array($action)) {
                    [$class, $method] = $action;

                    if (class_exists($class)) {
                        $class = new $class();

                        if (! method_exists($class, $method)) {
                            throw new MethodNotFoundException();
                        }
                        return call_user_func_array([$class, $method], $params);
                    }
                }
            }
        }

        throw new RouteNotFoundException();
    }

    private function createPattern(string $route): string
    {
        return '#^/?' . preg_replace('#\{(.+?)}/?#', '(.+)', $route) . '?$#';
    }
}