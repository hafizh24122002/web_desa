<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class MainVisitorController extends Controller
{
    public function index()
    {
        return view('visitor.index', [
            'title' => 'Home',
            'artikel' => Artikel::join(
                'users', 'artikel.id_staf', '=', 'users.id'
            )->select(
                'artikel.*',
                'users.name',
            )->where(
                'is_active', '=', 1
            )->orderBy('updated_at', 'desc')->paginate(5),
        ]);
    }
}
