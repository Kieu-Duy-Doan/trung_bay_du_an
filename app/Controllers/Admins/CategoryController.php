<?php

namespace App\Controllers\Admins;

use App\Controller;
use App\Models\Category;
use Error;
use Exception;

class CategoryController extends Controller
{
    private $categoryModel;

    public function __construct()
    {
        parent::__construct();
        $this->categoryModel = new Category();
    }

    private function validateData($data)
    {
        $rules = [
            'name' => 'required',
        ];

        $this->validator->setMessages([
            'name:required' => 'Vui lòng nhập tên',
        ]);

        $errors = $this->validate($this->validator, $data, $rules);

        return $errors;
    }

    private function getAndCreateFormData()
    {
        $name = htmlspecialchars($_POST['name']);

        $data = [
            'name' => $name,
        ];

        return $data;
    }

    public function getAllCategories()
    {
        try {
            if (!isset($_SESSION['myAcc'])) {
                redirect('login');
            }

            $keyword = $_GET['keyword'] ?? '';
            $sort = $_GET['sort'] ?? 'id';
            $order = $_GET['order'] ?? 'ASC';
            $page = $_GET['page'] ?? 1;

            $totalUsers = $this->categoryModel->countAll();

            $limit = $_ENV['LIMIT'];

            $totalPage = ceil($totalUsers / $limit);

            $offset = ((int)$page - 1) * $limit;

            if ($keyword) {
                $totalUsers = $this->categoryModel->countAll(
                    [
                        'keyword' => $keyword,
                    ]
                );

                $limit = $_ENV['LIMIT'];

                $totalPage = ceil($totalUsers / $limit);

                $offset = ((int)$page - 1) * $limit;


                $categories = $this->categoryModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                    'keyword' => $keyword
                ]);
            } else {
                $categories = $this->categoryModel->getAll([
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

    public function showCreateCategory()
    {
        return view('adminViews.categories.create');
    }

    public function insertCategory()
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

            $result = $this->categoryModel->insert($data);

            if ($result > 0) {
                $_SESSION['success'] = 'Thêm tài khoản thành công!';
                redirect('categories');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function showEditCategory($categoryId)
    {
        $category = $this->categoryModel->getById($categoryId);
        return view('adminViews.categories.edit', compact('category'));
    }

    public function updateCategory()
    {
        try {
            $rawData = $this->getAndCreateFormData();

            $errors = $this->validateData($rawData);

            $category = $this->categoryModel->getById($_POST['id']);

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

            $result = $this->categoryModel->update($data, $where);

            if ($result > 0) {
                $_SESSION['success'] = 'Sửa thành công!';
                redirect('categories');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function deleteCategory($categoryId = false)
    {
        try {
            if ($categoryId) {
                $category = $this->categoryModel->getById($categoryId);
                $where = [
                    'id' => $categoryId,
                ];

                $result = $this->categoryModel->delete($where);

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
                $category = $this->categoryModel->getById($id);
                if (!empty($category)) {
                    $where = [
                        'id' => $id,
                    ];

                    $result = $this->categoryModel->delete($where);

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
