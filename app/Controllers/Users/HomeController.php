<?php

namespace App\Controllers\Users;

use App\Controller;
use App\Models\Banner;

class HomeController extends Controller
{
    private $bannerModel;

    public function __construct()
    {
        $this->bannerModel = new Banner();
    }

    public function showHome()
    {
        $banners = $this->bannerModel->getAll();
        $bannerActives = [];
        $active = 'home';

        foreach ($banners as $banner) {
            if ($banner['active'] == 1) {
                array_push($bannerActives, $banner);
            }
        }

        return view('userViews.home', compact('bannerActives', 'active'));
    }
}
