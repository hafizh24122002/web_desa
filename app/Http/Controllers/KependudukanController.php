<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\Models\Agama;
use App\Models\Asuransi;
use App\Models\Cacat;
use App\Models\CaraKb;
use App\Models\GolonganDarah;
use App\Models\HubunganKK;
use App\Models\JenisKelamin;
use App\Models\Keluarga;
use App\Models\LogPenduduk;
// use App\Models\Kesehatan;
use App\Models\Kewarganegaraan;
use App\Models\Pekerjaan;
use App\Models\PendidikanSaatIni;
use App\Models\PendidikanTerakhir;
use App\Models\Penduduk;
use App\Models\PendudukStatus;
use App\Models\PenyebabKematian;
use App\Models\PenolongKematian;
use App\Models\Pindah;
use App\Models\Rt;
use App\Models\SakitMenahun;
use App\Models\StatusDasar;
use App\Models\StatusPerkawinan;
use App\Models\HelperPendudukKeluarga;
use App\Models\WilayahDusun;
use App\Models\WilayahRt;
use App\Models\HelperPendudukRtm;

class KependudukanController extends Controller
{
    public function kependudukan(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort_field', 'nik'); // Default sorting field
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        $query = Penduduk::join(
            'log_penduduk',
            'log_penduduk.id_penduduk',
            '=',
            'penduduk.id'
        )->select(
            'nik',
            'nama',
            'id_helper_penduduk_keluarga',
            'nama_ayah',
            'nama_ibu',
            // 'no_rumah_tangga',
            'alamat_sekarang',
            // 'dusun',
            // 'rw',
            // 'rt',
            'id_pendidikan_terakhir',
            'tanggal_lahir',
            'id_pekerjaan',
            'id_status_perkawinan',
            'tanggal_peristiwa',
            'tanggal_lapor'
        )->where('penduduk_tetap', 1)->whereIn('id_peristiwa', [1, 5]);

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

    public function pendudukNew($type)
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
            'type' => $type,
        ]);
    }

    public function pendudukNewSubmit(Request $request, $type)
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

        $pendudukData = Penduduk::create($validatedData);

        if ($type === 'lahir') {
            LogPenduduk::create([
                'id_penduduk' => $pendudukData->id,
                'id_peristiwa' => 1,    // id peristiwa untuk LAHIR
                'tanggal_lapor' => $request->tanggal_lapor,
                'tanggal_peristiwa' => $pendudukData->tanggal_lahir
            ]);
        } else if ($type === 'masuk') {
            LogPenduduk::create([
                'id_penduduk' => $pendudukData->id,
                'id_peristiwa' => 5,    // id peristiwa untuk MASUK
                'tanggal_lapor' => $request->tanggal_lapor,
                'tanggal_peristiwa' => $request->tanggal_peristiwa
            ]);
        }
        

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

    public function pendudukStatusDasarEdit(Penduduk $penduduk)
    {
        if ($penduduk->penduduk_tetap === 1) {
            $statusDasar = StatusDasar::find([2,3,4]);
        } else {
            $statusDasar = StatusDasar::find([2,3,4,5]);
        }

        return view('staf.penduduk.pendudukStatusDasarEdit', [
            'title' => 'Edit Status Dasar Penduduk',
            'nik' => $penduduk->nik,
            'status_dasar' => $statusDasar,
            'penyebab_kematian' => PenyebabKematian::all(),
            'penolong_kematian' => PenolongKematian::all(),
            'pindah' => Pindah::all(),
        ]);
    }

    public function pendudukStatusDasarEditSubmit(Request $request, Penduduk $penduduk)
    {
        $validatedData = $request->validate([
            'id_status_dasar' => 'required',
            // required only if status dasar is MATI
                'meninggal_di' => 'required_if:id_status_dasar,2',
                'jam_mati' => 'required_if:id_status_dasar,2',
                'id_penyebab_kematian' => 'required_if:id_status_dasar,2',
                'id_penolong_kematian' => 'required_if:id_status_dasar,2',
                'no_akta_mati' => 'required_if:id_status_dasar,2',
            // required only if status dasar is PINDAH
                'id_pindah' => 'required_if:id_status_dasar,3',
                'alamat_tujuan' => 'required_if:id_status_dasar,3',
            'tanggal_peristiwa' => 'required',
            'tanggal_lapor' => 'required',
            'catatan' => 'nullable'
        ], [
            'id_status_dasar.required' => 'Status dasar harus diisi!',
            'tanggal_peristiwa.required' => 'Tanggal peristiwa harus diisi!',
            'tanggal_lapor.required' => 'Tanggal lapor harus diisi!',
            'meninggal_di.required_if' => 'Tempat meninggal harus diisi jika status dasar diisi "MATI"!',
            'jam_mati.required_if' => 'Jam kematian harus diisi jika status dasar diisi "MATI"!',
            'id_penyebab_kematian.required_if' => 'Penyebab kematian harus diisi jika status dasar diisi "MATI"!',
            'id_penolong_kematian.required_if' => 'Yang menerangkan kematian harus diisi jika status dasar diisi "MATI"!',
            'no_akta_mati.required_if' => 'Nomor Akta Kematian harus diisi jika status dasar diisi "MATI"!',
            'id_pindah.required_if' => 'Tujuan pindah harus diisi jika status dasar diisi "PINDAH"!',
            'alamat_tujuan.required_if' => 'Alamat tujuan harus diisi jika status dasar diisi "PINDAH"!',
        ]);

        $penduduk->update(['id_status_dasar' => $validatedData['id_status_dasar']]);

        switch ($validatedData['id_status_dasar']) {
            case 2:
                $peristiwa = 2;     // MATI
                break;
            case 3:
                $peristiwa = 3;     // PINDAH KELUAR
                break;
            case 4:
                $peristiwa = 4;     // HILANG
                break;
            case 5:
                $peristiwa = 6;     // PERGI
                break;
        }

        $logData = Arr::except($validatedData, ['id_status_dasar']);
        LogPenduduk::create(array_merge([
            'id_penduduk' => $penduduk->id,
            'id_peristiwa' => $peristiwa,
        ], $logData));

        return redirect('/staf/kependudukan/penduduk')->with('success', 'Data status dasar penduduk berhasil diubah!');
    }

    public function pendudukDelete(Penduduk $penduduk)
    {
        // Find data based on NIK
        $deletedPenduduk = Penduduk::where('nik', $penduduk->nik)->first();

        // Check if the data is found
        if ($deletedPenduduk) {
            // Store the id_helper_penduduk_keluarga for later use
            $idHelperPendudukKeluarga = $deletedPenduduk->id_helper_penduduk_keluarga;
            $idHelperPendudukRtm = $deletedPenduduk->id_helper_penduduk_rtm;

            // Delete the Penduduk record
            $deletedPenduduk->delete();

            // Check conditions for updating id_hubungan_kk (after deleting the record)
            if ($idHelperPendudukKeluarga !== null) {
                // Find the first Penduduk record with the same id_helper_penduduk_keluarga
                $newHead = Penduduk::where('id_helper_penduduk_keluarga', $idHelperPendudukKeluarga)
                    ->where('id', '!=', $deletedPenduduk->id) // Exclude the deleted record
                    ->first();

                // Check if id_hubungan_kk was 1 before deletion
                if ($newHead && $deletedPenduduk->id_hubungan_kk === 1) {
                    // Update id_hubungan_kk to 1 for the new head
                    $newHead->update(['id_hubungan_kk' => 1]);
                }
            }
            if ($idHelperPendudukRtm !== null) {
                // Find the first Penduduk record with the same id_helper_penduduk_rtm
                $newHead = Penduduk::where('id_helper_penduduk_rtm', $idHelperPendudukRtm)
                    ->where('id', '!=', $deletedPenduduk->id) // Exclude the deleted record
                    ->first();

                // Check if id_hubungan_kk was 1 before deletion
                if ($newHead && $deletedPenduduk->id_rtm_hubungan === 1) {
                    // Update id_hubungan_kk to 1 for the new head
                    $newHead->update(['id_rtm_hubungan' => 1]);
                }
            }
        }

        // Update nik_kepala in helper_penduduk_keluarga or delete if necessary
        if ($deletedPenduduk->id_hubungan_kk === 1 && $idHelperPendudukKeluarga !== null) {
            $this->updateNikKepalaKeluarga($idHelperPendudukKeluarga);
        }
        // Update nik_kepala in helper_penduduk_keluarga or delete if necessary
        if ($deletedPenduduk->id_rtm_hubungan === 1 && $idHelperPendudukRtm !== null) {
            $this->updateNikKepalaRtm($idHelperPendudukRtm);
        }

        return redirect('/staf/kependudukan/penduduk')->with('success', 'Data penduduk berhasil dihapus!');
    }

    private function updateNikKepalaKeluarga($idHelperPendudukKeluarga)
    {
        // Find the first Penduduk record with the same id_helper_penduduk_keluarga
        $newHead = Penduduk::where('id_helper_penduduk_keluarga', $idHelperPendudukKeluarga)
            ->where('id_hubungan_kk', 1)
            ->first();

        if ($newHead) {
            // Update nik_kepala in helper_penduduk_keluarga
            HelperPendudukKeluarga::where('id', $idHelperPendudukKeluarga)
                ->update(['nik_kepala' => $newHead->nik]);
        } else {
            // Delete the record in helper_penduduk_keluarga
            HelperPendudukKeluarga::where('id', $idHelperPendudukKeluarga)->delete();
        }
    }

    private function updateNikKepalaRtm($idHelperPendudukRtm)
    {
        // Find the first Penduduk record with the same id_helper_penduduk_rtm
        $newHead = Penduduk::where('id_helper_penduduk_rtm', $idHelperPendudukRtm)
            ->where('id_rtm_hubungan', 1)
            ->first();

        if ($newHead) {
            // Update nik_kepala in helper_penduduk_rtm
            HelperPendudukRtm::where('id', $idHelperPendudukRtm)
                ->update(['nik_kepala' => $newHead->nik]);
        } else {
            // Delete the record in helper_penduduk_keluarga
            HelperPendudukRtm::where('id', $idHelperPendudukRtm)->delete();
        }
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
