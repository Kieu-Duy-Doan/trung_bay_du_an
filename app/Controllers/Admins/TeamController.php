<?php

namespace App\Controllers\Admins;

use App\Controller;
use App\Models\Team;
use Exception;

class TeamController extends Controller
{
    private $teamModel;

    public function __construct()
    {
        parent::__construct();
        $this->teamModel = new Team();
    }

    private function validateData($data)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];

        $this->validator->setMessages([
            'name:required' => 'Vui lòng nhập tên',
            'description:required' => 'Vui lòng nhập mô tả',
        ]);

        $errors = $this->validate($this->validator, $data, $rules);

        return $errors;
    }

    private function getAndCreateFormData()
    {
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);

        $data = [
            'name' => $name,
            'description' => $description,
        ];

        return $data;
    }

    public function getAllTeams()
    {
        try {
            if (!isset($_SESSION['myAcc'])) {
                redirect('login');
            }

            $keyword = $_GET['keyword'] ?? '';
            $sort = $_GET['sort'] ?? 'id';
            $order = $_GET['order'] ?? 'ASC';
            $page = $_GET['page'] ?? 1;

            $totalUsers = $this->teamModel->countAll();

            $limit = $_ENV['LIMIT'];

            $totalPage = ceil($totalUsers / $limit);

            $offset = ((int)$page - 1) * $limit;

            if ($keyword) {
                $totalUsers = $this->teamModel->countAll(
                    [
                        'keyword' => $keyword,
                    ]
                );

                $limit = $_ENV['LIMIT'];

                $totalPage = ceil($totalUsers / $limit);

                $offset = ((int)$page - 1) * $limit;


                $teams = $this->teamModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                    'keyword' => $keyword
                ]);
            } else {
                $teams = $this->teamModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                ]);
            }

            return view('adminViews.teams.index', compact('teams', 'totalPage', 'page', 'sort', 'order', 'keyword'));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function showCreateTeam()
    {
        return view('adminViews.teams.create');
    }

    public function insertTeam()
    {
        try {
            $rawData = $this->getAndCreateFormData();

            $errors = $this->validateData($rawData);

            if (count($errors) > 0) {
                return view('adminViews.teams.create', compact('errors'));
            }

            if (is_upload('img')) {
                $img = $this->uploadFile($_FILES['img'], 'teams');
            } else {
                $img = null;
            }


            $data = [...$rawData, 'img' => $img];

            $result = $this->teamModel->insert($data);

            if ($result > 0) {
                $_SESSION['success'] = 'Thêm thành công!';
                redirect('teams');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function showEditTeam($teamId)
    {
        $team = $this->teamModel->getById($teamId);
        return view('adminViews.teams.edit', compact('team'));
    }

    public function updateTeam()
    {
        try {
            $rawData = $this->getAndCreateFormData();

            $errors = $this->validateData($rawData);

            $team = $this->teamModel->getById($_POST['id']);

            if (count($errors) > 0) {
                return view('adminViews.teams.edit', compact('errors', 'team'));
            }

            if (is_upload('img')) {
                $img = $this->uploadFile($_FILES['img'], 'teams');
                if (file_exists(BASE_URL . $team['img'])) {
                    unlink(BASE_URL . $team['img']);
                }
            } else {
                $img = $team['img'];
            }

            $data = [
                'name' => $rawData['name'],
                'img' => $img,
            ];

            $where = [
                'id' => $_POST['id']
            ];

            $result = $this->teamModel->update($data, $where);

            if ($result > 0) {
                $_SESSION['success'] = 'Sửa thành công!';
                redirect('teams');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function deleteTeam($teamId = false)
    {
        try {
            if ($teamId) {
                $team = $this->teamModel->getById($teamId);
                $where = [
                    'id' => $teamId,
                ];

                $result = $this->teamModel->delete($where);

                if ($result > 0) {
                    if (file_exists(BASE_URL . $team['img'])) {
                        unlink(BASE_URL . $team['img']);
                    }
                    $_SESSION['success'] = 'Xóa thành công';
                    redirect('teams');
                }
            }

            $totalIds = count($_POST['ids']);
            $count = 0;

            foreach ($_POST['ids'] as $id) {
                $team = $this->teamModel->getById($id);
                if (!empty($team)) {
                    $where = [
                        'id' => $id,
                    ];

                    $result = $this->teamModel->delete($where);

                    if ($result > 0) {
                        if (file_exists(BASE_URL . $team['img'])) {
                            unlink(BASE_URL . $team['img']);
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
                redirect('teams');
            } else {
                echo $count;
                echo $totalIds;
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
