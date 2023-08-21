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
 * Surat Keterangan Penghasilan Orang Tua
 * 474.4
 */
class Surat3Service
{
    public function getViewData()
    {
        return [
            'agama' => Agama::all(),
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
			'penghasilan_ortu' => 'integer'
		], [
			'no_surat.unique' => 'Nomor surat sudah ada!',
		]);

		$nomorSurat = $validate['no_surat'];
		$tanggal_surat_str = $request->input('tanggal_surat');  

		$nama = strtoupper($request->input('nama'));
		$jenis_kelamin = $request->input('jenis_kelamin');
		$tempat_lahir = ucwords(strtolower($request->input('tempat_lahir')));
		$tanggal_lahir_str = $request->input('tanggal_lahir');
		$id_agama = $request->input('id_agama');
		$id_pekerjaan = $request->input('id_pekerjaan');
		$alamat = $request->input('alamat');

		$nama_ortu = strtoupper($request->input('nama_ortu'));
		$jenis_kelamin_ortu = $request->input('jenis_kelamin_ortu');
		$tempat_lahir_ortu = ucwords(strtolower($request->input('tempat_lahir_ortu')));
		$tanggal_lahir_ortu_str = $request->input('tanggal_lahir_ortu');
		$id_agama_ortu = $request->input('id_agama_ortu');
		$id_pekerjaan_ortu = $request->input('id_pekerjaan_ortu');
		$alamat_ortu = $request->input('alamat_ortu');
		$penghasilan_ortu = $request->input('penghasilan_ortu');

		$tanggal_lahir = Carbon::parse($tanggal_lahir_str)->translatedFormat('jS F Y');
		$tanggal_lahir_ortu = Carbon::parse($tanggal_lahir_ortu_str)->translatedFormat('jS F Y');
		$tanggal_surat = Carbon::parse($tanggal_surat_str)->translatedFormat('jS F Y');
		$agama = ucwords(strtolower(Agama::find($id_agama)->nama));
		$agama_ortu = ucwords(strtolower(Agama::find($id_agama_ortu)->nama));
		$pekerjaan = ucwords(strtolower(Pekerjaan::find($id_pekerjaan)->nama));
		$pekerjaan_ortu = ucwords(strtolower(Pekerjaan::find($id_pekerjaan_ortu)->nama));

		if($jenis_kelamin === "L") {
			$jenis_kelamin = "Laki-Laki";
			$pekerjaan_jk = "Siswa";
		} else {
			$jenis_kelamin = "Perempuan";
			$pekerjaan_jk = "Siswi";
		}

		if($jenis_kelamin_ortu === "L") {
			$jenis_kelamin_ortu = "Laki-Laki";
		} else {
			$jenis_kelamin_ortu = "Perempuan";
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

		$locale = 'id_ID';
		$formatter_txt = new \NumberFormatter($locale, \NumberFormatter::SPELLOUT);
		$penghasilan_ortu_txt = ucwords($formatter_txt->format($penghasilan_ortu));

		$formatter_num = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
		$formatter_num->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
		$penghasilan_ortu_num = $formatter_num->format($penghasilan_ortu);

		// Define the values to be filled in the template
		return [
			'no_surat' => $nomorSurat,
			'year' => Carbon::parse($tanggal_surat_str)->format('Y'),
			'tanggal_surat' => $tanggal_surat,
			'tanggal_surat_raw' => $tanggal_surat_raw,
			'nama' => $nama,
			'jenis_kelamin' => $jenis_kelamin,
			'tempat_lahir' => $tempat_lahir,
			'tanggal_lahir' => $tanggal_lahir,
			'agama' => $agama,
			'pekerjaan' => $pekerjaan,
			'alamat' => $alamat,
			'nama_ortu' => $nama_ortu,
			'jenis_kelamin_ortu' => $jenis_kelamin_ortu,
			'tempat_lahir_ortu' => $tempat_lahir_ortu,
			'tanggal_lahir_ortu' => $tanggal_lahir_ortu,
			'agama_ortu' => $agama_ortu,
			'pekerjaan_ortu' => $pekerjaan_ortu,
			'alamat_ortu' => $alamat_ortu,
			'penghasilan_ortu_num' => $penghasilan_ortu_num,
			'penghasilan_ortu_text' => $penghasilan_ortu_txt,
			'pekerjaan_jk' => $pekerjaan_jk,
			'nama_staf' => $nama_staf,
			'jabatan_staf' => $jabatan_staf,
			'an' => $an,
			'nama_ttd' => $nama_ttd,
		];
	}
}