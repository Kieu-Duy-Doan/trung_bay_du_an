<?php

namespace App\Controllers\Users;

use App\Controller;
use App\Models\Banner;
use App\Models\Project;

class HomeController extends Controller
{
    private $bannerModel;
    private $projectModel;

    public function __construct()
    {
        $this->bannerModel = new Banner();
        $this->projectModel = new Project();
    }

    public function showHome()
    {
        $banners = $this->bannerModel->getAll();
        $projects = $this->projectModel->getAll([
            'limit' => 4
        ]);
        $bannerActives = [];
        $active = 'home';

        foreach ($banners as $banner) {
            if ($banner['active'] == 1) {
                array_push($bannerActives, $banner);
            }
        }

        return view('userViews.home', compact('bannerActives', 'active', 'projects'));
    }
}
