<?php

use App\Controllers\Admins\AuthController;
use App\Controllers\Admins\CategoryController;
use App\Controllers\Admins\ProjectController;
use App\Controllers\Admins\TeamController;
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

// Đây là nơi khai báo các route cho Category
$router->get('categories', CategoryController::class . '@getAllCategories');
$router->get('category/create', CategoryController::class . '@showCreateCategory');
$router->post('category/insert', CategoryController::class . '@insertCategory');
$router->get('category/edit/{categoryId}', CategoryController::class . '@showEditCategory');
$router->post('category/update', CategoryController::class . '@updateCategory');
$router->get('category/delete/{categoryId}', CategoryController::class . '@deleteCategory');
$router->post('categories/delete', CategoryController::class . '@deleteCategory');

// Đây là nơi khai báo các route cho Projects
$router->get('projects', ProjectController::class . '@getAllProjects');
$router->get('project/create', ProjectController::class . '@showCreateProject');
$router->post('project/insert', ProjectController::class . '@insertProject');
$router->get('project/edit/{projectId}', ProjectController::class . '@showEditProject');
$router->post('project/update', ProjectController::class . '@updateProject');
$router->get('project/delete/{projectId}', ProjectController::class . '@deleteProject');
$router->post('projects/delete', ProjectController::class . '@deleteProject');

// Đây là nơi khai báo các route cho Teams
$router->get('teams', TeamController::class . '@getAllTeams');
$router->get('team/create', TeamController::class . '@showCreateTeam');
$router->post('team/insert', TeamController::class . '@insertTeam');
$router->get('team/edit/{teamId}', TeamController::class . '@showEditTeam');
$router->post('team/update', TeamController::class . '@updateTeam');
$router->get('team/delete/{teamId}', TeamController::class . '@deleteTeam');
$router->post('teams/delete', TeamController::class . '@deleteTeam');

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
