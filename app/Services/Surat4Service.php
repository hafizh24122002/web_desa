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
 * Surat Undangan Pembahasan HUT Bangka Selatan
 * 140
 */
class Surat4Service
{
    public function getViewData()
    {
        return [
            'hari_jadi_num' => Carbon::parse('2003-02-25')->age+1,
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
		]);

		$nomorSurat = $validate['no_surat'];
		$tanggal_surat_str = $request->input('tanggal_surat');
		$nama = $request->input('nama');
		$hari_jadi_num = $request->input('hari_jadi_num');
		$tanggal_kegiatan_str = $request->input('tanggal_kegiatan');
		$start_time = $request->input('start_time');
		$finish_time = $request->input('finish_time');
		$tempat_kegiatan = $request->input('tempat_kegiatan');

		if(!$finish_time) {
			$finish_time = "Selesai";
		} else {
			$finish_time = $finish_time.' WIB';
		}

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

		// Define the values to be filled in the template
		return [
			'tanggal_surat' => Carbon::parse($tanggal_surat_str)->translatedFormat('jS F Y'),
			'tanggal_surat_raw' => Carbon::parse($tanggal_surat_str),
			'year' => Carbon::parse($tanggal_surat_str)->format('Y'),
			'no_surat' => $nomorSurat,
			'nama' => $nama,
			'hari_jadi_num' => $hari_jadi_num,
			'hari_kegiatan' => Carbon::parse($tanggal_kegiatan_str)->translatedFormat('l'),
			'tanggal_kegiatan' => Carbon::parse($tanggal_kegiatan_str)->translatedFormat('jS F Y'),
			'start_time' => $start_time,
			'finish_time' => $finish_time,
			'tempat_kegiatan' => $tempat_kegiatan,
			'jabatan_staf' => $jabatan_staf,
			'nama_staf' => $nama_staf,
			'an' => $an,
			'nama_ttd' => $nama_ttd,         
		];
	}
}