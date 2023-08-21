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
 * Surat Keterangan Usaha
 * 512
 */
class Surat1Service
{
    public function getViewData()
    {
        return [
            'agama' => Agama::all(),
            'kewarganegaraan' => Kewarganegaraan::all(),
            'penduduk' => Penduduk::pluck('nama'),
            'pekerjaan' => Pekerjaan::all(),
            'status_perkawinan' => StatusPerkawinan::all(),
            'staf' => Staf::all(),
        ];
    }

    public function submit(Request $request, $id)
    {
        // Retrieve user input from the web form
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
            'rw' => 'numeric',
        ], [
            'no_surat.unique' => 'Nomor surat sudah ada!'
        ]);

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
        $rw = $validate['rw'];
        $usaha = $request->input('usaha');
        $tanggal_surat_str = $request->input('tanggal_surat');

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

        if($jenis_kelamin === "L") {
            $jenis_kelamin = "Laki-Laki";
        } else {
            $jenis_kelamin = "Perempuan";
        }

        $tanggal_lahir = Carbon::parse($tanggal_lahir_str)->translatedFormat('jS F Y');
        $tanggal_surat = Carbon::parse($tanggal_surat_str)->translatedFormat('jS F Y');

        $agama = ucwords(strtolower(Agama::find($id_agama)->nama));
        $status_perkawinan = ucwords(strtolower(StatusPerkawinan::find($id_status_perkawinan)->nama));
        $pekerjaan = ucwords(strtolower(Pekerjaan::find($id_pekerjaan)->nama));
        
        // Define the values to be filled in the template
        return [
            'no_surat' => $nomorSurat,
            'nama' => $nama,
            'jenis_kelamin' => $jenis_kelamin,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'kebangsaan' => $kebangsaan,
            'agama' => $agama,
            'status_perkawinan' => $status_perkawinan,
            'pekerjaan' => $pekerjaan,
            'alamat' => $alamat,
            'rt' => $rt,
            'rw' => $rw,
            'nama_usaha' => $usaha,
            'tanggal_surat' => $tanggal_surat,
            'tanggal_surat_raw' => $tanggal_surat_raw,
            'year' => Carbon::parse($tanggal_surat_str)->format('Y'),
            'nama_staf' => $nama_staf,
            'jabatan_staf' => $jabatan_staf,
            'an' => $an,
            'nama_ttd' => $nama_ttd,
        ];
    }
}