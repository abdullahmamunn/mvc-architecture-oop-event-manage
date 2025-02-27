<?php

// Include Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../app/Services/bootstrap.php';


use App\Controllers\UserController;
use App\Controllers\DashboardController;
use App\Controllers\EventController;
use App\Controllers\HomePageController;
use App\Controllers\AttendeeController;
use App\Controllers\EventReportController;
use App\Services\Router;


$router = new Router();

// Public routes
$router->get('/', [HomePageController::class, 'home']);
$router->get('/login', [UserController::class, 'showLoginForm']);
$router->post('/login', [UserController::class, 'login']);
$router->get('/register', [UserController::class, 'showRegisterForm']);
$router->post('/register', [UserController::class, 'register']);


$router->get('/events/{id}/register', [AttendeeController::class, 'registerForm']);
$router->get('/event/details/{id}', [HomePageController::class, 'eventDetails']);
$router->post('/attendees/store', [AttendeeController::class, 'register']);
$router->post('/search', [HomePageController::class, 'search']);


// Protected routes
$router->get('/dashboard', [DashboardController::class, 'index'], true);

$router->get('/events', [EventController::class, 'index'], true);
$router->get('/events/create', [EventController::class, 'create'], true);
$router->post('/events/store', [EventController::class, 'store'], true);
$router->get('/events/{id}', [EventController::class, 'show'], true);
$router->get('/events/edit/{id}', [EventController::class, 'edit'], true);
$router->post('/events/update/{id}', [EventController::class, 'update'], true);
$router->get('/events/delete/{id}', [EventController::class, 'delete'], true);

// Reports
$router->get('/reports', [EventReportController::class, 'showAllEvent'], true);
$router->get('/events/reports', [EventReportController::class, 'downloadAttendeeReport']);


$router->get('/logout', [UserController::class, 'logout'], true);

$router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
