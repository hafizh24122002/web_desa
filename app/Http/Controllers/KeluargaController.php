<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\KelasSosial;

class KeluargaController extends Controller
{
    public function keluarga()
    {
        return view('staf.penduduk.keluarga', [
            'title' => 'Keluarga',
            'keluarga' => Keluarga::join(
                'kelas_sosial', 'keluarga.id_kelas_sosial', '=', 'kelas_sosial.id'
            )->select(
                'keluarga.*',
                'kelas_sosial.nama',
            )->paginate(10)
        ]);
    }

    public function keluargaNew()
    {
        return view('staf.penduduk.keluargaNew', [
            'title' => 'Tambah Keluarga Baru',
            'kelas_sosial' => KelasSosial::all(),
        ]);
    }

    public function keluargaNewSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'no_kk' => 'required|unique:keluarga',
            'nik_kepala' => 'nullable',
            'id_kelas_sosial' => 'nullable',
            'alamat' => 'nullable',
            'tgl_dikeluarkan' => 'nullable',
        ]);

        Keluarga::create($validatedData);
        
        return redirect('/staf/kependudukan/keluarga')->with('success', 'Data keluarga berhasil ditambahkan!');
    }

    public function keluargaEdit(Keluarga $keluarga)
    {
        return view('staf.penduduk.keluargaEdit', [
            'title' => 'Edit Data Keluarga',
            'keluarga' => $keluarga,
            'kelas_sosial' => KelasSosial::all(),
        ]);
    }

    public function keluargaEditSubmit(Request $request, Keluarga $keluarga)
    {
        $validatedData = $request->validate([
            'no_kk' => 'required|unique:keluarga,no_kk,'.$keluarga->id,
            'nik_kepala' => 'nullable',
            'id_kelas_sosial' => 'nullable',
            'alamat' => 'nullable',
            'tgl_dikeluarkan' => 'nullable',
        ]);

        Keluarga::firstWhere('no_kk', $keluarga->no_kk)->update($validatedData);

        return redirect('/staf/kependudukan/keluarga')->with('success', 'Data keluarga berhasil diubah!');
    }

    public function keluargaDelete(Keluarga $keluarga)
    {
        $data = Keluarga::firstWhere('no_kk', $keluarga->no_kk);

        Keluarga::destroy($data->id);

        return redirect('/staf/kependudukan/penduduk')->with('success', 'Data keluarga berhasil dihapus!');
    }
}
