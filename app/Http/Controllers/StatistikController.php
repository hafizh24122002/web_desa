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

    // public function pendudukNew()
    // {
    //     return view('staf.penduduk.pendudukNew', [
    //         'title' => 'Tambah Penduduk Baru',
    //         'agama' => Agama::all(),
    //         'hubungan_kk' => HubunganKK::all(),
    //         // 'kesehatan' => Kesehatan::all(),
    //         'kewarganegaraan' => Kewarganegaraan::all(),
    //         'pekerjaan' => Pekerjaan::all(),
    //         'pendidikan_saat_ini' => PendidikanSaatIni::all(),
    //         'pendidikan_terakhir' => PendidikanTerakhir::all(),
    //         'status_perkawinan' => StatusPerkawinan::all(),
    //     ]);
    // }

    // public function pendudukNewSubmit(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'nama' => 'required',
    //         'nik' => 'required|unique:penduduk',
    //         'kk' => 'nullable',
    //         'id_hubungan_kk' => 'nullable',
    //         'jenis_kelamin' => 'nullable',
    //         'tempat_lahir' => 'nullable',
    //         'tanggal_lahir' => 'nullable',
    //         'id_agama' => 'nullable',
    //         'id_pendidikan_terakhir' => 'nullable',
    //         'id_pekerjaan' => 'nullable',
    //         'id_status_perkawinan' => 'nullable',
    //         'id_kewarganegaraan' => 'nullable',
    //         'nik_ayah' => 'nullable',
    //         'nik_ibu' => 'nullable',
    //         'id_penduduk_tetap' => 'nullable',
    //         'alamat' => 'nullable',
    //         'telepon' => 'nullable',
    //         'status' => 'nullable',
    //     ]);

    //     Penduduk::create($validatedData);

    //     return redirect('/staf/kependudukan/penduduk')->with('success', 'Data penduduk berhasil ditambahkan!');
    // }

    // public function pendudukEdit(Penduduk $penduduk)
    // {
    //     return view('staf.penduduk.pendudukEdit', [
    //         'title' => 'Edit Data Penduduk',
    //         'penduduk' => $penduduk,
    //         'agama' => Agama::all(),
    //         'hubungan_kk' => HubunganKK::all(),
    //         // 'kesehatan' => Kesehatan::all(),
    //         'kewarganegaraan' => Kewarganegaraan::all(),
    //         'pekerjaan' => Pekerjaan::all(),
    //         'pendidikan_saat_ini' => PendidikanSaatIni::all(),
    //         'pendidikan_terakhir' => PendidikanTerakhir::all(),
    //         'status_perkawinan' => StatusPerkawinan::all(),
    //     ]);
    // }

    // public function pendudukEditSubmit(Request $request, Penduduk $penduduk)
    // {
    //     $validatedData = $request->validate([
    //         'nama' => 'required',
    //         'nik' => 'required|unique:penduduk,nik,'.$penduduk->id,
    //         'kk' => 'nullable',
    //         'id_hubungan_kk' => 'nullable',
    //         'jenis_kelamin' => 'nullable',
    //         'tempat_lahir' => 'nullable',
    //         'tanggal_lahir' => 'nullable',
    //         'id_agama' => 'nullable',
    //         'id_pendidikan_terakhir' => 'nullable',
    //         'id_pekerjaan' => 'nullable',
    //         'id_status_perkawinan' => 'nullable',
    //         'id_kewarganegaraan' => 'nullable',
    //         'nik_ayah' => 'nullable',
    //         'nik_ibu' => 'nullable',
    //         'id_penduduk_tetap' => 'nullable',
    //         'alamat' => 'nullable',
    //         'telepon' => 'nullable',
    //         'status' => 'nullable',
    //     ]);

    //     Penduduk::firstWhere('nik', $penduduk->nik)->update($validatedData);

    //     return redirect('/staf/kependudukan/penduduk')->with('success', 'Data penduduk berhasil diubah!');
    // }

    // public function pendudukDelete(Penduduk $penduduk)
    // {
    //     $data = Penduduk::firstWhere('nik', $penduduk->nik);

    //     Penduduk::destroy($data->id);

    //     return redirect('/staf/kependudukan/penduduk')->with('success', 'Data penduduk berhasil dihapus!');
    // }
}
