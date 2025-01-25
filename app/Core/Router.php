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
        // Remove trailing slash and normalize the URI
        $uri = trim($uri, '/');
    
        // Check if the route requires authentication
        if (in_array('/' . $uri, $this->protectedRoutes) && !Auth::isLoggedIn()) {
            header('Location: /login');
            exit;
        }
    
        // Redirect logged-in users away from login/register pages
        if (in_array('/' . $uri, ['/login', '/register']) && Auth::isLoggedIn()) {
            header('Location: /dashboard');
            exit;
        }
    
        // Loop through all registered routes for the requested method
        foreach ($this->routes[$method] as $route => $callback) {
            // Convert route placeholders (e.g., {id}) into a regex pattern
            $routePattern = preg_replace('#\{(\w+)\}#', '(\d+)', trim($route, '/'));
            $routePattern = '#^' . $routePattern . '$#';
    
            // Check if the URI matches the route pattern
            if (preg_match($routePattern, $uri, $matches)) {
                array_shift($matches); // Remove the full match from the array
    
                // If the callback is a controller and method
                if (is_array($callback)) {
                    $controller = new $callback[0];
                    $method = $callback[1];
                    return call_user_func_array([$controller, $method], $matches);
                }
    
                // If the callback is a simple function
                return call_user_func_array($callback, $matches);
            }
        }
    
        // If no route matches, return a 404 response
        http_response_code(404);
        echo "404 Not Found";
    }
    
}
