<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Staf;
use App\Models\User;

class StafController extends Controller
{
    public function pohonStaf()
    {
        return view('staf.manajemenStaf.pohonStaf', [
            'title' => 'Pohon Staf',
            'staf' => Staf::all(),
        ]);
    }

    public function getDataStaf()
    {  
        return response()->json(Staf::all());
    }

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
            'nama' => 'required',
            'jabatan' => 'required|unique',
            'tgl_mulai' => 'nullable',
        ]);

        Staf::create($validateData);

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
        $data = $request->all();

        $data['nama'] = ucwords(strtolower($data['nama']));
        $data['jabatan'] = ucwords(strtolower($data['jabatan']));

        $validateData = Validator::make($data, [
            'nama' => 'required',
            'jabatan' => 'required|unique:staf,jabatan,' . $id,
            'tgl_mulai' => 'nullable',
        ])->validate();

        Staf::find($id)->update($data);
        
        return redirect('/staf/manajemen-staf/daftar-staf')->with('success', 'Data staf berhasil diubah!');
    }

    public function stafDelete($id)
    {
        $data = Staf::find($id);

        if ((explode(' ', $data->jabatan)[0] == "Kepala" && explode(' ', $data->jabatan)[1] == "Dusun") ? true : false) {
            Staf::destroy($id);
        } else {
            abort(403);
        }

        return redirect('/staf/manajemen-staf/daftar-staf')->with('success', 'Staf berhasil dihapus!');
    }
}
