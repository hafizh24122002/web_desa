<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Posyandu;
use App\Models\Kia;
use App\Models\Penduduk;
use App\Models\IbuHamil;

class KesehatanController extends Controller
{
    public function posyandu()
    {
        return view('staf.kesehatan.posyandu', [
            'title' => 'Daftar Posyandu',
            'posyandu' => Posyandu::paginate(10),
        ]);
    }

    public function posyanduNew()
    {
        return view('staf.kesehatan.posyanduNew', [
            'title' => 'Tambah Data Posyandu Baru',
        ]);
    }

    public function posyanduNewSubmit(Request $request)
    {
        $data = [
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
        ];

        Posyandu::create($data);

        return redirect('/staf/kesehatan/posyandu')->with('success', 'Data posyandu berhasil ditambahkan!');
    }

    public function posyanduEdit($id)
    {
        return view('staf.kesehatan.posyanduEdit', [
            'title' => 'Ubah Data Posyandu',
            'posyandu' => Posyandu::find($id),
        ]);
    }

    public function posyanduEditSubmit(Request $request, $id)
    {
        $data = [
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
        ];

        Posyandu::find($id)->update($data);

        return redirect('/staf/kesehatan/posyandu')->with('success', 'Data posyandu berhasil diubah!');
    }

    public function posyanduDelete($id)
    {
        Posyandu::destroy($id);

        return redirect('/staf/kesehatan/posyandu')->with('success', 'Data posyandu berhasil dihapus!');
    }

    public function kia()
    {
        return view('staf.kesehatan.kia', [
            'title' => 'Kesehatan Ibu dan Anak',
            'kia' => Kia::with('anak', 'ibu')->paginate(10),
        ]);
    }

    public function kiaNew()
    {
        return view('staf.kesehatan.kiaNew', [
            'title' => 'Tambah data KIA',
            'dataIbu' => Penduduk::where('jenis_kelamin', '=', 'P')->selectRaw("CONCAT(nik, ' - ', nama) AS nik_nama")->pluck('nik_nama'),
            'penduduk' => Penduduk::selectRaw("CONCAT(nik, ' - ', nama) AS nik_nama")->pluck('nik_nama'),
        ]);
    }

    public function kiaNewSubmit(Request $request)
    {
        $ibu = Penduduk::where('nama', '=', substr($request->input('nama_ibu'), 19))->first();
        $anak = Penduduk::where('nama', '=', substr($request->input('nama_anak'), 19))->first();

        $errors = [];

        if (!$ibu) {
            $errors['nama_ibu'] = 'Nama Ibu tidak valid atau tidak terdaftar';
        }

        if (!$anak && ($request->input('nama_anak') != null)) {
            $errors['nama_anak'] = 'Nama Anak tidak valid atau tidak terdaftar';
        }

        if (!empty($errors)) {
            return redirect('/staf/kesehatan/kia/new-kia')
                ->withErrors($errors)
                ->withInput();
        }

        $data = [
            'no_kia' => $request->input('no_kia'),
            'id_ibu' => $ibu->id,
            'id_anak' => $anak->id ?? null,
            'perkiraan_lahir'  => $request->input('perkiraan_kelahiran'),
        ];
        
        Kia::create($data);

        return redirect('/staf/kesehatan/kia')->with('success', 'Data KIA berhasil ditambahkan!');
    }

    public function kiaEdit($id)
    {
        return view('staf.kesehatan.kiaEdit', [
            'title' => 'Ubah data KIA',
            'kia' => Kia::with('anak', 'ibu')->find($id),
            'dataIbu' => Penduduk::where('jenis_kelamin', '=', 'P')->selectRaw("CONCAT(nik, ' - ', nama) AS nik_nama")->pluck('nik_nama'),
            'penduduk' => Penduduk::selectRaw("CONCAT(nik, ' - ', nama) AS nik_nama")->pluck('nik_nama'),
        ]);
    }

    public function kiaEditSubmit(Request $request, $id)
    {
        $ibu = Penduduk::where('nama', '=', substr($request->input('nama_ibu'), 19))->first();
        $anak = Penduduk::where('nama', '=', substr($request->input('nama_anak'), 19))->first();

        $errors = [];

        if (!$ibu) {
            $errors['nama_ibu'] = 'Nama Ibu tidak valid atau tidak terdaftar';
        }

        if (!$anak && ($request->input('nama_anak') != null)) {
            $errors['nama_anak'] = 'Nama Anak tidak valid atau tidak terdaftar';
        }

        if (!empty($errors)) {
            return redirect('/staf/kesehatan/kia/new-kia')
                ->withErrors($errors)
                ->withInput();
        }

        $data = [
            'no_kia' => $request->input('no_kia'),
            'id_ibu' => $ibu->id,
            'id_anak' => $anak->id ?? null,
            'perkiraan_lahir'  => $request->input('perkiraan_kelahiran'),
        ];

        Kia::find($id)->update($data);

        return redirect('/staf/kesehatan/kia')->with('success', 'Data KIA berhasil diubah!');
    }

    public function kiaDelete($id)
    {
        Kia::destroy($id);

        return redirect('/staf/kesehatan/kia')->with('success', 'Data KIA berhasil dihapus!');
    }

    public function pemantauan()
    {
        return view('staf.kesehatan.pemantauanKia', [
            'title' => 'Pemantauan Kesehatan Ibu dan Anak',
            'ibu' => IbuHamil::with('posyandu', 'kia')->paginate(10),
        ]);
    }

    public function pemantauanIbuNew()
    {
        return view('staf.kesehatan.pemantauanKiaIbuNew', [
            'title' => 'Tambah data ibu hamil',
            'kia' => Kia::all(),
            'posyandu' => Posyandu::all(),
        ]);
    }

    public function pemantauanIbuNewSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'id_kia' => 'required',
            'tanggal_periksa' => 'required',
            'id_posyandu' => 'required',
            'status_kehamilan' => 'required',
            'usia_kehamilan' => 'required',
            'tanggal_melahirkan' => 'nullable',
            'butir_pil_fe' => 'nullable|required_if:konsumsi_pil_fe,on'
        ], [
            'id_kia.required' => 'Nomor KIA tidak boleh kosong!',
            'tanggal_periksa.required' => 'Tanggal periksa tidak boleh kosong!',
            'id_posyandu.required' => 'Posyandu tidak boleh kosong!',
            'status_kehamilan.required' => 'Status kehamilan tidak boleh kosong!',
            'usia_kehamilan.required' => 'Usia kehamilan tidak boleh kosong!',
            'butir_pil_fe.required_if' => 'Butir pil Fe tidak boleh kosong jika Konsumsi pil Fe dicentang!'
        ]);

        $data = [
            'id_kia' => $validatedData['id_kia'],
            'tanggal_periksa' => $validatedData['tanggal_periksa'],
            'id_posyandu' => $validatedData['id_posyandu'],
            'status_kehamilan' => $validatedData['status_kehamilan'],
            'usia_kehamilan' => $validatedData['usia_kehamilan'],
            'tanggal_melahirkan' => $validatedData['tanggal_melahirkan'],
            'butir_pil_fe' => $validatedData['butir_pil_fe'],
            'pemeriksaan_kehamilan' => $request->input('pemeriksaan_kehamilan') ? true : false,
            'konsumsi_pil_fe' => $request->input('konsumsi_pil_fe') ? true : false,
            'pemeriksaan_nifas' => $request->input('pemeriksaan_nifas') ? true : false,
            'konseling_gizi' => $request->input('konseling_gizi') ? true : false,
            'kunjungan_rumah' => $request->input('kunjungan_rumah') ? true : false,
            'akses_air_bersih' => $request->input('akses_air_bersih') ? true : false,
            'kepemilikan_jamban' => $request->input('kepemilikan_jamban') ? true : false,
            'jaminan_kesehatan' => $request->input('jaminan_kesehatan') ? true : false,
        ];

        IbuHamil::create($data);

        return redirect('/staf/kesehatan/pemantauan')->with('success', 'Data pemantauan ibu hamil berhasil ditambahkan!');
    }

    public function pemantauanIbuEdit($id)
    {
        return view('staf.kesehatan.pemantauanKiaIbuEdit', [
            'title' => 'Ubah Data Pemantauan Ibu Hamil',
            'ibu_hamil' => IbuHamil::find($id),
            'posyandu' => Posyandu::all(),
            'kia' => Kia::all(),
        ]);
    }

    public function pemantauanIbuEditSubmit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_kia' => 'required',
            'tanggal_periksa' => 'required',
            'id_posyandu' => 'required',
            'status_kehamilan' => 'required',
            'usia_kehamilan' => 'required',
            'tanggal_melahirkan' => 'nullable',
            'butir_pil_fe' => 'nullable|required_if:konsumsi_pil_fe,on'
        ], [
            'id_kia.required' => 'Nomor KIA tidak boleh kosong!',
            'tanggal_periksa.required' => 'Tanggal periksa tidak boleh kosong!',
            'id_posyandu.required' => 'Posyandu tidak boleh kosong!',
            'status_kehamilan.required' => 'Status kehamilan tidak boleh kosong!',
            'butir_pil_fe.required_if' => 'Butir pil Fe tidak boleh kosong jika Konsumsi pil Fe dicentang!'
        ]);

        $data = [
            'id_kia' => $validatedData['id_kia'],
            'tanggal_periksa' => $validatedData['tanggal_periksa'],
            'id_posyandu' => $validatedData['id_posyandu'],
            'status_kehamilan' => $validatedData['status_kehamilan'],
            'usia_kehamilan' => $validatedData['usia_kehamilan'],
            'tanggal_melahirkan' => $validatedData['tanggal_melahirkan'],
            'butir_pil_fe' => $validatedData['butir_pil_fe'],
            'pemeriksaan_kehamilan' => $request->input('pemeriksaan_kehamilan') ? true : false,
            'konsumsi_pil_fe' => $request->input('konsumsi_pil_fe') ? true : false,
            'pemeriksaan_nifas' => $request->input('pemeriksaan_nifas') ? true : false,
            'konseling_gizi' => $request->input('konseling_gizi') ? true : false,
            'kunjungan_rumah' => $request->input('kunjungan_rumah') ? true : false,
            'akses_air_bersih' => $request->input('akses_air_bersih') ? true : false,
            'kepemilikan_jamban' => $request->input('kepemilikan_jamban') ? true : false,
            'jaminan_kesehatan' => $request->input('jaminan_kesehatan') ? true : false,
        ];

        IbuHamil::find($id)->update($data);

        return redirect('/staf/kesehatan/pemantauan')->with('success', 'Data pemantauan ibu hamil berhasil diubah!');
    }

    public function pemantauanIbuDelete($id)
    {
        IbuHamil::destroy($id);

        return redirect('/staf/kesehatan/pemantauan')->with('success', 'Data pemantauan ibu hamil berhasil dihapus!');
    }
}