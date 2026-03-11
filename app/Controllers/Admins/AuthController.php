<?php

namespace App\Controllers\Admins;

use App\Controller;
use App\Models\User;

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }

    public function showLoginView()
    {
        return view('adminViews.auths.login');
    }

    public function loginUser()
    {
        try {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $data = [
                'email' => $email,
                'password' => $password
            ];

            // Validate dữ liệu
            $rules = [
                'email' => 'required|email',
                'password' => 'required'
            ];

            $this->validator->setMessages([
                'email:required' => 'Vui lòng nhập email',
                'password:required' => 'Vui lòng nhập mật khẩu',
                'email:email' => 'Email không hợp lệ',
            ]);

            $errors = $this->validate($this->validator, $data, $rules);

            if (count($errors) > 0) {
                return view('adminViews.auths.login', compact('errors'));
            }

            $users = $this->userModel->getAll();

            foreach ($users as $key => $user) {
                if ($user['email'] == $email && password_verify($password, $user['password'])) {
                    $_SESSION['myAcc'] = $user;
                    $result = true;
                    break;
                }
            }

            if (!isset($result)) {
                $error = 'Email hoặc mật khẩu không chính xác';
                return view('adminViews.auths.login', compact('error'));
            } else {
                redirect('users');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function logoutUser()
    {
        session_unset();   // xoá tất cả session
        session_destroy(); // huỷ session
        redirect('login');
    }
}
