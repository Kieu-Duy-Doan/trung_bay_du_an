<?php

namespace App\Controllers\Users;

use App\Controller;
use App\Models\Banner;
use App\Models\Project;
use App\Models\Team;

class HomeController extends Controller
{
    private $bannerModel;
    private $projectModel;
    private $teamModel;

    public function __construct()
    {
        $this->bannerModel = new Banner();
        $this->projectModel = new Project();
        $this->teamModel = new Team();
    }

    public function showHome()
    {
        $banners = $this->bannerModel->getAll();
        $projects = $this->projectModel->getAll([
            'limit' => 4
        ]);
        $teams = $this->teamModel->getAll([
            'limit' => 4,
            'order' => 'DESC',
            'sort' => 'id'
        ]);
        $bannerActives = [];
        $active = 'home';

        foreach ($banners as $banner) {
            if ($banner['active'] == 1) {
                array_push($bannerActives, $banner);
            }
        }

        return view('userViews.home', compact('bannerActives', 'active', 'projects', 'teams'));
    }
}
