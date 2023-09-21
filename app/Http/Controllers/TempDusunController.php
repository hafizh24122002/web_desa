<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\identitasDesa;

class TempDusunController extends Controller
{
    public function dataDusun()
    {
        return view('staf.infodesa.dusun', [
            'title' => 'Dusun',
        ]);
    }

    public function DusunNew()
    {
        return view('staf.infodesa.dusunNew', [
            'title' => 'Tambah Dusun',
        ]);
    }

    public function DusunEdit()
    {
        return view('staf.infodesa.dusunEdit', [
            'title' => 'Edit Dusun',
        ]);
    }
}
