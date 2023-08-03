<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoDesaController extends Controller
{
    public function identitasDesa()
    {
        return view('staf.infodesa.identitasDesa', [
            'title' => 'Identitas Desa',
        ]);
    }

    public function identitasDesaEdit()
    {
        return view('staf.infodesa.identitasDesaEdit', [
            'title' => 'Identitas Desa - Ubah Data',
        ]);
    }
}
