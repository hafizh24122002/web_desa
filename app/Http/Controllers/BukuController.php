<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendudukExport;
use App\Models\Penduduk;
use App\Models\LogPenduduk;
use App\Models\ArsipSurat;
use App\Models\WilayahDusun;

class BukuController extends Controller
{
    public function bukuIndukKependudukan()
    {
        return view('staf.bukuadministrasidesa.administrasiPenduduk', [
            'title' => 'Buku Induk Penduduk',
            'earliestYear' => date('Y', strtotime(LogPenduduk::min('tanggal_lapor'))) ?? date('Y'),
            'penduduk' => Penduduk::join(
                    'log_penduduk',
                    'penduduk.id',
                    '=',
                    'log_penduduk.id_penduduk')
                ->select(
                    'nama',
                    'nik',
                    'tempat_lahir',
                    'tanggal_lahir',
                    'id_jenis_kelamin',
                    'id_status_dasar',
                    'id_agama',
                    'id_pendidikan_terakhir',
                    'id_pekerjaan',
                    'nik_ayah',
                    'nama_ayah',
                    'nik_ibu',
                    'nama_ibu', 
                    'tanggal_lapor')
                ->where('penduduk_tetap', 1)
                // ->orderBy('nama', 'asc')
                ->paginate(10)
        ]);
    }

    public function getData($type)
    {
        $earliestYear =  date('Y', strtotime(LogPenduduk::min('tanggal_lapor'))) ?? date('Y');

        $nama = request()->input('nama');
        $month = request()->input('month');
        $year = request()->input('year');

        switch ($type) {
            case 'indukKependudukan':
                return view('staf.bukuadministrasidesa.partials.'.$type, [
                    'earliestYear' => $earliestYear,
                    'penduduk' => Penduduk::join(
                            'log_penduduk',
                            'penduduk.id',
                            '=',
                            'log_penduduk.id_penduduk')
                        ->select(
                            'nama',
                            'nik',
                            'tempat_lahir',
                            'tanggal_lahir',
                            'id_jenis_kelamin',
                            'id_status_dasar',
                            'id_agama',
                            'id_pendidikan_terakhir',
                            'id_pekerjaan',
                            'nik_ayah',
                            'nama_ayah',
                            'nik_ibu',
                            'nama_ibu', 
                            'tanggal_lapor')
                        ->where('penduduk_tetap', 1)
                        ->where('nama', 'LIKE', '%'.$nama.'%')
                        ->whereMonth('tanggal_lapor', '<=', $month)
                        ->whereYear('tanggal_lapor', '<=', $year)
                        // ->orderBy('nama', 'asc')
                        ->paginate(10)
                ]);
            case 'mutasiPendudukDesa':
                return view('staf.bukuadministrasidesa.partials.'.$type, [
                    'earliestYear' => $earliestYear,
                    'logPenduduk' => LogPenduduk::where('id_peristiwa', 2)
                                                ->where('id_peristiwa', 3)
                                                ->where('id_peristiwa', 5)
                                                ->whereMonth('tanggal_lapor', '<=', $month)
                                                ->whereYear('tanggal_lapor', '<=', $year)
                                                ->whereHas('penduduk', function ($query) use ($nama) {
                                                    $query->where('penduduk_tetap', 1)
                                                          ->where('nama', 'LIKE', '%'.$nama.'%');
                                                })
                                                ->paginate(10),
                ]);
            case 'rekapitulasiJumlahPenduduk':
                return view('staf.bukuadministrasidesa.partials.'.$type, [
                    'earliestYear' => $earliestYear,
                    'penduduk' => Penduduk::all(),  //TODO
                    'dusun' => WilayahDusun::paginate(10),
                ]);
            case 'pendudukSementara':
                return view('staf.bukuadministrasidesa.partials.'.$type, [
                    'earliestYear' => $earliestYear,
                    'logPenduduk' => LogPenduduk::where('id_peristiwa', 5)
                                                ->whereMonth('tanggal_lapor', '<=', $month)
                                                ->whereYear('tanggal_lapor', '<=', $year)
                                                ->whereHas('penduduk', function ($query) use ($nama) {
                                                    $query->where('penduduk_tetap', 0)
                                                          ->where('nama', 'LIKE', '%'.$nama.'%');
                                                })->paginate(10),
                ]);
            case 'ktpKk':
                return view('staf.bukuadministrasidesa.partials.'.$type, [
                    'earliestYear' => $earliestYear,
                    'penduduk' => Penduduk::where('penduduk_tetap', 1)
                                          ->whereHas('logPenduduk', function ($query) use ($month, $year) {
                                              $query->select('tanggal_lapor')
                                                    ->whereMonth('tanggal_lapor', '<=', $month)
                                                    ->whereYear('tanggal_lapor', '<=', $year);
                                          })
                                          ->where('nama', 'LIKE', '%'.$nama.'%')
                                          ->paginate(10),
                ]);
        }
    }

    public function bukuAgenda()
    {
        return view('staf.bukuadministrasidesa.administrasiUmum', [
            'title' => 'Buku Agenda',
            'penduduk' => ArsipSurat::join(
                'staf', 'arsip_surat.id_staf', '=', 'staf.id'
            )->join(
                'surat', 'arsip_surat.id_klasifikasi_surat', '=', 'surat.id'
            )->select(
                'arsip_surat.*',
                'staf.nama',
                'surat.kode_surat',
            )->paginate(10),
        ]);
    }

    public function export() 
    {
        return Excel::download(new PendudukExport, 'BIP.xlsx');
    }
}
