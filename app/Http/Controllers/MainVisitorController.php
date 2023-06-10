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

    public function bacaArtikel($judul)
    {
        $data = Artikel::join(
            'users', 'artikel.id_staf', '=', 'users.id'
        )->select(
            'artikel.*',
            'users.name',
        )->where(
            'judul', '=', $judul
        )->first(); 

        return view('visitor.bacaArtikel', [
            'title' => $judul,
            'artikel' => $data,
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
