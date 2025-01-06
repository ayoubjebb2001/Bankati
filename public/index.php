<?php
session_start();



require_once ('../Controllers/BaseController.php');
require_once '../core/Router.php';
require_once '../core/Route.php';

$router = new Router();
Route::setRouter($router);

// Define routes
Route::get('/login', 'AuthController', 'login');