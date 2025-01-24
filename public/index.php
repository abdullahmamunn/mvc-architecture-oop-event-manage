<?php

// Include Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../app/Core/bootstrap.php';


use App\Controllers\UserController;
use App\Controllers\DashboardController;
use App\Core\Router;


$router = new Router();

// Public routes
$router->get('/login', [UserController::class, 'showLoginForm']);
$router->post('/login', [UserController::class, 'login']);
$router->get('/register', [UserController::class, 'showRegisterForm']);
$router->post('/register', [UserController::class, 'register']);

// Protected routes
$router->get('/dashboard', [DashboardController::class, 'index'], true);
$router->get('/logout', [UserController::class, 'logout'], true);

$router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
