<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agama;
use App\Models\HubunganKK;
use App\Models\Keluarga;
// use App\Models\Kesehatan;
use App\Models\Kewarganegaraan;
use App\Models\Pekerjaan;
use App\Models\PendidikanSaatIni;
use App\Models\PendidikanTerakhir;
use App\Models\Penduduk;
use App\Models\Rt;
use App\Models\StatusPerkawinan;

class KependudukanController extends Controller
{
    public function kependudukan()
    {
        return view('staf.penduduk.kependudukan', [
            'title' => 'Kependudukan',
            'penduduk' => Penduduk::select(
                'nama',
                'nik',
                'jenis_kelamin',
                'telepon',
                'penduduk_tetap',
            )->paginate(10)
        ]);
    }

    public function pendudukNew()
    {
        return view('staf.penduduk.pendudukNew', [
            'title' => 'Tambah Penduduk Baru',
            'agama' => Agama::all(),
            'hubungan_kk' => HubunganKK::all(),
            // 'kesehatan' => Kesehatan::all(),
            'kewarganegaraan' => Kewarganegaraan::all(),
            'pekerjaan' => Pekerjaan::all(),
            'pendidikan_saat_ini' => PendidikanSaatIni::all(),
            'pendidikan_terakhir' => PendidikanTerakhir::all(),
            'status_perkawinan' => StatusPerkawinan::all(),
        ]);
    }

    public function pendudukNewSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:penduduk',
            'kk' => 'nullable',
            'id_hubungan_kk' => 'nullable',
            'jenis_kelamin' => 'nullable',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'id_agama' => 'nullable',
            'id_pendidikan_terakhir' => 'nullable',
            'id_pekerjaan' => 'nullable',
            'id_status_perkawinan' => 'nullable',
            'id_kewarganegaraan' => 'nullable',
            'nik_ayah' => 'required',
            'nik_ibu' => 'required',
            'id_penduduk_tetap' => 'nullable',
            'alamat' => 'nullable',
            'telepon' => 'nullable',
            'status' => 'nullable',
        ]);

        Penduduk::create($validatedData);

        return redirect('/staf/kependudukan/penduduk')->with('success', 'Data penduduk berhasil ditambahkan!');
    }

    public function pendudukEdit(Penduduk $penduduk)
    {
        return view('staf.penduduk.pendudukEdit', [
            'title' => 'Edit Data Penduduk',
            'penduduk' => $penduduk,
            'agama' => Agama::all(),
            'hubungan_kk' => HubunganKK::all(),
            // 'kesehatan' => Kesehatan::all(),
            'kewarganegaraan' => Kewarganegaraan::all(),
            'pekerjaan' => Pekerjaan::all(),
            'pendidikan_saat_ini' => PendidikanSaatIni::all(),
            'pendidikan_terakhir' => PendidikanTerakhir::all(),
            'status_perkawinan' => StatusPerkawinan::all(),
        ]);
    }

    public function pendudukEditSubmit(Request $request, Penduduk $penduduk)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:penduduk,nik,'.$penduduk->id,
            'kk' => 'nullable',
            'id_hubungan_kk' => 'nullable',
            'jenis_kelamin' => 'nullable',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'id_agama' => 'nullable',
            'id_pendidikan_terakhir' => 'nullable',
            'id_pekerjaan' => 'nullable',
            'id_status_perkawinan' => 'nullable',
            'id_kewarganegaraan' => 'nullable',
            'nik_ayah' => 'required',
            'nik_ibu' => 'required',
            'id_penduduk_tetap' => 'nullable',
            'alamat' => 'nullable',
            'telepon' => 'nullable',
            'status' => 'nullable',
        ]);

        Penduduk::firstWhere('nik', $penduduk->nik)->update($validatedData);

        return redirect('/staf/kependudukan/penduduk')->with('success', 'Data penduduk berhasil diubah!');
    }

    public function pendudukDelete(Penduduk $penduduk)
    {
        $data = Penduduk::firstWhere('nik', $penduduk->nik);

        Penduduk::destroy($data->id);

        return redirect('/staf/kependudukan/penduduk')->with('success', 'Data penduduk berhasil dihapus!');
    }

    public function getDataPenduduk($nama)
    {
        $data = Penduduk::where('nama', '=', $nama)->first();
        
        return response()->json($data);
    }

    public function getTanggalLahir($nik)
    {
        $penduduk = Penduduk::where('nik', $nik)->firstOrFail();

        return response()->json(['tanggal_lahir' => $penduduk->tanggal_lahir]);
    }
}
