<?php
session_start();

require_once('../Controllers/BaseController.php');
require_once('../Controllers/AuthController.php');
require_once('../Controllers/ClientController.php');
require_once('../Controllers/AdminController.php');
require_once('../Controllers/AccountController.php');
require_once('../core/Router.php');
require_once('../core/Route.php');
require_once('../config/database.php');
require_once('../models/User.php');
require_once('../models/Account.php');
require_once('../models/transaction.php');

$router = new Router();
Route::setRouter($router);

// Define routes
Route::get('/', [AuthController::class, 'showLogin']);
Route::post('/signin', [AuthController::class, 'Signin']);
Route::get('/admin', [AdminController::class, 'index']);

Route::get('/clients', [ClientController::class, 'index']);
Route::post('/clients/add', [ClientController::class, 'add']);
Route::post('/clients/edit', [ClientController::class, 'edit']);
Route::post('/clients/lock', [ClientController::class, 'lock']);
Route::post('/clients/activate', [ClientController::class, 'activate']);

Route::get('/accounts', [AccountController::class, 'index']);

Route::get('/user/profile', [ClientController::class, 'showProfile']);
Route::post('/user/profile/modifyprofile', [ClientController::class, 'modifyProfile']);
Route::post('/user/profile/profilePSW', [ClientController::class, 'changePassword']);
Route::get('/user/myAccounts', [ClientController::class, 'showAccounts']);
Route::get('/user/myAccounts/depots', [ClientController::class, 'depot']);
Route::post('/user/myAccounts/depots/send', [ClientController::class, 'stockMoney']);
Route::get('/user/myAccounts/retrait', [ClientController::class, 'showGetMoney']);
Route::post('/user/myAccounts/retrait/send', [ClientController::class, 'getMoney']);
Route::get('/user/virements', [ClientController::class, 'showVirement']);
Route::post('/user/virements/send', [ClientController::class, 'virement']);
Route::get('/user/historique', [ClientController::class, 'showHistoriques']);
Route::get('/user/dashboard', [ClientController::class, 'dashboard']);
Route::get('/user/logout', [AuthController::class, 'logout']);




// Get current URI and method
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Dispatch the route
$router->dispatch($uri, $method);
