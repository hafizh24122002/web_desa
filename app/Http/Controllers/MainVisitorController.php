<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Agenda;
use Carbon\Carbon;

class MainVisitorController extends Controller
{
    public function index()
    {
        $artikel = Artikel::join(
            'users',
            'artikel.id_staf',
            '=',
            'users.id'
        )->select(
            'artikel.*',
            'users.name'
        )->where(
            'is_active',
            '=',
            1
        )->orderBy('updated_at', 'desc')->paginate(5);

        $currentDate = Carbon::now();

        // Mengelompokkan agenda yang sudah lewat dan agenda yang akan datang
        $pastAgenda = Agenda::select('judul', 'tgl_agenda', 'lokasi', 'koordinator')
            ->where('tgl_agenda', '<', $currentDate)
            ->orderBy('tgl_agenda', 'desc')
            ->get();

        $upcomingAgenda = Agenda::select('judul', 'tgl_agenda', 'lokasi', 'koordinator')
            ->where('tgl_agenda', '>', $currentDate)
            ->orderBy('tgl_agenda')
            ->get();

        // Ubah format tgl_agenda menggunakan translatedFormat('jS F Y')
        foreach ($pastAgenda as $agenda) {
            $agenda->tgl_agenda = Carbon::parse($agenda->tgl_agenda)->translatedFormat('jS F Y');
        }

        foreach ($upcomingAgenda as $agenda) {
            $agenda->tgl_agenda = Carbon::parse($agenda->tgl_agenda)->translatedFormat('jS F Y');
        }

        return view('visitor.index', compact('artikel', 'pastAgenda', 'upcomingAgenda'))->with('title', 'Home');
    }

    // public function incrementClickCount($articleId)
    // {
    //     $article = Artikel::find($articleId);
    //     if ($article) {
    //         $article->click_count++;
    //         $article->save();
    //     }
    //     // Tidak perlu ada response khusus, karena ini hanya dilakukan melalui JavaScript
    // }

    public function bacaArtikel($judul)
{
    // Ambil data artikel berdasarkan judul
    $artikel = Artikel::where('judul', $judul)->first();

    if (!$artikel) {
        return abort(404); // Artikel tidak ditemukan
    }


        // Tambahkan 1 ke click_count
        $artikel->click_count++;
        $artikel->save();

    // Ambil data terbaru setelah penambahan click_count
    $data = Artikel::join(
        'users',
        'artikel.id_staf',
        '=',
        'users.id'
    )->select(
        'artikel.*',
        'users.name',
    )->where(
        'judul',
        '=',
        $judul
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
