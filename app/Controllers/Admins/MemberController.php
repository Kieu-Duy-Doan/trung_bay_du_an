<?php

namespace App\Controllers\Admins;

use App\Controller;
use App\Models\Member;
use App\Models\Team;
use Exception;

class MemberController extends Controller
{
    private $memberModel;
    private $teamModel;

    public function __construct()
    {
        parent::__construct();
        $this->memberModel = new Member();
        $this->teamModel = new Team();
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
        $team_id = empty($_POST['team_id']) ? null : htmlspecialchars($_POST['team_id']);

        $data = [
            'name' => $name,
            'team_id' => $team_id,
        ];

        return $data;
    }

    public function getAllMembers()
    {
        try {
            if (!isset($_SESSION['myAcc'])) {
                redirect('login');
            }

            $keyword = $_GET['keyword'] ?? '';
            $sort = $_GET['sort'] ?? 'id';
            $order = $_GET['order'] ?? 'ASC';
            $page = $_GET['page'] ?? 1;

            $totalUsers = $this->memberModel->countAll();

            $limit = $_ENV['LIMIT'];

            $totalPage = ceil($totalUsers / $limit);

            $offset = ((int)$page - 1) * $limit;

            if ($keyword) {
                $totalUsers = $this->memberModel->countAll(
                    [
                        'keyword' => $keyword,
                    ]
                );

                $limit = $_ENV['LIMIT'];

                $totalPage = ceil($totalUsers / $limit);

                $offset = ((int)$page - 1) * $limit;


                $members = $this->memberModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                    'keyword' => $keyword
                ]);
            } else {
                $members = $this->memberModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                ]);
            }

            return view('adminViews.members.index', compact('members', 'totalPage', 'page', 'sort', 'order', 'keyword'));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function showCreateMember()
    {
        $teams = $this->teamModel->getAll();
        return view('adminViews.members.create', compact('teams'));
    }

    public function insertMember()
    {
        try {
            $rawData = $this->getAndCreateFormData();

            $errors = $this->validateData($rawData);

            if (count($errors) > 0) {
                return view('adminViews.members.create', compact('errors'));
            }

            if (is_upload('img')) {
                $img = $this->uploadFile($_FILES['img'], 'members');
            } else {
                $img = null;
            }


            $data = [
                'name' => $rawData['name'],
                'team_id' => $rawData['team_id'],
                'img' => $img,
            ];

            $result = $this->memberModel->insert($data);

            if ($result > 0) {
                $_SESSION['success'] = 'Thêm thành công!';
                redirect('members');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function showEditMember($memberId)
    {
        $member = $this->memberModel->getById($memberId);
        $teams = $this->teamModel->getAll();
        return view('adminViews.members.edit', compact('member', 'teams'));
    }

    public function updateMember()
    {
        try {
            $rawData = $this->getAndCreateFormData();

            $errors = $this->validateData($rawData);

            $member = $this->memberModel->getById($_POST['id']);

            if (count($errors) > 0) {
                $teams = $this->teamModel->getAll();
                return view('adminViews.members.edit', compact('errors', 'member', 'teams'));
            }

            if (is_upload('img')) {
                $img = $this->uploadFile($_FILES['img'], 'members');
                if (file_exists(BASE_URL . $member['img'])) {
                    unlink(BASE_URL . $member['img']);
                }
            } else {
                $img = $member['img'];
            }

            $data = [
                'name' => $rawData['name'],
                'team_id' => $rawData['team_id'],
                'img' => $img,
            ];

            $where = [
                'id' => $_POST['id']
            ];

            $result = $this->memberModel->update($data, $where);

            if ($result > 0) {
                $_SESSION['success'] = 'Sửa thành công!';
                redirect('members');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function deleteMember($categoryId = false)
    {
        try {
            if ($categoryId) {
                $category = $this->memberModel->getById($categoryId);
                $where = [
                    'id' => $categoryId,
                ];

                $result = $this->memberModel->delete($where);

                if ($result > 0) {
                    if (file_exists(BASE_URL . $category['img'])) {
                        unlink(BASE_URL . $category['img']);
                    }
                    $_SESSION['success'] = 'Xóa thành công';
                    redirect('members');
                }
            }

            $totalIds = count($_POST['ids']);
            $count = 0;

            foreach ($_POST['ids'] as $id) {
                $category = $this->memberModel->getById($id);
                if (!empty($category)) {
                    $where = [
                        'id' => $id,
                    ];

                    $result = $this->memberModel->delete($where);

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
                redirect('members');
            } else {
                echo $count;
                echo $totalIds;
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
