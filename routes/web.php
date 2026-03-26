<?php

use App\Controllers\Admins\AuthController;
use App\Controllers\Admins\BannerController;
use App\Controllers\Admins\CategoryController;
use App\Controllers\Admins\ContactController as AdminsContactController;
use App\Controllers\Admins\MemberController;
use App\Controllers\Admins\MemberTeamController;
use App\Controllers\Admins\ProjectController;
use App\Controllers\Admins\TeamController;
use App\Controllers\Admins\UserController;
use App\Controllers\Users\ContactController;
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
$router->get('team/detail/{teamId}', TeamController::class . '@showDetailView');

// Đây là nơi khai báo các route cho Members
$router->get('members', MemberController::class . '@getAllMembers');
$router->get('member/create', MemberController::class . '@showCreateMember');
$router->post('member/insert', MemberController::class . '@insertMember');
$router->get('member/edit/{teamId}', MemberController::class . '@showEditMember');
$router->post('member/update', MemberController::class . '@updateMember');
$router->get('member/delete/{teamId}', MemberController::class . '@deleteMember');
$router->post('members/delete', MemberController::class . '@deleteMember');
// $router->post('member/updateTeam', MemberController::class . '@updateTeamMember');

// Đây là nơi khai báo các route cho Banners
$router->get('banners', BannerController::class . '@getAllBanners');
$router->get('banner/create', BannerController::class . '@showCreateBanner');
$router->post('banner/insert', BannerController::class . '@insertBanner');
$router->get('banner/edit/{bannerId}', BannerController::class . '@showEditBanner');
$router->post('banner/update', BannerController::class . '@updateBanner');
$router->get('banner/delete/{bannerId}', BannerController::class . '@deleteBanner');
$router->post('banners/delete', BannerController::class . '@deleteBanner');
$router->get('banner/update', BannerController::class . '@updateBannerOneColumn');

// Đây là nơi khai báo các route cho Authentication
$router->get('login', AuthController::class . '@showLoginView');
$router->get('logout', AuthController::class . '@logoutUser');
$router->post('login', AuthController::class . '@loginUser');

// Đây là nơi khai báo các route cho member_team
$router->post('member_team/inser', MemberTeamController::class . '@inserMemberTeam');
$router->post('member_team/delete', MemberTeamController::class . '@deleteMemberTeam');


// / Đây là nơi khai báo các route cho Contact
$router->get('contacts', AdminsContactController::class . '@getAllContacts');
$router->get('contact/create', AdminsContactController::class . '@showCreateContact');
$router->get('contact/detail/{contactId}', AdminsContactController::class . '@showDetailContact');
$router->post('contact/update', AdminsContactController::class . '@updateContact');
$router->get('contact/delete/{contactId}', AdminsContactController::class . '@deleteContact');
$router->post('contacts/delete', AdminsContactController::class . '@deleteContact');
$router->get('contact/prepare/{contactId}', AdminsContactController::class . '@showViewPrepareSendMail');
$router->post('contact/sendMail', AdminsContactController::class . '@sendMail');

// route bên khách
$router->post('contact/insert', ContactController::class . '@insertContact');
// ------------------------
// Bên user view
$router->get('home', HomeController::class . '@showHome');
$router->get('contact', ContactController::class . '@showContact');

// xử lý không có đường dẫn nào trùng
// $router->set404(function () {
//     redirect('users/page/1');
// });

$router->run();
