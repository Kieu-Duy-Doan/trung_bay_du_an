<?php

namespace App\Controllers\Admins;

use App\Controller;
use App\Models\User;

class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }

    private function validateData($data)
    {
        $rules = [
            'name'                  => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
            'password_confirmation'      => 'required|same:password',
        ];

        $this->validator->setMessages([
            'email:required' => 'Vui lòng nhập email',
            'name:required' => 'Vui lòng nhập tên',
            'password:required' => 'Vui lòng nhập mật khẩu',
            'password_confirmation:required' => 'Vui lòng nhập lại mật khẩu',
            'password_confirmation:same' => 'Mật khẩu không khớp nhau',
            'password:min' => 'Mật khẩu phải gồm 6 ký tự',
            'email:email' => 'Email không hợp lệ',
        ]);

        $errors = $this->validate($this->validator, $data, $rules);

        return $errors;
    }

    private function getAndCreateFormData()
    {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $passwordConfirmation = htmlspecialchars($_POST['password_confirmation']);

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $passwordConfirmation
        ];

        return $data;
    }

    public function getAllUsers()
    {
        try {
            if (!isset($_SESSION['myAcc'])) {
                redirect('login');
            }

            $keyword = $_GET['keyword'] ?? '';
            $sort = $_GET['sort'] ?? 'id';
            $order = $_GET['order'] ?? 'ASC';
            $page = $_GET['page'] ?? 1;

            $totalUsers = $this->userModel->countAll();

            $limit = $_ENV['LIMIT'];

            $totalPage = ceil($totalUsers / $limit);

            $offset = ((int)$page - 1) * $limit;

            if ($keyword) {
                $totalUsers = $this->userModel->countAll(
                    [
                        'keyword' => $keyword,
                    ]
                );

                $limit = $_ENV['LIMIT'];

                $totalPage = ceil($totalUsers / $limit);

                $offset = ((int)$page - 1) * $limit;


                $users = $this->userModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                    'keyword' => $keyword
                ]);
            } else {
                $users = $this->userModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                ]);
            }

            return view('adminViews.users.index', compact('users', 'totalPage', 'page', 'sort', 'order', 'keyword'));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function showCreateUser()
    {
        return view('adminViews.users.create');
    }

    public function insertUser()
    {
        try {
            $rawData = $this->getAndCreateFormData();

            $errors = $this->validateData($rawData);

            if (count($errors) > 0) {
                return view('adminViews.users.create', compact('errors'));
            }

            $hashPassword = password_hash($rawData['password'], PASSWORD_DEFAULT);

            $data = [
                'name' => $rawData['name'],
                'email' => $rawData['email'],
                'password' => $hashPassword
            ];

            $result = $this->userModel->insert($data);

            if ($result > 0) {
                $_SESSION['success'] = 'Thêm tài khoản thành công!';
                redirect('users');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function showEditUser($userId)
    {
        $user = $this->userModel->getById($userId);
        return view('adminViews.users.edit', compact('user'));
    }

    public function updateUser()
    {
        try {
            $rawData = $this->getAndCreateFormData();

            $errors = $this->validateData($rawData);

            if (count($errors) > 0) {
                $user = $this->userModel->getById($_POST['id']);
                return view('adminViews.users.edit', compact('errors', 'user'));
            }

            $hashPassword = password_hash($rawData['password'], PASSWORD_DEFAULT);

            $data = [
                'name' => $rawData['name'],
                'email' => $rawData['email'],
                'password' => $hashPassword
            ];

            $where = [
                'id' => $_POST['id']
            ];

            $result = $this->userModel->update($data, $where);

            if ($result > 0) {
                $_SESSION['success'] = 'Sửa thành công!';
                redirect('users');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function deleteUser($userId = false)
    {
        try {
            if ($userId) {
                $where = [
                    'id' => $userId,
                ];

                $result = $this->userModel->delete($where);

                if ($result > 0) {
                    $_SESSION['success'] = 'Xóa thành công';
                    redirect('users');
                }
            }

            $totalIds = count($_POST['ids']);
            $count = 0;

            foreach ($_POST['ids'] as $id) {
                $where = [
                    'id' => $id,
                ];

                $result = $this->userModel->delete($where);

                if ($result > 0) {
                    ++$count;
                }
            }

            if ($count == $totalIds) {
                $_SESSION['success'] = 'Xóa thành công';
                redirect('users');
            } else {
                echo $count;
                echo $totalIds;
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
