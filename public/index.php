<?php
session_start();

require_once('../Controllers/BaseController.php');
require_once('../Controllers/AuthController.php');
require_once('../core/Router.php');
require_once('../core/Route.php');

$router = new Router();
Route::setRouter($router);

// Define routes
Route::get('/', [AuthController::class, 'showLogin']);
Route::get('/login', [AuthController::class, 'showLogin']);

// Get current URI and method
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Dispatch the route
$router->dispatch($uri, $method);