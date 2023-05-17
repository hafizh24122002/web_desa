<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staf;
use App\Models\User;

class StafController extends Controller
{
    public function daftarStaf()
    {
        return view('staf.manajemenStaf.daftarStaf', [
            'title' => 'Daftar Staf',
            'staf' => Staf::paginate(10),
            'user' => User::all(),
        ]);
    }

    public function stafNew()
    {
        return view('staf.manajemenStaf.stafNew', [
            'title' => 'Staf Baru',
        ]);
    }

    public function stafNewSubmit(Request $request)
    {
        $validateData = $request->validate([
            'nip' => 'numeric',
            'nama' => 'required',
        ]);

        $data = [
            'nip' => $validateData['nip'],
            'nama' => $validateData['nama'],
            'jabatan' => $request->input('jabatan'),
        ];

        Staf::create($data);

        return redirect('/staf/manajemen-staf/daftar-staf')->with('success', 'Staf berhasil ditambahkan!');
    }

    public function stafEdit($id)
    {
        $staf = Staf::find($id);

        return view('staf.manajemenStaf.stafEdit', [
            'title' => 'Edit Staf',
            'staf' => $staf,
        ]);
    }

    public function stafEditSubmit(Request $request, $id)
    {
        $validateData = $request->validate([
            'nip' => 'numeric',
            'nama' => 'required',
        ]);

        $data = [
            'nip' => $validateData['nip'],
            'nama' => $validateData['nama'],
            'jabatan' => $request->input('jabatan'),
        ];

        Staf::find($id)->update($data);
        
        return redirect('/staf/manajemen-staf/daftar-staf')->with('success', 'Data staf berhasil diubah!');
    }

    public function stafDelete($id)
    {
        Staf::destroy($id);

        return redirect('/staf/manajemen-staf/daftar-staf')->with('success', 'Staf berhasil dihapus!');
    }
}
