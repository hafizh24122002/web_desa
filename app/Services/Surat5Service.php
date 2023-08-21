<?php

namespace App\Services;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Agama;
use App\Models\Kewarganegaraan;
use App\Models\Penduduk;
use App\Models\Pekerjaan;
use App\Models\Staf;
use App\Models\StatusPerkawinan;

/**
 * Surat Rekomendasi Izin Keramaian
 * 300
 */
class Surat5Service
{
    public function getViewData()
    {
        return [
            'agama' => Agama::all(),
			'kewarganegaraan' => Kewarganegaraan::all(),
			'penduduk' => Penduduk::pluck('nama'),
			'pekerjaan' => Pekerjaan::all(),
			'staf' => Staf::all(),
        ];
    }

    public function submit(Request $request, $id)
    {
		$validate = $request->validate([
            'no_surat' => [
                'required',
                Rule::unique('arsip_surat')->ignore($id)->where(function ($query) use ($request) {
                    // Extract the year from 'tanggal_surat' input value
                    $year = Carbon::createFromFormat('Y-m-d', $request->input('tanggal_surat'))->year;

                    // Add a condition to check for unique no_surat within the fetched year
                    $query->whereYear('tanggal_surat', $year);
                }),
            ],
            'nik' => 'numeric',
        ], [
            'no_surat.unique' => 'Nomor surat sudah ada!'
        ]);

        $staf = Staf::find($request->input('id_staf'));
        if($staf->jabatan === "Kepala Desa") {
            $staf->jabatan = $staf->jabatan." Malik";
        }

        $staf_an = Staf::find($request->input('id_staf_an'));

        if($request->input('id_staf_an')) {
            $nama_staf = $staf->nama;
            $nama_ttd = $staf_an->nama;
            $an = "an. ".$staf_an->jabatan;
            $jabatan_staf = $staf->jabatan;
        } else {
            $nama_staf = $staf->nama;
            $nama_ttd = $staf->nama;
            $jabatan_staf = $staf->jabatan;
            $an = "";
        }

        $nomorSurat = $validate['no_surat'];
        $nama = strtoupper($request->input('nama'));
        $nik = $request->input('nik');
        $tempat_lahir = ucwords(strtolower($request->input('tempat_lahir')));
        $tanggal_lahir_str = $request->input('tanggal_lahir');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $id_pekerjaan = $request->input('id_pekerjaan');
        $alamat = $request->input('alamat');
        $id_agama = $request->input('id_agama');
        $id_kewarganegaraan = $request->input('id_kewarganegaraan');
        $nama_kegiatan = $request->input('kegiatan');
        $tanggal_kegiatan_str = $request->input('tanggal_kegiatan');
        $start_time = $request->input('start_time');
        $finish_time = $request->input('finish_time');
        $tempat_kegiatan = $request->input('tempat_kegiatan');
        $tanggal_surat_str = $request->input('tanggal_surat');
        $tanggal_ttd_str = $request->input('tanggal_ttd');
        $tipe = $request->input('tipe');

        if($jenis_kelamin === "L") {
            $jenis_kelamin = "Laki-Laki";
        } else {
            $jenis_kelamin = "Perempuan";
        }

        // Define the values to be filled in the template
        return [
            'no_surat' => $nomorSurat,
            'year' => Carbon::parse($tanggal_surat_str)->format('Y'),
            'nama' => $nama,
            'nik' => $nik,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => Carbon::parse($tanggal_lahir_str)->translatedFormat('jS F Y'),
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,
            'pekerjaan' => ucwords(strtolower(Pekerjaan::find($id_pekerjaan)->nama)),
            'agama' => ucwords(strtolower(Agama::find($id_agama)->nama)),
            'kewarganegaraan' => Kewarganegaraan::find($id_kewarganegaraan)->nama,
            'kegiatan' => $nama_kegiatan,
            'hari_kegiatan' => Carbon::parse($tanggal_kegiatan_str)->translatedFormat('l'),
            'tanggal_kegiatan' => Carbon::parse($tanggal_kegiatan_str)->translatedFormat('jS F Y'),
            'start_time' => $start_time,
            'finish_time' => $finish_time,
            'tempat_kegiatan' => $tempat_kegiatan,
            'umur' => Carbon::parse($tanggal_lahir_str)->age,
            'tanggal_surat' => Carbon::parse($tanggal_surat_str)->translatedFormat('jS F Y'),
            'tanggal_surat_raw' => $tanggal_surat_raw,
            'hari_ttd' => Carbon::parse($tanggal_ttd_str)->translatedFormat('l'),
            'tanggal_ttd' => Carbon::parse($tanggal_ttd_str)->translatedFormat('jS F Y'),
            'nama_staf' => $nama_staf,
            'jabatan_staf' => $jabatan_staf,
            'an' => $an,
            'nama_ttd' => $nama_ttd,
        ];
	}
}