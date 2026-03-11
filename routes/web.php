<?php

use App\Controllers\Admins\AuthController;
use App\Controllers\Admins\UserController;
use App\Controllers\Users\HomeController;
use Bramus\Router\Router;

$router = new Router();

// Đây là nơi khai báo các route cho User
$router->get('users', UserController::class . '@getAllUsers');
$router->get('user/create', UserController::class . '@showCreateUser');
$router->post('user/insert', UserController::class . '@insertUser');
$router->get('user/edit/{userId}', UserController::class . '@showEditUser');
$router->post('user/update', UserController::class . '@updateUser');
$router->get('user/delete/{userId}', UserController::class . '@deleteUser');
$router->post('users/delete', UserController::class . '@deleteUser');

// Đây là nơi khai báo các route cho Authentication
$router->get('login', AuthController::class . '@showLoginView');
$router->get('logout', AuthController::class . '@logoutUser');
$router->post('login', AuthController::class . '@loginUser');

// ------------------------
// Bên user view
$router->get('home', HomeController::class . '@showHome');

// xử lý không có đường dẫn nào trùng
// $router->set404(function () {
//     redirect('users/page/1');
// });

$router->run();
