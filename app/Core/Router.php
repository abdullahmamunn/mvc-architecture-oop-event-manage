<?php

namespace App\Core;

class Router
{
    private $routes = [];
    private $protectedRoutes = []; // Routes that require authentication

    public function get($uri, $callback, $protected = false)
    {
        $this->routes['GET'][$uri] = $callback;

        if ($protected) {
            $this->protectedRoutes[] = $uri;
        }
    }

    public function post($uri, $callback, $protected = false)
    {
        $this->routes['POST'][$uri] = $callback;

        if ($protected) {
            $this->protectedRoutes[] = $uri;
        }
    }

    public function resolve($uri, $method)
    {
       
        // Check if the route requires authentication
        if (in_array($uri, $this->protectedRoutes) && !Auth::isLoggedIn()) {
            header('Location: /login');
            exit;
        }

        // Redirect logged-in users away from login/register pages
        if (in_array($uri, ['/login', '/register']) && Auth::isLoggedIn()) {
            header('Location: /dashboard');
            exit;
        }

        $callback = $this->routes[$method][$uri] ?? null;

        if (!$callback) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        if (is_array($callback)) {
            $controller = new $callback[0];
            $method = $callback[1];
            call_user_func([$controller, $method]);
        } else {
            call_user_func($callback);
        }
    }
}
