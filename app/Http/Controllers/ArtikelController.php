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

    public function artikelNew()
    {
        return view('staf.artikel.artikelNew', [
            'title' => 'Artikel Baru',
        ]);
    }

    public function artikelNewSubmit(Request $request)
    {
        
        $data = [
            'id_staf' => auth()->user()->id,
            'judul' => $request->input('judul'),
            'isi' => $request->input('content'),
            'is_active' => $request->input('is_active', false),
        ];

        Artikel::create($data);

        return redirect('/staf/manajemen-web/artikel')->with('success', 'Berhasil menambahkan artikel!');
    }

    public function artikelEdit($id)
    {
        $artikel = Artikel::find($id);

        return view('staf.artikel.artikelEdit', [
            'title' => 'Edit Artikel',
            'artikel' => $artikel,
        ]);
    }

    public function artikelEditSubmit(Request $request, $id)
    {
        $data = [
            'id_staf' => auth()->user()->id,
            'judul' => $request->input('judul'),
            'isi' => $request->input('content'),
            'is_active' => $request->input('is_active', false),
        ];

        $artikel = Artikel::find($id)->update($data);
        return redirect('/staf/manajemen-web/artikel')->with('success', 'Artikel berhasil diubah!');
    }

    public function artikelDelete($id)
    {
        Artikel::destroy($id);

        return redirect('/staf/manajemen-web/artikel')->with('success', 'Artikel berhasil dihapus');
    }
}
