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
    public function kependudukan(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort_field', 'nik'); // Default sorting field
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        $query = Penduduk::select(
            'nama',
            'nik',
            'jenis_kelamin',
            'telepon',
            'penduduk_tetap'
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
            'kk' => Keluarga::all(),
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
            'nik' => 'required|unique:penduduk|numeric|digits:16',
            'no_kk' => 'required',
            'id_hubungan_kk' => 'nullable',
            // 'jenis_kelamin' => 'nullable', // dikomen karena udah dibikin defaultnyaa
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'id_agama' => 'nullable',
            'id_pendidikan_terakhir' => 'nullable',
            'id_pekerjaan' => 'nullable',
            'id_status_perkawinan' => 'nullable',
            'id_kewarganegaraan' => 'nullable',
            'nik_ayah' => 'required|numeric|digits:16',
            'nik_ibu' => 'required|numeric|digits:16',
            'id_penduduk_tetap' => 'nullable',
            'alamat' => 'nullable',
            'telepon' => 'nullable',
            // 'status' => 'nullable',
        ]);

        $validatedData['nama'] = strtoupper($validatedData['nama']);
        $validatedData['tempat_lahir'] = strtoupper($validatedData['tempat_lahir']);
        $validatedData['alamat'] = strtoupper($validatedData['alamat']);

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
            'telepon' => 'nullable',
            'status' => 'nullable',
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
