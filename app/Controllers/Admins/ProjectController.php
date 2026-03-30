<?php

namespace App\Controllers\Admins;

use App\Controller;
use App\Models\Category;
use App\Models\Project;
use App\Models\Team;
use Exception;

class ProjectController extends Controller
{
    private $projectModel;
    private $categoryModel;
    private $teamModel;

    public function __construct()
    {
        parent::__construct();
        $this->projectModel = new Project();
        $this->categoryModel = new Category();
        $this->teamModel = new Team();
    }

    private function validateData($data)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'team_id' => 'required',
        ];

        $this->validator->setMessages([
            'name:required' => 'Vui lòng nhập tên',
            'description:required' => 'Vui lòng nhập mô tả',
            'category_id:required' => 'Vui lòng chọn danh mục',
            'team_id:required' => 'Vui lòng chọn team phát triển',
        ]);

        $errors = $this->validate($this->validator, $data, $rules);

        return $errors;
    }

    private function getAndCreateFormData()
    {
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $categoryId = htmlspecialchars($_POST['category_id']);
        $teamId = htmlspecialchars($_POST['team_id']);
        $linkDemo = htmlspecialchars($_POST['link_demo']) ?? null;

        $data = [
            'name' => $name,
            'description' => $description,
            'category_id' => $categoryId,
            'team_id' => $teamId,
            'link_demo' => $linkDemo,
        ];

        return $data;
    }

    public function getAllProjects()
    {
        try {
            if (!isset($_SESSION['myAcc'])) {
                redirect('login');
            }

            $keyword = $_GET['keyword'] ?? '';
            $sort = $_GET['sort'] ?? 'id';
            $order = $_GET['order'] ?? 'ASC';
            $page = $_GET['page'] ?? 1;

            $totalUsers = $this->projectModel->countAll();

            $limit = $_ENV['LIMIT'];

            $totalPage = ceil($totalUsers / $limit);

            $offset = ((int)$page - 1) * $limit;

            if ($keyword) {
                $totalUsers = $this->projectModel->countAll(
                    [
                        'keyword' => $keyword,
                    ]
                );

                $limit = $_ENV['LIMIT'];

                $totalPage = ceil($totalUsers / $limit);

                $offset = ((int)$page - 1) * $limit;


                $projects = $this->projectModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                    'keyword' => $keyword
                ]);
            } else {
                $projects = $this->projectModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                ]);
            }

            foreach ($projects as &$project) {
                $project['team_name'] = $this->teamModel->getById($project['team_id'])['name'];
            }

            // Xóa bỏ biến $project để tránh bị ảnh hưởng đến các phần khác của code
            unset($project);

            return view('adminViews.projects.index', compact('projects', 'totalPage', 'page', 'sort', 'order', 'keyword'));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function showCreateProject()
    {
        $teams = $this->teamModel->getAll();
        $categories = $this->categoryModel->getAll();
        return view('adminViews.projects.create', compact('categories', 'teams'));
    }

    public function insertProject()
    {
        try {
            $rawData = $this->getAndCreateFormData();

            $errors = $this->validateData($rawData);

            if (count($errors) > 0) {
                $categories = $this->categoryModel->getAll();
                $teams = $this->teamModel->getAll();
                return view('adminViews.projects.create', compact('errors', 'categories', 'teams'));
            }

            if (is_upload('img')) {
                $img = $this->uploadFile($_FILES['img'], 'projects');
            } else {
                $img = null;
            }


            $data = [...$rawData, 'img' => $img];

            $result = $this->projectModel->insert($data);

            if ($result > 0) {
                $_SESSION['success'] = 'Thêm dự án thành công!';
                redirect('projects');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function showEditProject($projectId)
    {
        $_SESSION['url_prev'] =  $this->getCurrentRoute();
        $project = $this->projectModel->getById($projectId);
        $categories = $this->categoryModel->getAll();
        $teams = $this->teamModel->getAll();
        return view('adminViews.projects.edit', compact('project', 'categories', 'teams'));
    }

    public function updateProject()
    {
        try {
            $rawData = $this->getAndCreateFormData();

            $errors = $this->validateData($rawData);

            $project = $this->projectModel->getById($_POST['id']);

            if (count($errors) > 0) {
                $categories = $this->categoryModel->getAll();
                $teams = $this->teamModel->getAll();
                return view('adminViews.projects.edit', compact('errors', 'categories', 'teams', 'project'));
            }

            if (is_upload('img')) {
                $img = $this->uploadFile($_FILES['img'], 'projects');
                if (file_exists(BASE_URL . $project['img'])) {
                    unlink(BASE_URL . $project['img']);
                }
            } else {
                $img = $project['img'];
            }

            $data = [
                ...$rawData,
                'img' => $img,
            ];

            $where = [
                'id' => $_POST['id']
            ];

            $result = $this->projectModel->update($data, $where);

            if ($result > 0) {
                $_SESSION['success'] = 'Sửa thành công!';
                redirect($_SESSION['url_prev']);
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra, vui lòng thử lại!';
                redirect($_SESSION['url_prev']);
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function deleteProject($categoryId = false)
    {
        try {
            if ($categoryId) {
                $category = $this->projectModel->getById($categoryId);
                $where = [
                    'id' => $categoryId,
                ];

                $result = $this->projectModel->delete($where);

                if ($result > 0) {
                    if (file_exists(BASE_URL . $category['img'])) {
                        unlink(BASE_URL . $category['img']);
                    }
                    $_SESSION['success'] = 'Xóa thành công';
                    redirect('projects');
                }
            }

            $totalIds = count($_POST['ids']);
            $count = 0;

            foreach ($_POST['ids'] as $id) {
                $category = $this->projectModel->getById($id);
                if (!empty($category)) {
                    $where = [
                        'id' => $id,
                    ];

                    $result = $this->projectModel->delete($where);

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
                redirect('projects');
            } else {
                echo $count;
                echo $totalIds;
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
