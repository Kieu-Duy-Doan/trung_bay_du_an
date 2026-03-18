<?php

namespace App\Controllers\Users;

use App\Controller;

class ContactController extends Controller
{
    public function showContact()
    {
        $active = 'contact';
        return view('userViews.contact', compact('active'));
    }
}
