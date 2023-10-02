<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\identitasDesa;
use App\Models\Dusun;
use App\Models\Staf;

class InfoDesaController extends Controller
{
    public function showDataDesa()
    {
        $dataDesa = IdentitasDesa::first(); // Assuming you want to retrieve the first record. You can use other methods like find() or where() as per your requirement.
        $title = 'Identitas Desa'; // Add the title variable here.

        return view('staf.infodesa.identitasDesa', compact('dataDesa', 'title'));
    }

    public function editDataDesa()
    {
        $dataDesa = IdentitasDesa::first(); // Replace 'Desa' with your actual model name and fetch the necessary data from the database.
        $title = 'Identitas Desa'; // Add the title variable here.

        return view('staf.infodesa.identitasDesaEdit', compact('dataDesa', 'title'));
    }

    public function updateDataDesa(Request $request)
    {
        $dataDesa = IdentitasDesa::first(); // Replace 'Desa' with your actual model name and fetch the necessary data from the database.

        // Update the attributes with the data from the form submission
        $dataDesa->nama_desa = $request->input('nama_desa');
        $dataDesa->kode_desa = $request->input('kode_desa');
        $dataDesa->kode_pos_desa = $request->input('kode_pos_desa');
        $dataDesa->nama_kepala_desa = $request->input('nama_kepala_desa');
        $dataDesa->nip_kepala_desa = $request->input('nip_kepala_desa');
        $dataDesa->alamat_kantor = $request->input('alamat_kantor');
        $dataDesa->email_desa = $request->input('email_desa');
        $dataDesa->telepon = $request->input('telepon');
        $dataDesa->website = $request->input('website');
        $dataDesa->nama_kecamatan = $request->input('nama_kecamatan');
        $dataDesa->kode_kecamatan = $request->input('kode_kecamatan');
        $dataDesa->nama_kepala_camat = $request->input('nama_kepala_camat');
        $dataDesa->nip_kepala_camat = $request->input('nip_kepala_camat');
        $dataDesa->nama_kabupaten = $request->input('nama_kabupaten');
        $dataDesa->kode_kabupaten = $request->input('kode_kabupaten');
        $dataDesa->nama_provinsi = $request->input('nama_provinsi');
        $dataDesa->kode_provinsi = $request->input('kode_provinsi');

        // Update other attributes as needed
        $dataDesa->save();

        // return back()->with('success', 'Desa data updated successfully!');

        return redirect()
            ->route('desa.data')
            ->with('success', 'Data desa telah diperbarui!');
    }

    public function showPetaWilayah() {
        return view('staf.infodesa.petaWilayah', [
            'title' => 'Peta Wilayah',
            'koordinat' => Storage::get('koordinat_wilayah/coordinates.json'),
        ]);
    }

    public function dusunManager()
    {
        $dusun = Dusun::paginate(10);
        $kepala_dusun = Staf::where('jabatan', 'like', 'Kepala Dusun%')->get();
        return view('staf.infodesa.dusunManager', [
            'title' => 'Daftar Dusun',
            'dusun' => $dusun,
            'kepala_dusun' => $kepala_dusun,
        ]);
    }

    public function dusunNew()
    {
        $kepala_dusun = Staf::where('jabatan', 'like', 'Kepala Dusun%')->get();

        return view('staf.infodesa.dusunNew', [
            'title' => 'Tambah Dusun',
            'kepala_dusun' => $kepala_dusun,
        ]);
    }

    public function dusunNewSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'id_kepala_dusun' => 'required|unique:dusun',
            'no_telp_dusun' => 'nullable',
            'jumlah_rt' => 'nullable',
        ], [
            'nama.required' => 'Nama dusun wajib diisi!',
            'id_kepala_dusun.required' => 'Kepala dusun wajib diisi!',
        ]);

        Dusun::create($validatedData);

        return redirect('/staf/info-desa/dusun')->with('success', 'Dusun berhasil ditambahkan!');
    }

    public function dusunEdit($id)
    {
        $kepala_dusun = Staf::where('jabatan', 'like', 'Kepala Dusun%')->get();

        return view('staf.infodesa.dusunEdit', [
            'title' => 'Edit Dusun',
            'dusun' => Dusun::find($id),
            'kepala_dusun' => $kepala_dusun,
        ]);
    }

    public function dusunEditSubmit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'id_kepala_dusun' => 'required|unique:dusun,id,'.$id,
            'no_telp_dusun' => 'nullable',
            'jumlah_rt' => 'nullable',
        ], [
            'nama.required' => 'Nama dusun wajib diisi!',
            'id_kepala_dusun.required' => 'Kepala dusun wajib diisi!',
            'id_kepala_dusun.unique' => 'Kepala dusun sudah terdaftar pada dusun lain!'
        ]);

        Dusun::find($id)->update($validatedData);

        return redirect('/staf/info-desa/dusun')->with('success', 'Dusun berhasil diubah!');
    }

    public function dusunDelete($id)
    {
        Dusun::find($id)->delete();

        return redirect('/staf/info-desa/dusun')->with('success', 'Dusun berhasil dihapus!');
    }
}
