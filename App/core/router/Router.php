<?php

namespace App\core\router;

use App\core\Application;
use App\core\Request;
use App\core\Response;
use App\core\router\Route;
use App\core\view\RenderManagemen;


class Router
{
    // Router tools
    public Request $request;
    public Response $response;
    // Router routes
    protected $routes = [];


    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback)
    {
        return $this->routes['get'][] = new Route($path, $callback);
    }


    public function post($path, $callback)
    {
        return $this->routes['post'][] = new Route($path, $callback);
    }


    public function getURL($name)
    {
        foreach($this->routes as $method) {
            foreach($method as $route) {
                if ($route->getName() == $name) {
                    return $route->getPath();
                }
            }
        }
        return "/";
    }


    public function getCallBack($path, $method)
    {
        foreach($this->routes[$method] as $route) {
            if ($route->check($path)) {
                return $route->getCallback();
            }
        }
        return false;
    }


    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->getCallBack($path, $method);

        if ($callback === false) {
            $code = 404;
            $this->response->setStatusCode($code);
            return RenderManagemen::renderView("errors/_404", compact('code'));
        }

        if (is_string($callback)) {
            return RenderManagemen::renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0];
        }

        return call_user_func($callback, $this->request);
    }
}