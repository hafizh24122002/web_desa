<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\ArtikelView;
use App\Models\Agenda;
use App\Models\Staf;
use App\Models\Penduduk;
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

        // Statistik
        $penduduk = Penduduk::all();
        $total_penduduk = $penduduk->count();

        $arr_gender = [];

        $l_count = $penduduk->where('jenis_kelamin', 'L')->count();
        $p_count = $penduduk->where('jenis_kelamin', 'P')->count();
        $total_gender = $l_count + $p_count;

        $l_percentage = $total_penduduk > 0 ? ($l_count / $total_penduduk) * 100 : 0;
        $p_percentage = $total_penduduk > 0 ? ($p_count / $total_penduduk) * 100 : 0;
        $total_gender_percentage = $total_penduduk > 0 ? ($total_gender / $total_penduduk) * 100 : 0;

        $arr_gender = [
            [
                'id' => 1,
                'name' => 'LAKI-LAKI',
                'count' => $l_count,
                'percentage' => $l_percentage,
            ],
            [
                'id' => 2,
                'name' => 'PEREMPUAN',
                'count' => $p_count,
                'percentage' => $p_percentage,
            ],
            [
                'id' => 3,
                'name' => 'TOTAL',
                'count' => $total_gender,
                'percentage' => $total_gender_percentage
            ]
        ];

        // Staf
        $staf = Staf::all();

        session([
            'artikel' => $artikel,
            'pastAgenda' => $pastAgenda,
            'upcomingAgenda' => $upcomingAgenda,
            'penduduk' => $penduduk,
            'total_penduduk' => $total_penduduk,
            'total_gender' => $total_gender,
            'total_gender_percentage' => $total_gender_percentage,
            'arr_gender' => $arr_gender,
            'staf' => $staf,
        ]);

        return view('visitor.index', compact('artikel', 'pastAgenda', 'upcomingAgenda'))
            ->with('title', 'Home')
            ->with([
                'penduduk' => $penduduk,
                'total_penduduk' => $total_penduduk,
                'total_gender' => $total_gender,
                'total_gender_percentage' => $total_gender_percentage,
                'arr_gender' => $arr_gender,
                'staf' => $staf,
            ]);
    }

    public function bacaArtikel($judul)
    {
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

        $data->views()->create();       // catat artikel dilihat

        $upcomingAgenda = session('upcomingAgenda');
        $pastAgenda = session('pastAgenda');
        $penduduk = session('penduduk');
        $total_penduduk = session('total_penduduk');
        $total_gender = session('total_gender');
        $total_gender_percentage = session('total_gender_percentage');
        $arr_gender = session('arr_gender');
        $staf = session('staf');

        return view('visitor.bacaArtikel', [
            'title' => $judul,
            'artikel' => $data,
            'upcomingAgenda' => $upcomingAgenda,
            'pastAgenda' => $pastAgenda,
            'penduduk' => $penduduk,
            'total_penduduk' => $total_penduduk,
            'total_gender' => $total_gender,
            'total_gender_percentage' => $total_gender_percentage,
            'arr_gender' => $arr_gender,
            'staf' => $staf,
        ]);
    }

    public function aboutDesa()
    {
        $upcomingAgenda = session('upcomingAgenda');
        $pastAgenda = session('pastAgenda');
        $artikel = session('artikel');
        $penduduk = session('penduduk');
        $total_penduduk = session('total_penduduk');
        $total_gender = session('total_gender');
        $total_gender_percentage = session('total_gender_percentage');
        $arr_gender = session('arr_gender');
        $staf = session('staf');
        return view('visitor.aboutDesa', compact('artikel', 'pastAgenda', 'upcomingAgenda'))
            ->with('title', 'Tentang Desa')
            ->with([
                'penduduk' => $penduduk,
                'total_penduduk' => $total_penduduk,
                'total_gender' => $total_gender,
                'total_gender_percentage' => $total_gender_percentage,
                'arr_gender' => $arr_gender,
                'staf' => $staf,
            ]);
    }

    public function demografiDesa()
    {
        $upcomingAgenda = session('upcomingAgenda');
        $pastAgenda = session('pastAgenda');
        $artikel = session('artikel');
        $penduduk = session('penduduk');
        $total_penduduk = session('total_penduduk');
        $total_gender = session('total_gender');
        $total_gender_percentage = session('total_gender_percentage');
        $arr_gender = session('arr_gender');
        $staf = session('staf');
        return view('visitor.demografiDesa', compact('artikel', 'pastAgenda', 'upcomingAgenda'))
            ->with('title', 'Demografi Desa')
            ->with([
                'penduduk' => $penduduk,
                'total_penduduk' => $total_penduduk,
                'total_gender' => $total_gender,
                'total_gender_percentage' => $total_gender_percentage,
                'arr_gender' => $arr_gender,
                'staf' => $staf,
            ]);
    }

    public function geografisDesa()
    {
        $upcomingAgenda = session('upcomingAgenda');
        $pastAgenda = session('pastAgenda');
        $artikel = session('artikel');
        $penduduk = session('penduduk');
        $total_penduduk = session('total_penduduk');
        $total_gender = session('total_gender');
        $total_gender_percentage = session('total_gender_percentage');
        $arr_gender = session('arr_gender');
        $staf = session('staf');
        return view('visitor.geografisDesa', compact('artikel', 'pastAgenda', 'upcomingAgenda'))
            ->with('title', 'Geografis Desa')
            ->with([
                'penduduk' => $penduduk,
                'total_penduduk' => $total_penduduk,
                'total_gender' => $total_gender,
                'total_gender_percentage' => $total_gender_percentage,
                'arr_gender' => $arr_gender,
                'staf' => $staf,
            ]);
    }

    public function strukturOrganisasi()
    {
        $upcomingAgenda = session('upcomingAgenda');
        $pastAgenda = session('pastAgenda');
        $artikel = session('artikel');
        $penduduk = session('penduduk');
        $total_penduduk = session('total_penduduk');
        $total_gender = session('total_gender');
        $total_gender_percentage = session('total_gender_percentage');
        $arr_gender = session('arr_gender');
        $staf = session('staf');
        return view('visitor.strukturOrganisasi', compact('artikel', 'pastAgenda', 'upcomingAgenda'))
            ->with('title', 'Struktur Organisasi')
            ->with([
                'staf' => Staf::all(),
                'penduduk' => $penduduk,
                'total_penduduk' => $total_penduduk,
                'total_gender' => $total_gender,
                'total_gender_percentage' => $total_gender_percentage,
                'arr_gender' => $arr_gender,
                'staf' => $staf,
            ]);
    }

    public function perangkatDesa()
    {
        $upcomingAgenda = session('upcomingAgenda');
        $pastAgenda = session('pastAgenda');
        $artikel = session('artikel');
        $penduduk = session('penduduk');
        $total_penduduk = session('total_penduduk');
        $total_gender = session('total_gender');
        $total_gender_percentage = session('total_gender_percentage');
        $arr_gender = session('arr_gender');
        $staf = session('staf');
        return view('visitor.perangkatDesa', compact('artikel', 'pastAgenda', 'upcomingAgenda'))
            ->with('title', 'Perangkat Desa')
            ->with([
                'staf' => Staf::all(),
                'penduduk' => $penduduk,
                'total_penduduk' => $total_penduduk,
                'total_gender' => $total_gender,
                'total_gender_percentage' => $total_gender_percentage,
                'arr_gender' => $arr_gender,
                'staf' => $staf,
            ]);
    }
}
