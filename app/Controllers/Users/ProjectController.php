<?php

namespace App\Controllers\Users;

use App\Controller;
use App\Models\Category;
use App\Models\Member;
use App\Models\Project;
use App\Models\Team;

class ProjectController extends Controller
{
    private $projectModel;
    private $categoryModel;
    private $teamModel;
    private $memberModel;

    public function __construct()
    {
        $this->projectModel = new Project();
        $this->categoryModel = new Category();
        $this->teamModel = new Team();
        $this->memberModel = new Member();
    }

    public function showProjects()
    {
        try {
            $limit = $_ENV['limit'] ?? 8;
            $order = $_GET['order'] ?? 'ASC';
            $sort = $_GET['sort'] ?? 'id';
            $page = $_GET['page'] ?? 1;
            $offset = ($page - 1) * $limit;
            $key = empty($_GET['key']) ? null : $_GET['key'];
            $value = empty($_GET['value']) ? null : $_GET['value'];
            $keyword = empty($_GET['keyword']) ? null : $_GET['keyword'];

            $totalProjects = $this->projectModel->countAll(
                [
                    'keyword' => $keyword,
                    'key' => $key,
                    'value' => $value,
                ]
            );

            $totalPages = ceil($totalProjects / $limit);

            $projects = $this->projectModel->getAll([
                'offset' => $offset,
                'limit' => $limit,
                'order' => $order,
                'sort' => $sort,
                'keyword' => $keyword,
                'key' => $key,
                'value' => $value,
            ]);
            $categories = $this->categoryModel->getAll();
            $active = 'projects';
            return view('userViews.product', compact('projects', 'categories', 'offset', 'limit', 'order', 'sort', 'key', 'value', 'page', 'totalPages', 'active', 'totalProjects', 'keyword'));
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function showProjectDetail($projectId)
    {
        try {
            $project = $this->projectModel->getById($projectId);
            $team = $this->teamModel->getById($project['team_id']);
            $members = $this->memberModel->getMembersOfTeam($team['id']);
            return view('userViews.productDetail', compact('project', 'team', 'members'));
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
