<?php

namespace Src\Core;

use Src\Core\Exception\NotFoundException;

class Router {

    private $routes = [];

    public function add($route) {
        $this->routes[] = $route;
    }

    public function get($pattern, $callback) {
        $this->routes[] = new Route($pattern, $callback, 'GET');
    }
    public function post($pattern, $callback) {
        $this->routes[] = new Route($pattern, $callback, 'POST');
    }
    public function put($pattern, $callback) {
        $this->routes[] = new Route($pattern, $callback, 'PUT');
    }
    public function delete($pattern, $callback) {
        $this->routes[] = new Route($pattern, $callback, 'DELETE');
    }

    public function run() {
        foreach($this->routes as $route) {
            if ($route->match()) {
                $route->run();
            }
        }
        throw new NotFoundException('URL not found');
    }

}