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
                    'id_jenis_kelamin',
                    'id_status_perkawinan',
                    'tempat_lahir',
                    'tanggal_lahir',
                    'id_agama',
                    'id_pendidikan_terakhir',
                    'id_pekerjaan',
                    'id_bahasa',
                    'id_kewarganegaraan',
                    'id_dusun',
                    'id_rt',
                    'alamat_sekarang',
                    'id_hubungan_kk',
                    'nik',
                    'id_helper_penduduk_keluarga',
                    'ket',
                    'tanggal_lapor')
                ->where('id_status_dasar', 1)
                ->where('penduduk_tetap', 1)
                // ->orderBy('nama', 'asc')
                ->paginate(10)
        ]);
    }

    public function getData($type)
    {
        $earliestYear =  date('Y', strtotime(LogPenduduk::min('tanggal_lapor'))) ?? date('Y');

        $nama = request()->input('nama') ?? '';
        $month = request()->input('month');
        $year = request()->input('year');
        $paginate = request()->input('paginate');

        $indukKependudukanQuery = Penduduk::leftJoin(
                'log_penduduk',
                'penduduk.id',
                '=',
                'log_penduduk.id_penduduk'
            )->select(
                'nama',
                'id_jenis_kelamin',
                'id_status_perkawinan',
                'tempat_lahir',
                'tanggal_lahir',
                'id_agama',
                'id_pendidikan_terakhir',
                'id_pekerjaan',
                'id_bahasa',
                'id_kewarganegaraan',
                'id_dusun',
                'id_rt',
                'alamat_sekarang',
                'id_hubungan_kk',
                'nik',
                'id_helper_penduduk_keluarga',
                'ket',
                'tanggal_lapor'
            )->where('penduduk_tetap', 1)
                ->where('id_status_dasar', 1)
                ->where('nama', 'LIKE', '%' . $nama . '%')
                ->whereMonth('tanggal_lapor', '<=', $month)
                ->whereYear('tanggal_lapor', '<=', $year);


        $mutasiPendudukDesaQuery = LogPenduduk::whereIn('id_peristiwa', [2,3,5])
            ->whereMonth('tanggal_lapor', '<=', $month)
            ->whereYear('tanggal_lapor', '<=', $year)
            ->whereHas('penduduk', function ($query) use ($nama) {
                $query->where('penduduk_tetap', 1)
                    ->where('nama', 'LIKE', '%'.$nama.'%');
            })
            ->with(['penduduk' => function ($query) use ($nama) {
                $query->select(
                    'id',
                    'nama',
                    'tempat_lahir',
                    'tanggal_lahir',
                    'id_jenis_kelamin',
                    'id_kewarganegaraan',
                    'alamat_sebelumnya',
                );
            }]);

        $pendudukSementaraQuery = LogPenduduk::where('id_peristiwa', 5)
            ->whereMonth('tanggal_lapor', '<=', $month)
            ->whereYear('tanggal_lapor', '<=', $year)
            ->whereHas('penduduk', function ($query) use ($nama) {
                $query->where('penduduk_tetap', 0)
                    ->where('nama', 'LIKE', '%'.$nama.'%');
            })
            ->with(['penduduk' => function ($query) use ($nama) {
                $query->select(
                    'id',
                    'nama',
                    'id_jenis_kelamin',
                    'nik',
                    'tempat_lahir',
                    'tanggal_lahir',
                    'id_pekerjaan',
                    'id_kewarganegaraan',
                    'suku',
                    'alamat_sebelumnya',
                ); 
            }, 'tamu' => function ($query) {
                $query->select(
                    'id',
                    'id_log_penduduk_pergi'
                );
            }]);

        $ktpKkQuery = Penduduk::join(
                'log_penduduk',
                'penduduk.id',
                '=',
                'log_penduduk.id_penduduk'
            )->select(
                'id_helper_penduduk_keluarga',
                'nama',
                'nik',
                'id_jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'id_golongan_darah',
                'id_agama',
                'id_pendidikan_terakhir',
                'id_pekerjaan',
                'alamat_sekarang',
                'id_status_perkawinan',
                'tempat_cetak_ktp',
                'tanggal_cetak_ktp',
                'id_hubungan_kk',
                'id_kewarganegaraan',
                'nama_ayah',
                'nama_ibu',
                'tanggal_lapor',
                'ket'
            )->where('penduduk_tetap', 1)
            ->where('id_status_dasar', 1)
            ->whereHas('logPenduduk', function ($query) use ($month, $year) {
                $query->select('tanggal_lapor')
                    ->whereMonth('tanggal_lapor', '<=', $month)
                    ->whereYear('tanggal_lapor', '<=', $year);
            })
            ->where('nama', 'LIKE', '%'.$nama.'%');

        switch ($type) {
            case 'indukKependudukan':
                $view = view('staf.bukuadministrasidesa.partials.' . $type, [
                    'earliestYear' => $earliestYear,
                    'penduduk' => $indukKependudukanQuery
                        ->paginate(10)
                ]);
                return $paginate === 'true' ? $view : $indukKependudukanQuery->get();
            case 'mutasiPendudukDesa':
                $view = view('staf.bukuadministrasidesa.partials.'.$type, [
                    'earliestYear' => $earliestYear,
                    'logPenduduk' =>  $mutasiPendudukDesaQuery->paginate(10),
                ]);
                return $paginate === 'true' ? $view : $mutasiPendudukDesaQuery->get();
            case 'rekapitulasiJumlahPenduduk':
                return view('staf.bukuadministrasidesa.partials.'.$type, [
                    'earliestYear' => $earliestYear,
                    'penduduk' => Penduduk::all(),  //TODO
                    'dusun' => WilayahDusun::paginate(10),
                ]);
            case 'pendudukSementara':
                $view = view('staf.bukuadministrasidesa.partials.'.$type, [
                    'earliestYear' => $earliestYear,
                    'logPenduduk' => $pendudukSementaraQuery->paginate(10),
                ]);
                return $paginate === 'true' ? $view : $pendudukSementaraQuery->get();
            case 'ktpKk':
                $view = view('staf.bukuadministrasidesa.partials.'.$type, [
                    'earliestYear' => $earliestYear,
                    'penduduk' => $ktpKkQuery->paginate(10),
                ]);
                return $paginate === 'true' ? $view : $ktpKkQuery->get();
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
