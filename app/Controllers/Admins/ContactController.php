<?php

namespace App\Controllers\Admins;

use App\Controller;
use App\Models\Contact;
use Exception;

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
        $status = htmlspecialchars($_POST['status']) ?? 0;

        $data = [
            'name' => $name,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'message' => $message,
            'status' => $status,
        ];

        return $data;
    }

    public function getAllContacts()
    {
        try {
            if (!isset($_SESSION['myAcc'])) {
                redirect('login');
            }

            $keyword = $_GET['keyword'] ?? '';
            $sort = $_GET['sort'] ?? 'id';
            $order = $_GET['order'] ?? 'ASC';
            $page = $_GET['page'] ?? 1;

            $totalUsers = $this->contactModel->countAll();

            $limit = $_ENV['LIMIT'];

            $totalPage = ceil($totalUsers / $limit);

            $offset = ((int)$page - 1) * $limit;

            if ($keyword) {
                $totalUsers = $this->contactModel->countAll(
                    [
                        'keyword' => $keyword,
                    ]
                );

                $limit = $_ENV['LIMIT'];

                $totalPage = ceil($totalUsers / $limit);

                $offset = ((int)$page - 1) * $limit;


                $categories = $this->contactModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                    'keyword' => $keyword
                ]);
            } else {
                $categories = $this->contactModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                ]);
            }

            return view('adminViews.categories.index', compact('categories', 'totalPage', 'page', 'sort', 'order', 'keyword'));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function showCreateContact()
    {
        return view('adminViews.categories.create');
    }

    public function insertContact()
    {
        try {
            $rawData = $this->getAndCreateFormData();

            $errors = $this->validateData($rawData);

            if (count($errors) > 0) {
                return view('adminViews.categories.create', compact('errors'));
            }

            if (is_upload('img')) {
                $img = $this->uploadFile($_FILES['img'], 'categories');
            } else {
                $img = null;
            }


            $data = [
                'name' => $rawData['name'],
                'img' => $img,
            ];

            $result = $this->contactModel->insert($data);

            if ($result > 0) {
                $_SESSION['success'] = 'Thêm tài khoản thành công!';
                redirect('categories');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function showEditContact($categoryId)
    {
        $category = $this->contactModel->getById($categoryId);
        return view('adminViews.categories.edit', compact('category'));
    }

    public function updateContact()
    {
        try {
            $rawData = $this->getAndCreateFormData();

            $errors = $this->validateData($rawData);

            $category = $this->contactModel->getById($_POST['id']);

            if (count($errors) > 0) {
                return view('adminViews.categories.edit', compact('errors', 'category'));
            }

            if (is_upload('img')) {
                $img = $this->uploadFile($_FILES['img'], 'categories');
                if (file_exists(BASE_URL . $category['img'])) {
                    unlink(BASE_URL . $category['img']);
                }
            } else {
                $img = $category['img'];
            }

            $data = [
                'name' => $rawData['name'],
                'img' => $img,
            ];

            $where = [
                'id' => $_POST['id']
            ];

            $result = $this->contactModel->update($data, $where);

            if ($result > 0) {
                $_SESSION['success'] = 'Sửa thành công!';
                redirect('categories');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function deleteContact($categoryId = false)
    {
        try {
            if ($categoryId) {
                $category = $this->contactModel->getById($categoryId);
                $where = [
                    'id' => $categoryId,
                ];

                $result = $this->contactModel->delete($where);

                if ($result > 0) {
                    if (file_exists(BASE_URL . $category['img'])) {
                        unlink(BASE_URL . $category['img']);
                    }
                    $_SESSION['success'] = 'Xóa thành công';
                    redirect('categories');
                }
            }

            $totalIds = count($_POST['ids']);
            $count = 0;

            foreach ($_POST['ids'] as $id) {
                $category = $this->contactModel->getById($id);
                if (!empty($category)) {
                    $where = [
                        'id' => $id,
                    ];

                    $result = $this->contactModel->delete($where);

                    if ($result > 0) {
                        if (file_exists(BASE_URL . $category['img'])) {
                            unlink(BASE_URL . $category['img']);
                        }
                        ++$count;
                    } else {
                        throw new Exception('Có lỗi xảy ra');
                    }
                } else {
                    throw new Exception('Có lỗi xảy ra');
                }
            }

            if ($count == $totalIds) {
                $_SESSION['success'] = 'Xóa thành công';
                redirect('categories');
            } else {
                echo $count;
                echo $totalIds;
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
