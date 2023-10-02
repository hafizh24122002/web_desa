<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agama;
use App\Models\GolonganDarah;
use App\Models\HubunganKK;
use App\Models\JenisKelamin;
use App\Models\Keluarga;
// use App\Models\Kesehatan;
use App\Models\Kewarganegaraan;
use App\Models\Pekerjaan;
use App\Models\PendidikanSaatIni;
use App\Models\PendidikanTerakhir;
use App\Models\Penduduk;
use App\Models\PendudukStatus;
use App\Models\Rt;
use App\Models\StatusPerkawinan;

class KependudukanController extends Controller
{
    public function kependudukan(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort_field', 'nik'); // Default sorting field
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        $query = Penduduk::select(
            'nama',
            'nik',
            'id_jenis_kelamin',
            'telepon',
            'id_penduduk_status'
        );

        if ($search) {
            $query->where('nama', 'LIKE', '%' . $search . '%')
                ->orWhere('nik', 'LIKE', '%' . $search . '%');
        }

        $query->orderBy($sortField, $sortOrder);

        $penduduk = $query->paginate(10);

        if ($request->ajax()) {
            return view('partials.pendudukTable', ['penduduk' => $penduduk])->render();
        }

        return view('staf.penduduk.kependudukan', [
            'title' => 'Kependudukan',
            'penduduk' => $penduduk,
            'search' => $search,
            'sortField' => $sortField,
            'sortOrder' => $sortOrder,
        ]);
    }

    public function pendudukNew()
    {
        return view('staf.penduduk.pendudukNew', [
            'title' => 'Tambah Penduduk Baru',
            'agama' => Agama::all(),
            // 'kk' => Keluarga::all(),
            'hubungan_kk' => HubunganKK::all(),
            'jenis_kelamin' => JenisKelamin::all(),
            // 'kesehatan' => Kesehatan::all(),
            'kewarganegaraan' => Kewarganegaraan::all(),
            'pekerjaan' => Pekerjaan::all(),
            'pendidikan_saat_ini' => PendidikanSaatIni::all(),
            'pendidikan_terakhir' => PendidikanTerakhir::all(),
            'status_perkawinan' => StatusPerkawinan::all(),
            'golongan_darah' => GolonganDarah::all(),
            'penduduk_status' => PendudukStatus::all(),
        ]);
    }

    public function pendudukNewSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:penduduk|numeric|digits:16',
            'id_hubungan_kk' => 'nullable',
            'id_jenis_kelamin' => 'nullable', // dikomen karena udah dibikin defaultnyaa
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'id_agama' => 'required',
            'id_pendidikan_terakhir' => 'nullable',
            'id_pendidikan_saat_ini' => 'nullable',
            'id_pekerjaan' => 'nullable',
            'id_status_perkawinan' => 'nullable',
            'id_kewarganegaraan' => 'nullable',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'id_penduduk_status' => 'nullable',
            'telepon' => 'nullable',
        ]);

        $validatedData['nama'] = strtoupper($validatedData['nama']);
        $validatedData['tempat_lahir'] = strtoupper($validatedData['tempat_lahir']);

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
            'jenis_kelamin' => JenisKelamin::all(),
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
            'nik' => 'required',
            'id_hubungan_kk' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'id_agama' => 'required',
            'id_pendidikan_terakhir' => 'required',
            'id_pendidikan_saat_ini' => 'required',
            'id_pekerjaan' => 'required',
            'id_status_perkawinan' => 'required',
            'id_kewarganegaraan' => 'required',
            'telepon' => 'required',
            'status' => 'required',
        ]);

        $validatedData['nama'] = strtoupper($validatedData['nama']);
        $validatedData['tempat_lahir'] = strtoupper($validatedData['tempat_lahir']);

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
