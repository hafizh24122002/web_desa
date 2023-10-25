<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agama;
use App\Models\Asuransi;
use App\Models\Cacat;
use App\Models\CaraKb;
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
use App\Models\SakitMenahun;
use App\Models\StatusPerkawinan;
use App\Models\HelperPendudukKeluarga;
use App\Models\WilayahDusun;
use App\Models\WilayahRt;

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
            // 'kk' => Keluarga::all(),
            'hubungan_kk' => HubunganKK::all(),
            'jenis_kelamin' => JenisKelamin::all(),
            // 'kesehatan' => Kesehatan::all(),
            'kewarganegaraan' => Kewarganegaraan::all(),
            'pekerjaan' => Pekerjaan::all(),
            'pendidikan_saat_ini' => PendidikanSaatIni::all(),
            'pendidikan_terakhir' => PendidikanTerakhir::all(),
            'wilayah_dusun' => WilayahDusun::all(),
            'wilayah_rt' => WilayahRt::all(),
            'status_perkawinan' => StatusPerkawinan::all(),
            'golongan_darah' => GolonganDarah::all(),
            'cacat' => Cacat::all(),
            'sakit_menahun' => SakitMenahun::all(),
            'cara_kb' => CaraKb::all(),
            'asuransi' => Asuransi::all(),
            // 'penduduk_status' => PendudukStatus::all(),
        ]);
    }

    public function pendudukNewSubmit(Request $request)
    {
        $validatedData = $request->validate([
            // DATA DIRI
            'nama' => 'required',
            'nik' => 'required|unique:penduduk|numeric|digits:16',
            // status kepemilikan identitas
            // 'ktp_el' => 'nullable',
            // 'status_rekam' => 'nullable',
            // 'tag_id_card' => 'nullable',
            'no_kk_sebelumnya' => 'nullable',
            'id_hubungan_kk' => 'required',
            'id_jenis_kelamin' => 'required',
            'id_agama' => 'required',
            'penduduk_tetap' => 'required',
            // DATA KELAHIRAN
            'akta_lahir' => 'nullable',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'waktu_lahir' => 'nullable',
            'tempat_dilahirkan' => 'nullable',
            'jenis_kelahiran' => 'nullable',
            'kelahiran_anak_ke' => 'nullable',
            'penolong_kelahiran' => 'nullable',
            'berat_lahir' => 'nullable',
            'panjang_lahir' => 'nullable',
            // PENDIDIKAN DAN PEKERJAAN
            'id_pendidikan_terakhir' => 'required',
            'id_pendidikan_saat_ini' => 'required',
            'id_pekerjaan' => 'required',
            // DATA KEWARGANEGARAAN
            'id_kewarganegaraan' => 'required',
            'dokumen_pasport' => 'nullable',
            'tanggal_akhir_paspor' => 'nullable',
            'dokumen_kitas' => 'nullable',
            'negara_asal' => 'nullable',
            // DATA ORANG TUA
            'nik_ayah' => 'nullable',
            'nama_ayah' => 'required',
            'nik_ibu' => 'nullable',
            'nama_ibu' => 'required',
            // ALAMAT || TODO
            // 'alamat_kk' => 'nullable',
            'id_dusun' => 'required',
            'id_rt' => 'required',
            'alamat_sebelumnya' => 'required',
            'alamat_sekarang' => 'nullable',
            'telepon' => 'nullable',
            // STATUS PERKAWINAN
            'akta_perkawinan' => 'nullable',
            'id_status_perkawinan' => 'required',
            'tanggal_perkawinan' => 'nullable',
            'akta_perceraian' => 'nullable',
            'tanggal_perceraian' => 'nullable',
            // DATA KESEHATAN
            'id_golongan_darah' => 'required',
            'id_cacat' => 'nullable',
            'id_sakit_menahun' => 'nullable',
            'id_cara_kb' => 'nullable',
            'id_asuransi' => 'nullable',
            'no_asuransi' => 'nullable',
            'bpjs_ketenagakerjaan' => 'nullable',
        ]);

        $validatedData['nama'] = strtoupper($validatedData['nama']);
        if (isset($validatedData['tempat_lahir'])) {
            $validatedData['tempat_lahir'] = strtoupper($validatedData['tempat_lahir']);
        }
        if (isset($validatedData['alamat'])) {
        }

        Penduduk::create($validatedData);

        return redirect('/staf/kependudukan/penduduk')->with('success', 'Data penduduk berhasil ditambahkan!');
    }

    public function pendudukEdit(Penduduk $penduduk)
    {
        return view('staf.penduduk.pendudukEdit', [
            'title' => 'Edit Data Penduduk',
            'agama' => Agama::all(),
            // 'kk' => Keluarga::all(),
            'hubungan_kk' => HubunganKK::all(),
            'jenis_kelamin' => JenisKelamin::all(),
            // 'kesehatan' => Kesehatan::all(),
            'kewarganegaraan' => Kewarganegaraan::all(),
            'pekerjaan' => Pekerjaan::all(),
            'pendidikan_saat_ini' => PendidikanSaatIni::all(),
            'pendidikan_terakhir' => PendidikanTerakhir::all(),
            'wilayah_dusun' => WilayahDusun::all(),
            'wilayah_rt' => WilayahRt::all(),
            'status_perkawinan' => StatusPerkawinan::all(),
            'golongan_darah' => GolonganDarah::all(),
            'cacat' => Cacat::all(),
            'sakit_menahun' => SakitMenahun::all(),
            'cara_kb' => CaraKb::all(),
            'asuransi' => Asuransi::all(),
            'penduduk' => Penduduk::firstWhere('nik', $penduduk->nik),
        ]);
    }

    public function pendudukEditSubmit(Request $request, Penduduk $penduduk)
    {
        $validatedData = $request->validate([
            // DATA DIRI
            'nama' => 'required',
            'nik' => 'required|unique:penduduk,nik,' . $penduduk->id,
            // status kepemilikan identitas
            // 'ktp_el' => 'nullable',
            // 'status_rekam' => 'nullable',
            // 'tag_id_card' => 'nullable',
            'no_kk_sebelumnya' => 'nullable',
            'id_hubungan_kk' => 'required',
            'id_jenis_kelamin' => 'required',
            'id_agama' => 'required',
            'penduduk_tetap' => 'required',
            // DATA KELAHIRAN
            'akta_lahir' => 'nullable',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'waktu_lahir' => 'nullable',
            'tempat_dilahirkan' => 'nullable',
            'jenis_kelahiran' => 'nullable',
            'kelahiran_anak_ke' => 'nullable',
            'penolong_kelahiran' => 'nullable',
            'berat_lahir' => 'nullable',
            'panjang_lahir' => 'nullable',
            // PENDIDIKAN DAN PEKERJAAN
            'id_pendidikan_terakhir' => 'required',
            'id_pendidikan_saat_ini' => 'required',
            'id_pekerjaan' => 'required',
            // DATA KEWARGANEGARAAN
            'id_kewarganegaraan' => 'required',
            'dokumen_pasport' => 'nullable',
            'tanggal_akhir_paspor' => 'nullable',
            'dokumen_kitas' => 'nullable',
            'negara_asal' => 'nullable',
            // DATA ORANG TUA
            'nik_ayah' => 'nullable',
            'nama_ayah' => 'required',
            'nik_ibu' => 'nullable',
            'nama_ibu' => 'required',
            // ALAMAT || TODO
            // 'alamat_kk' => 'nullable',
            'id_dusun' => 'required',
            'id_rt' => 'required',
            'alamat_sebelumnya' => 'required',
            'alamat_sekarang' => 'nullable',
            'telepon' => 'nullable',
            // STATUS PERKAWINAN
            'akta_perkawinan' => 'nullable',
            'id_status_perkawinan' => 'required',
            'tanggal_perkawinan' => 'nullable',
            'akta_perceraian' => 'nullable',
            'tanggal_perceraian' => 'nullable',
            // DATA KESEHATAN
            'id_golongan_darah' => 'required',
            'id_cacat' => 'nullable',
            'id_sakit_menahun' => 'nullable',
            'id_cara_kb' => 'nullable',
            'id_asuransi' => 'nullable',
            'no_asuransi' => 'nullable',
            'bpjs_ketenagakerjaan' => 'nullable',
        ]);

        $validatedData['nama'] = strtoupper($validatedData['nama']);
        if (isset($validatedData['tempat_lahir'])) {
            $validatedData['tempat_lahir'] = strtoupper($validatedData['tempat_lahir']);
        }
        if (isset($validatedData['alamat'])) {
        }

        Penduduk::firstWhere('nik', $penduduk->nik)->update($validatedData);

        return redirect('/staf/kependudukan/penduduk')->with('success', 'Data penduduk berhasil diubah!');
    }

    public function pendudukDelete(Penduduk $penduduk)
    {
        // Cari data penduduk berdasarkan NIK
        $data = Penduduk::where('nik', $penduduk->nik)->first();

        // Hapus data di tabel penduduk
        if ($data) {
            // Simpan nilai id_helper_penduduk_keluarga untuk penduduk tertentu
            $idHelperPendudukKeluarga = $data->id_helper_penduduk_keluarga;

            // Setel nilai id_helper_penduduk_keluarga menjadi null hanya untuk penduduk yang bersangkutan
            Penduduk::where('id_helper_penduduk_keluarga', $idHelperPendudukKeluarga)
                ->update(['id_helper_penduduk_keluarga' => null]);

            // Jika penduduk memenuhi kriteria tertentu
            if ($data->id_helper_penduduk_keluarga && $data->id_hubungan_kk == 1) {
                // Hapus data di tabel helper_penduduk_keluarga
                $helperPendudukKeluarga = HelperPendudukKeluarga::find($idHelperPendudukKeluarga);
                if ($helperPendudukKeluarga) {
                    $helperPendudukKeluarga->delete();
                }

                // Hapus data di tabel keluarga
                $keluarga = Keluarga::where('id_helper_penduduk_keluarga', $idHelperPendudukKeluarga)->first();
                if ($keluarga) {
                    $keluarga->delete();
                }
            }

            // Setel nilai id_helper_penduduk_keluarga menjadi null hanya untuk penduduk yang bersangkutan
            Penduduk::where('id_helper_penduduk_keluarga', $idHelperPendudukKeluarga)
                ->update(['id_helper_penduduk_keluarga' => null]);

            // Hapus data di tabel penduduk
            $data->delete();
        }

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
