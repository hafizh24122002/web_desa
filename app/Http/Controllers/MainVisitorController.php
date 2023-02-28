<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainVisitorController extends Controller
{
    public function index()
    {
        return view('visitor.index', [
            'title' => 'Home',
        ]);
    }
}
