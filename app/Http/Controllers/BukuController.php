<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendudukExport;
use App\Models\Penduduk;
use App\Models\ArsipSurat;


class BukuController extends Controller
{
    public function bukuIndukKependudukan()
    {
        return view('staf.bukuadministrasidesa.administrasiPenduduk', [
            'title' => 'Buku Induk Penduduk',
            'penduduk' => Penduduk::select(
                'nama',
                'nik',
                'tempat_lahir',
                'tanggal_lahir',
                'jenis_kelamin',
                'status',
                'id_agama',
                'id_pendidikan_terakhir',
                'id_pekerjaan',
                'nik_ayah',
                'nik_ibu'
            )->paginate(10)
        ]);
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
