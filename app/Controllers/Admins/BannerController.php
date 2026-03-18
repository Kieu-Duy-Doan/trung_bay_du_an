<?php

namespace App\Controllers\Admins;

use App\Controller;
use App\Models\Banner;
use Exception;

class BannerController extends Controller
{
    private $bannerModel;

    public function __construct()
    {
        parent::__construct();
        $this->bannerModel = new Banner();
    }

    private function validateData($data, $isNotUpload = false)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'img' => 'required|uploaded_file:0,5M,png,jpg,jpeg,gif,webp',
        ];

        if ($isNotUpload) {
            $rules['img'] = 'uploaded_file:0,5M,png,jpg,jpeg,gif,webp';
        }

        $this->validator->setMessages([
            'name:required' => 'Vui lòng nhập tên',
            'description:required' => 'Vui lòng nhập mô tả',
            'img:required' => 'Vui lòng chọn ảnh',
            'img:uploaded_file' => 'Chỉ chấp nhận ảnh dạng png, jpeg',
        ]);

        $errors = $this->validate($this->validator, $data, $rules);

        return $errors;
    }

    private function getAndCreateFormData()
    {
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $active = $_POST['active'] ?? 0;
        $img = $_FILES['img'];

        $data = [
            'name' => $name,
            'description' => $description,
            'active' => $active,
            'img' => $img,
        ];

        return $data;
    }

    public function getAllBanners()
    {
        try {
            if (!isset($_SESSION['myAcc'])) {
                redirect('login');
            }

            $keyword = $_GET['keyword'] ?? '';
            $sort = $_GET['sort'] ?? 'id';
            $order = $_GET['order'] ?? 'ASC';
            $page = $_GET['page'] ?? 1;

            $totalUsers = $this->bannerModel->countAll();

            $limit = $_ENV['LIMIT'];

            $totalPage = ceil($totalUsers / $limit);

            $offset = ((int)$page - 1) * $limit;

            if ($keyword) {
                $totalUsers = $this->bannerModel->countAll(
                    [
                        'keyword' => $keyword,
                    ]
                );

                $limit = $_ENV['LIMIT'];

                $totalPage = ceil($totalUsers / $limit);

                $offset = ((int)$page - 1) * $limit;


                $banners = $this->bannerModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                    'keyword' => $keyword
                ]);
            } else {
                $banners = $this->bannerModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                ]);
            }

            return view('adminViews.banners.index', compact('banners', 'totalPage', 'page', 'sort', 'order', 'keyword'));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function showCreateBanner()
    {
        return view('adminViews.banners.create');
    }

    public function insertBanner()
    {
        try {
            $rawData = $this->getAndCreateFormData();

            $errors = $this->validateData($rawData);


            if (count($errors) > 0) {
                return view('adminViews.banners.create', compact('errors'));
            }

            if (is_upload('img')) {
                $img = $this->uploadFile($_FILES['img'], 'banners');
            } else {
                $img = null;
            }


            $data = [...$rawData, 'img' => $img];

            $result = $this->bannerModel->insert($data);

            if ($result > 0) {
                $_SESSION['success'] = 'Thêm thành công!';
                redirect('banners');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function showEditBanner($bannerId)
    {
        $banner = $this->bannerModel->getById($bannerId);
        return view('adminViews.banners.edit', compact('banner'));
    }

    public function updateBanner()
    {
        try {
            $rawData = $this->getAndCreateFormData();

            $errors = $this->validateData($rawData, !is_upload('img'));

            $banner = $this->bannerModel->getById($_POST['id']);

            if (count($errors) > 0) {
                return view('adminViews.banners.edit', compact('errors'));
            }

            if (is_upload('img')) {
                $img = $this->uploadFile($_FILES['img'], 'banners');
                if (file_exists(BASE_URL . $banner['img'])) {
                    unlink(BASE_URL . $banner['img']);
                }
            } else {
                $img = $banner['img'];
            }

            $data = [
                ...$rawData,
                'img' => $img,
            ];

            $where = [
                'id' => $_POST['id']
            ];

            $result = $this->bannerModel->update($data, $where);

            if ($result > 0) {
                $_SESSION['success'] = 'Sửa thành công!';
                redirect('banners');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function deleteBanner($bannerId = false)
    {
        try {
            if ($bannerId) {
                $banner = $this->bannerModel->getById($bannerId);
                $where = [
                    'id' => $bannerId,
                ];

                $result = $this->bannerModel->delete($where);

                if ($result > 0) {
                    if (file_exists(BASE_URL . $banner['img'])) {
                        unlink(BASE_URL . $banner['img']);
                    }
                    $_SESSION['success'] = 'Xóa thành công';
                    redirect('banners');
                }
            }

            $totalIds = count($_POST['ids']);
            $count = 0;

            foreach ($_POST['ids'] as $id) {
                $banner = $this->bannerModel->getById($id);
                if (!empty($banner)) {
                    $where = [
                        'id' => $id,
                    ];

                    $result = $this->bannerModel->delete($where);

                    if ($result > 0) {
                        if (file_exists(BASE_URL . $banner['img'])) {
                            unlink(BASE_URL . $banner['img']);
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
                redirect('banners');
            } else {
                echo $count;
                echo $totalIds;
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function updateBannerOneColumn()
    {
        try {
            $key = $_GET['key'] ?? $_POST['key'];
            $value = $_GET['value'] ?? $_POST['value'];
            $column =  $_GET['column'] ?? $_POST['column'];
            $columnVulue =  $_GET['columnValue'] ?? $_POST['columnValue'];

            $result = $this->bannerModel->updateOneColunm([
                'column' => $column,
                'columnValue' => $columnVulue,
                'key' => $key,
                'value' => $value
            ]);

            if ($result > 0) {
                $_SESSION['success'] = 'Cập nhật thành công';
                redirect('banners');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
