<?php

namespace App\Controllers\Users;

use App\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    private $contactModel;

    public function __construct()
    {
        parent::__construct();
        $this->contactModel = new Contact();
    }

    private function validateData($data)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'phoneNumber' => 'required|digits:10',
            'message' => 'required',
            'status' => 'required',
        ];

        $this->validator->setMessages([
            'name:required' => 'Vui lòng nhập tên',
            'email:required' => 'Vui lòng nhập email',
            'email:email' => 'Email không hợp lệ',
            'phoneNumber:required' => 'Vui lòng nhập số điện thoại',
            'phoneNumber:digits' => 'Số điện phải gồm 10 số',
            'message:required' => 'Vui lòng nhập lời nhắn',
        ]);

        $errors = $this->validate($this->validator, $data, $rules);

        return $errors;
    }

    private function getAndCreateFormData()
    {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
        $message = htmlspecialchars($_POST['message']);
        $status = isset($_POST['status']) ? htmlspecialchars($_POST['status']) : 0;

        $data = [
            'name' => $name,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'message' => $message,
            'status' => $status,
        ];

        return $data;
    }

    public function showContact()
    {
        $active = 'contact';
        $_SESSION['route'] = str_replace($_ENV['APP_NAME'], '', $_SERVER['REQUEST_URI']);
        return view('userViews.contact', compact('active'));
    }

    public function insertContact()
    {
        try {
            $rawData = $this->getAndCreateFormData();
            $errors = $this->validateData($rawData);

            if (count($errors) > 0) {
                return view('userViews.contact', compact('errors'));
            }

            $data = [
                ...$rawData
            ];

            $result = $this->contactModel->insert($data);

            if ($result > 0) {
                $_SESSION['success'] = 'Gửi thông tin thành công';
                $route = $_SESSION['route'];
                unset($_SESSION['route']);
                redirect($route);
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
