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
 * Surat Keterangan Belum Menikah
 * 474.4
 */
class Surat6Service
{
    public function getViewData()
    {
        return [
			'penduduk' => Penduduk::pluck('nama'),
            'agama' => Agama::all(),
			'status_perkawinan' => StatusPerkawinan::all(),
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
			'rt' => 'numeric',
        ], [
            'no_surat.unique' => 'Nomor surat sudah ada!'
        ]);

        $staf = Staf::find($request->input('id_staf'));
        if($staf->jabatan === "Kepala Desa") {
            $staf->jabatan = $staf->jabatan." Malik";
        }

        $staf_an = Staf::find($request->input('id_staf_an'));
		$nama_staf = $staf->nama;

        if($request->input('id_staf_an')) {
            $nama_ttd = $staf_an->nama;
            $an = "an. ".$staf_an->jabatan;
            $jabatan_staf = $staf->jabatan;
        } else {
            $nama_ttd = $staf->nama;
            $jabatan_staf = $staf->jabatan;
            $an = "";
        }

        $nomorSurat = $validate['no_surat'];
        $nama = strtoupper($request->input('nama'));
		$jenis_kelamin = $request->input('jenis_kelamin');
        $tempat_lahir = ucwords(strtolower($request->input('tempat_lahir')));
        $tanggal_lahir_str = $request->input('tanggal_lahir');
		$kebangsaan = $request->input('kebangsaan');
        $id_agama = $request->input('id_agama');
        $id_status_perkawinan = $request->input('id_status_perkawinan');
		$id_pekerjaan = $request->input('id_pekerjaan');
		$alamat = $request->input('alamat');
		$rt = $validate['rt'];
		$dusun = $request->input('dusun');
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
            'jenis_kelamin' => $jenis_kelamin,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => Carbon::parse($tanggal_lahir_str)->translatedFormat('jS F Y'),
			'kebangsaan' => $kebangsaan,
            'agama' => ucwords(strtolower(Agama::find($id_agama)->nama)),
			'status_perkawinan' => ucwords(strtolower(StatusPerkawinan::find($id_status_perkawinan)->nama)),
            'pekerjaan' => ucwords(strtolower(Pekerjaan::find($id_pekerjaan)->nama)),
            'alamat' => $alamat,
            'rt' => $rt,
			'dusun' => $dusun,
            'tanggal_surat' => Carbon::parse($tanggal_surat_str)->translatedFormat('jS F Y'),
            'tanggal_surat_raw' => Carbon::parse($tanggal_surat_str),
            'nama_staf' => $nama_staf,
            'jabatan_staf' => $jabatan_staf,
            'an' => $an,
            'nama_ttd' => $nama_ttd,
        ];
	}
}