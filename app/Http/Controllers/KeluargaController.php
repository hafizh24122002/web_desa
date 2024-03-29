<?php

namespace App\Http\Controllers;


// use Illuminate\Support\Facades\Validator;

use App\Models\HelperPendudukKeluarga;
use App\Models\HubunganKK;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\Penduduk;
use App\Models\KelasSosial;

class KeluargaController extends Controller
{
    public function keluarga()
    {
        $keluarga = HelperPendudukKeluarga::leftJoin('keluarga', 'helper_penduduk_keluarga.id', '=', 'keluarga.id_helper_penduduk_keluarga')
            ->leftJoin('penduduk as kepala_penduduk', 'kepala_penduduk.nik', '=', 'helper_penduduk_keluarga.nik_kepala')
            ->leftJoin('penduduk', 'penduduk.id_helper_penduduk_keluarga', '=', 'helper_penduduk_keluarga.id')
            ->select(
                'helper_penduduk_keluarga.no_kk',
                'helper_penduduk_keluarga.nik_kepala',
                'kepala_penduduk.nama as nama_kepala_keluarga',
                DB::raw('COUNT(DISTINCT penduduk.id) as jumlah_anggota'),
                'keluarga.alamat',
                'keluarga.tgl_daftar',
                'keluarga.tgl_cetak_kk'
            )
            ->groupBy('helper_penduduk_keluarga.no_kk', 'helper_penduduk_keluarga.nik_kepala', 'kepala_penduduk.nama', 'keluarga.alamat', 'keluarga.tgl_daftar', 'keluarga.tgl_cetak_kk')
            ->paginate(10);

        return view('staf.penduduk.keluarga', [
            'title' => 'Keluarga',
            'keluarga' => $keluarga,
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
            'nik_kepala' => Penduduk::all(),
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
                Rule::exists('penduduk', 'nik')->where(function ($query) use ($helperPendudukKeluarga) {
                    $query->where(function ($subquery) use ($helperPendudukKeluarga) {
                        $subquery->whereNull('id_helper_penduduk_keluarga')
                            ->orWhere('id_helper_penduduk_keluarga', $helperPendudukKeluarga->id);
                    });
                }),
            ],
        ]);

        // Validasi untuk tabel keluarga
        $validatedSpecificData = $request->validate([
            'tgl_cetak_kk' => 'nullable',
            'id_kelas_sosial' => 'nullable',
            'alamat' => 'nullable',
            'id_dusun' => 'nullable',
            'id_rt' => 'nullable',
        ]);

        // Temukan penduduk lama berdasarkan nik lama
        $oldPenduduk = Penduduk::where('nik', $helperPendudukKeluarga->nik_kepala)->first();

        // Update data di tabel helper_penduduk_keluarga
        $helperPendudukKeluarga->update($validatedCommonData);

        if (isset($validatedSpecificData['alamat'])) {
            $validatedSpecificData['alamat'] = strtoupper($validatedSpecificData['alamat']);
        }

        // Update data di tabel keluarga
        Keluarga::where('id_helper_penduduk_keluarga', $helperPendudukKeluarga->id)
            ->update($validatedSpecificData);

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

    public function keluargaDelete(HelperPendudukKeluarga $helperPendudukKeluarga)
    {
        // Perbarui id_helper_penduduk_keluarga di Penduduk
        Penduduk::where('id_helper_penduduk_keluarga', $helperPendudukKeluarga->id)
            ->update(['id_helper_penduduk_keluarga' => null]);

        // Ambil data keluarga yang sesuai dengan id_helper_penduduk_keluarga yang akan dihapus
        $keluarga = Keluarga::where('id_helper_penduduk_keluarga', $helperPendudukKeluarga->id)->first();

        // Hapus data di tabel keluarga
        if ($keluarga) {
            $keluarga->delete();
        }

        // Hapus data di tabel helper_penduduk_keluarga
        $helperPendudukKeluarga->delete();

        return redirect('/staf/kependudukan/keluarga')->with('success', 'Data keluarga berhasil dihapus!');
    }

    public function daftarKeluarga(HelperPendudukKeluarga $helperPendudukKeluarga)
    {
        // Retrieve the related Penduduk records and paginate them
        $pendudukDalamKeluarga = $helperPendudukKeluarga->penduduk()->paginate(10);

        return view('staf.penduduk.daftarKeluarga', [
            'title' => 'Daftar Anggota Keluarga',
            'keluarga' => $helperPendudukKeluarga,
            'pendudukDalamKeluarga' => $pendudukDalamKeluarga,
            'kelas_sosial' => KelasSosial::all(),
        ]);
    }

    public function daftarKeluargaNew(HelperPendudukKeluarga $helperPendudukKeluarga)
    {
        $pendudukDalamKeluarga = $helperPendudukKeluarga->penduduk()->paginate(10);

        return view('staf.penduduk.daftarKeluargaNew', [
            'title' => 'Tambah Anggota Keluarga',
            'keluarga' => $helperPendudukKeluarga,
            'anggota' => Penduduk::all(),
            'pendudukDalamKeluarga' => $pendudukDalamKeluarga,
            'hubungan_kk' => HubunganKK::all(),
        ]);
    }

    public function daftarKeluargaNewSubmit(Request $request, HelperPendudukKeluarga $helperPendudukKeluarga)
    {
        $validatedData = $request->validate([
            'no_kk' => 'required|unique:helper_penduduk_keluarga,no_kk,' . $helperPendudukKeluarga->id,
            'nik_kepala' => [
                'required',
                Rule::exists('penduduk', 'nik')->where(function ($query) {
                    $query->whereNull('id_helper_penduduk_keluarga');
                }),
            ],
        ]);
    }

    public function hubunganKeluargaEdit(Penduduk $penduduk)
    {
        return view('staf.penduduk.hubunganKeluargaEdit', [
            'title' => 'Ubah Hubungan Keluarga',
            'hubungan_kk' => HubunganKK::all(),
            'penduduk' => Penduduk::firstWhere('nik', $penduduk->nik),
        ]);
    }

    public function hubunganKeluargaEditSubmit(Request $request)
    {}

    public function daftarKeluargaDelete(){}

}
