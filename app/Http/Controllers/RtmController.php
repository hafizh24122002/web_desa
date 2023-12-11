<?php

namespace App\Http\Controllers;

use App\Models\HelperPendudukKeluarga;
use App\Models\HelperPendudukRtm;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\Penduduk;
use App\Models\KelasSosial;
use App\Models\Rtm;
use App\Models\WilayahDusun;

class RtmController extends Controller
{
    public function rtm()
    {
        return view('staf.penduduk.rtm', [
            'title' => 'Rumah Tangga',
            'rtm' => HelperPendudukRtm::leftJoin('rtm', 'helper_penduduk_rtm.id', '=', 'rtm.id_helper_penduduk_rtm')
                ->leftJoin('penduduk as kepala_penduduk', 'kepala_penduduk.nik', '=', 'helper_penduduk_rtm.nik_kepala')
                ->leftJoin('helper_penduduk_keluarga', 'kepala_penduduk.id_helper_penduduk_keluarga', '=', 'helper_penduduk_keluarga.id')
                ->leftJoin('keluarga', 'helper_penduduk_keluarga.id', '=', 'keluarga.id_helper_penduduk_keluarga')
                ->select(
                    'helper_penduduk_rtm.no_rtm',
                    'helper_penduduk_rtm.nik_kepala',
                    'kepala_penduduk.nama as nama_kepala_keluarga',
                    DB::raw('COUNT(DISTINCT kepala_penduduk.id) as jumlah_anggota'),
                    'rtm.alamat',
                    'rtm.dtks',
                    'rtm.tgl_daftar',
                )
                ->groupBy('helper_penduduk_rtm.no_rtm', 'helper_penduduk_rtm.nik_kepala', 'kepala_penduduk.nama', 'rtm.alamat', 'rtm.tgl_daftar', 'rtm.dtks')
                ->paginate(10)
        ]);
    }

    public function rtmNew()
    {
        return view('staf.penduduk.rtmNew', [
            'title' => 'Tambah Rumah Tangga Baru',
            'nik_kepala' => Penduduk::all(),
            'kelas_sosial' => KelasSosial::all(),
            'id_dusun' => WilayahDusun::all(),

        ]);
    }

    public function rtmNewSubmit(Request $request)
    {
        // Validasi untuk 'no_kk' dan 'nik_kepala' di tabel helper_penduduk_krtm
        $validatedCommonData = $request->validate([
            'no_rtm' => 'required|unique:helper_penduduk_rtm',
            'nik_kepala' => [
                'required',
                Rule::exists('penduduk', 'nik')->where(function ($query) {
                    $query->whereNull('id_helper_penduduk_rtm');
                }),
            ],
        ]);

        // Menyimpan data di tabel helper_penduduk_rtm
        $helperPendudukRtm = HelperPendudukRtm::create($validatedCommonData);

        // Validasi tabel rtm
        $validatedSpecificData = $request->validate([
            'dtks' => 'nullable',
            'alamat' => 'nullable',
            'id_helper_penduduk_rtm' => 'required',
            'id_dusun' => 'nullable',
            'id_rt' => 'nullable',
            'bdt' => 'nullable',
            //'tgl_daftar' => 'nullable',
        ]);

        if (isset($validatedSpecificData['alamat'])) {
            $validatedSpecificData['alamat'] = strtoupper($validatedSpecificData['alamat']);
        }

        // Menyimpan data di tabel rtm
        $validatedSpecificData['id_helper_penduduk_rtm'] = $helperPendudukRtm->id;
        $rtm = Rtm::create($validatedSpecificData);

        // Update id_helper_penduduk_rtm di tabel penduduk
        Penduduk::where('nik', $validatedCommonData['nik_kepala'])
            ->update([
                'id_helper_penduduk_rtm' => $helperPendudukRtm->id,
                'id_rtm_hubungan' => 1, // jadikan kepala rtm
            ]);

        return redirect('/staf/kependudukan/rtm')->with('success', 'Data rumah tangga berhasil ditambahkan!');
    }

    public function rtmEdit(Keluarga $keluarga)
    {
        return view('staf.penduduk.keluargaEdit', [
            'title' => 'Edit Data Keluarga',
            'keluarga' => $keluarga,
            'kelas_sosial' => KelasSosial::all(),
        ]);
    }

    public function rtmEditSubmit(Request $request, HelperPendudukRtm $helperPendudukRtm)
    {
        // Validasi untuk 'no_rtm' dan 'nik_kepala' di tabel helper_penduduk_rtm
        $validatedCommonData = $request->validate([
            'no_rtm' => 'required|unique:helper_penduduk_rtm,no_rtm,' . $helperPendudukRtm->id,
            'nik_kepala' => [
                'required',
                Rule::exists('penduduk', 'nik')->where(function ($query) {
                    $query->whereNull('id_helper_penduduk_rtm');
                }),
            ],
        ]);

        // Validasi tabel rtm
        $validatedSpecificData = $request->validate([
            'dtks' => 'nullable',
            'alamat' => 'nullable',
            'id_dusun' => 'nullable',
            'id_rt' => 'nullable',
            'bdt' => 'nullable',
        ]);

        // Temukan penduduk lama berdasarkan nik lama
        $oldPenduduk = Penduduk::where('nik', $helperPendudukRtm->nik_kepala)->first();

        // Update data di tabel helper_penduduk_rtm
        $helperPendudukRtm->update($validatedCommonData);

        if (isset($validatedSpecificData['alamat'])) {
            $validatedSpecificData['alamat'] = strtoupper($validatedSpecificData['alamat']);
        }

        // Update data di tabel rtm
        $validatedSpecificData['id_helper_penduduk_rtm'] = $helperPendudukRtm->id;
        $helperPendudukRtm->rtm->update($validatedSpecificData);

        // Update id_helper_penduduk_rtm di tabel penduduk
        Penduduk::where('nik', $validatedCommonData['nik_kepala'])
            ->update([
                'id_helper_penduduk_rtm' => $helperPendudukRtm->id,
                'id_rtm_hubungan' => 1,  // Update id_rtm_hubungan to 1
            ]);

        // Jika nik kepala rtm diganti, set id_helper_penduduk_rtm pada penduduk lama menjadi null
        if ($oldPenduduk && $oldPenduduk->nik !== $validatedCommonData['nik_kepala']) {
            $oldPenduduk->update(['id_helper_penduduk_rtm' => null]);
        }

        return redirect('/staf/kependudukan/rtm')->with('success', 'Data rumah tangga berhasil diubah!');
    }

    public function rtmDelete(HelperPendudukRtm $helperPendudukRtm)
    {
        // Perbarui id_helper_penduduk_keluarga di Penduduk
        Penduduk::where('id_helper_penduduk_rtm', $helperPendudukRtm->id)
            ->update(['id_helper_penduduk_rtm' => null]);

        // Ambil data rtm yang sesuai dengan id_helper_penduduk_rtm yang akan dihapus
        $rtm = Rtm::where('id_helper_penduduk_rtm', $helperPendudukRtm->id)->first();

        // Hapus data di tabel keluarga
        if ($rtm) {
            $rtm->delete();
        }

        // Hapus data di tabel helper_penduduk_keluarga
        $helperPendudukRtm->delete();

        return redirect('/staf/kependudukan/rtm')->with('success', 'Data rumah tangga berhasil dihapus!');
    }

    public function daftarRtm(HelperPendudukRtm $helperPendudukRtm)
    {
        // Retrieve the related Penduduk records and paginate them
        $pendudukDalamRtm = $helperPendudukRtm->penduduk()->paginate(10);

        return view('staf.penduduk.daftarRtm', [
            'title' => 'Edit Data Keluarga',
            'rtm' => $helperPendudukRtm,
            'pendudukDalamRtm' => $pendudukDalamRtm,
            'kelas_sosial' => KelasSosial::all(),
        ]);
    }

    public function newDaftarRtmSubmit(Request $request, HelperPendudukKeluarga $helperPendudukKeluarga)
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
}
