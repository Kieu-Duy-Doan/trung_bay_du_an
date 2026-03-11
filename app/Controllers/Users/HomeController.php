<?php

namespace App\Controllers\Users;

use App\Controller;

class HomeController extends Controller
{
    public function showHome()
    {
        return view('userViews.home');
    }
}
