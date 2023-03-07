<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MainAdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'title' => 'Home Admin',
        ]);
    }

    public function userManager()
    {
        return view('admin.userManager', [
            'title' => 'User Manager',
            'users' => User::all(),
        ]);
    }
}
