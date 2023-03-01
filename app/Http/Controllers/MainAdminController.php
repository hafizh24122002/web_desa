<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainAdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'title' => 'Home Admin',
        ]);
    }
    public function login(){
        return view('admin.login', [
            'title' => 'Login',
        ]);
    }
}
