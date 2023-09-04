<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class TestController extends Controller
{
    public function index()
    {
        $article = Artikel::all();
        return response()->json($article);
    }
}
