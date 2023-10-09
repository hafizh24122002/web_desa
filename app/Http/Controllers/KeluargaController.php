<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Validator;

use App\Models\HelperPendudukKeluarga;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\Penduduk;
use App\Models\KelasSosial;

class KeluargaController extends Controller
{
    public function keluarga()
    {
        return view('staf.penduduk.keluarga', [
            'title' => 'Keluarga',
            'keluarga' => Keluarga::join(
                'kelas_sosial',
                'keluarga.id_kelas_sosial',
                '=',
                'kelas_sosial.id'
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
            'nik_kepala' => Penduduk::all(),
            'kelas_sosial' => KelasSosial::all(),
        ]);
    }

    public function keluargaNewSubmit(Request $request)
    {
        // Validasi untuk 'no_kk' dan 'nik_kepala' di tabel helper_penduduk_keluarga
        $validatedCommonData = $request->validate([
            'no_kk' => 'required|unique:helper_penduduk_keluarga',
            'nik_kepala' => [
                'required',
                Rule::exists('penduduk', 'nik')->where(function ($query) {
                    $query->whereNull('id_helper_penduduk_keluarga');
                }),
            ],
        ]);

        // Menyimpan data di tabel helper_penduduk_keluarga
        $helperPendudukKeluarga = HelperPendudukKeluarga::create($validatedCommonData);

        // Validasi untuk 'tgl_cetak_kk', 'id_kelas_sosial', dan 'alamat' di tabel keluarga
        $validatedSpecificData = $request->validate([
            'tgl_cetak_kk' => 'nullable',
            'id_kelas_sosial' => 'nullable',
            'alamat' => 'nullable',
        ]);

        if (isset($validatedSpecificData['alamat'])) {
            $validatedSpecificData['alamat'] = strtoupper($validatedSpecificData['alamat']);
        }

        // Menyimpan data di tabel keluarga
        $validatedSpecificData['id_helper_penduduk_keluarga'] = $helperPendudukKeluarga->id;
        $keluarga = Keluarga::create($validatedSpecificData);

        // Update id_helper_penduduk_keluarga di tabel penduduk
        Penduduk::where('nik', $validatedCommonData['nik_kepala'])
            ->update([
                'id_helper_penduduk_keluarga' => $helperPendudukKeluarga->id,
                'id_hubungan_kk' => 1,  // Update id_hubungan_kk to 1
            ]);

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

    public function keluargaEditSubmit(Request $request, HelperPendudukKeluarga $helperPendudukKeluarga)
    {
        // Validasi untuk 'no_kk' dan 'nik_kepala' di tabel helper_penduduk_keluarga
        $validatedCommonData = $request->validate([
            'no_kk' => 'required|unique:helper_penduduk_keluarga,no_kk,' . $helperPendudukKeluarga->id,
            'nik_kepala' => [
                'required',
                Rule::exists('penduduk', 'nik')->where(function ($query) {
                    $query->whereNull('id_helper_penduduk_keluarga');
                }),
            ],
        ]);

        // Validasi untuk 'tgl_cetak_kk', 'id_kelas_sosial', dan 'alamat' di tabel keluarga
        $validatedSpecificData = $request->validate([
            'tgl_cetak_kk' => 'nullable',
            'id_kelas_sosial' => 'nullable',
            'alamat' => 'nullable',
        ]);

        // Temukan penduduk lama berdasarkan nik lama
        $oldPenduduk = Penduduk::where('nik', $helperPendudukKeluarga->nik_kepala)->first();

        // Update data di tabel helper_penduduk_keluarga
        $helperPendudukKeluarga->update($validatedCommonData);

        if (isset($validatedSpecificData['alamat'])) {
            $validatedSpecificData['alamat'] = strtoupper($validatedSpecificData['alamat']);
        }

        // Update data di tabel keluarga
        $validatedSpecificData['id_helper_penduduk_keluarga'] = $helperPendudukKeluarga->id;
        $helperPendudukKeluarga->keluarga->update($validatedSpecificData);

        // Update id_helper_penduduk_keluarga di tabel penduduk
        Penduduk::where('nik', $validatedCommonData['nik_kepala'])
            ->update([
                'id_helper_penduduk_keluarga' => $helperPendudukKeluarga->id,
                'id_hubungan_kk' => 1,  // Update id_hubungan_kk to 1
            ]);

        // Jika nik kepala keluarga diganti, set id_helper_penduduk_keluarga pada penduduk lama menjadi null
        if ($oldPenduduk && $oldPenduduk->nik !== $validatedCommonData['nik_kepala']) {
            $oldPenduduk->update(['id_helper_penduduk_keluarga' => null]);
        }

        return redirect('/staf/kependudukan/keluarga')->with('success', 'Data keluarga berhasil diubah!');
    }

    public function keluargaDelete(Keluarga $keluarga)
    {
        $data = Keluarga::firstWhere('no_kk', $keluarga->no_kk);

        Keluarga::destroy($data->id);

        return redirect('/staf/kependudukan/penduduk')->with('success', 'Data keluarga berhasil dihapus!');
    }

    public function daftarKeluarga(Keluarga $keluarga)
    {
        return view('staf.penduduk.daftarKeluarga', [
            'title' => 'Edit Data Keluarga',
            'keluarga' => $keluarga,
            'kelas_sosial' => KelasSosial::all(),
        ]);
    }
}
