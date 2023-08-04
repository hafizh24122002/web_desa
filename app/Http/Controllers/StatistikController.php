<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agama;
use App\Models\HubunganKK;
use App\Models\KelasSosial;
use App\Models\Keluarga;
// use App\Models\Kesehatan;
use App\Models\Kewarganegaraan;
use App\Models\Pekerjaan;
use App\Models\PendidikanSaatIni;
use App\Models\PendidikanTerakhir;
use App\Models\Penduduk;
use App\Models\Rt;
use App\Models\StatusPerkawinan;

class StatistikController extends Controller
{
    public function statistik()
    {
        $totalRowPenduduk = Penduduk::count();
        $totalRowPekerjaan = Pekerjaan::count();
        $totalRowPendidikanTerakhir = PendidikanTerakhir::count();
        $totalRowAgama = Agama::count();
        $totalRowKelasSosial = KelasSosial::count();
        
        return view('staf.statistik.statistikKependudukan', [
            'title' => 'Statistik Kependudukan',
            'penduduk' => Penduduk::select(
                'nama',
                'jenis_kelamin',
                'id_agama',
                'id_pekerjaan',
                'id_pendidikan_terakhir',
                'penduduk_tetap',
            )->get(),
            'keluarga' => Keluarga::select(
                'id_kelas_sosial'
            )->get(),
            'pendidikan_terakhir' => PendidikanTerakhir::all(),
            'agama' => Agama::all(),
            'pekerjaan' => Pekerjaan::all(),
            'kelas_sosial' => KelasSosial::all(),
            'totalRowAgama' => $totalRowAgama,
            'totalRowPekerjaan' => $totalRowPekerjaan,
            'totalRowPendidikanTerakhir' => $totalRowPendidikanTerakhir,
            'totalRowKelasSosial' => $totalRowKelasSosial,
            'totalRowPenduduk' => $totalRowPenduduk,
        ]);
    }
}
