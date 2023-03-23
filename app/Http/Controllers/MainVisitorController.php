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

    public function aboutDesa()
    {
        return view('visitor.aboutDesa', [
            'title' => 'Tentang Desa',
        ]);
    }

    public function demografiDesa()
    {
        return view('visitor.demografiDesa', [
            'title' => 'Demografi Desa',
        ]);
    }
    
    public function geografisDesa()
    {
        return view('visitor.geografisDesa', [
            'title' => 'Geografis Desa',
        ]);
    }
}
