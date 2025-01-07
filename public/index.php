<?php
session_start();

require_once('../Controllers/BaseController.php');
require_once('../Controllers/AuthController.php');
require_once('../Controllers/ClientController.php');
require_once('../Controllers/AdminController.php');
require_once('../core/Router.php');
require_once('../core/Route.php');
require_once('../config/database.php');
require_once('../models/User.php');

$router = new Router();
Route::setRouter($router);

// Define routes
Route::get('/', [AuthController::class, 'showLogin']);
Route::post('/signin', [AuthController::class, 'Signin']);
Route::get('/admin/home', [AdminController::class, 'showDashboard']);
Route::get('/user/profile', [ClientController::class, 'showProfile']);
Route::post('/user/profile/modifyprofile', [ClientController::class, 'modifyProfile']);
// Route::post('/user/profilePSW', [ClientController::class, 'changePassword']);




// Get current URI and method
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Dispatch the route
$router->dispatch($uri, $method);
