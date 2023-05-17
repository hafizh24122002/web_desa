<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function dashboard()
    {
        return view('staf.artikel.dashboard', [
            'title' => 'Dashboard Artikel',
        ]);
    }

    public function articleManager()
    {
        return view('staf.artikel.articleManager', [
            'title' => 'Manajer Artikel',
            'artikel' => Artikel::join(
                'users', 'artikel.id_staf', '=', 'users.id'
            )->select(
                'artikel.*',
                'users.name',
            )->orderBy('updated_at', 'desc')->paginate(10),
        ]);
    }
}
