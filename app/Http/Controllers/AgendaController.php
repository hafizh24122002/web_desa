<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Http\Controllers\Image;
use App\Models\Artikel;

class AgendaController extends Controller
{
    public function dashboard()
    {
        return view('staf.artikel.dashboard', [
            'title' => 'Dashboard Artikel',
        ]);
    }

    public function agendaManager()
    {
        return view('staf.agenda.agendaManager', [
            'title' => 'Manajer Agenda',
            'artikel' => Agenda::select('*')
                ->orderBy('updated_at', 'desc')
                ->paginate(10),
        ]);
    }

    public function agendaNew()
    {
        return view('staf.agenda.agendaNew', [
            'title' => 'Agenda Baru',
        ]);
    }

    public function agendaNewSubmit(Request $request)
    {
        $validatedData = $request->validate(
            [
                'judul' => 'required',
                'content' => 'required',
                'tgl_agenda' => 'required|date',
                'lokasi' => 'required',
            ],
            [
                'judul.required' => 'Judul artikel tidak boleh kosong!',
                'isi.required' => 'Isi artikel tidak boleh kosong!',
                'tgl_agenda.required' => 'Tanggal kegiatan harus diisi!',
                'tgl_agenda.date' => 'Format tanggal kegiatan tidak valid!',
                'lokasi' => 'Lokasi tidak boleh kosong!',
            ],
        );

        $data = [
            'id_staf' => auth()->user()->id,
            'judul' => $validatedData['judul'],
            'isi' => $validatedData['content'],
            'tgl_agenda' => $validatedData['tgl_agenda'],
            'lokasi' => $validatedData['lokasi'],
            'koordinator' => $request->input('koordinator'),
            'is_active' => $request->input('is_active', false),
        ];

        Agenda::create($data);

        return redirect('/staf/manajemen-web/agenda')->with('success', 'Berhasil menambahkan agenda!');
    }

    public function agendaEdit($id)
    {
        $artikel = Agenda::find($id);

        return view('staf.agenda.agendaEdit', [
            'title' => 'Edit Agenda',
            'artikel' => $artikel,
        ]);
    }

    public function agendaEditSubmit(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'judul' => 'required',
                'content' => 'required',
                'tgl_agenda' => 'required|date',
                'lokasi' => 'required',
            ],
            [
                'judul.required' => 'Judul artikel tidak boleh kosong!',
                'isi.required' => 'Isi artikel tidak boleh kosong!',
                'tgl_agenda.required' => 'Tanggal kegiatan harus diisi!',
                'tgl_agenda.date' => 'Format tanggal kegiatan tidak valid!',
                'lokasi' => 'Lokasi tidak boleh kosong!',
            ],
        );

        $data = [
            'id_staf' => auth()->user()->id,
            'judul' => $validatedData['judul'],
            'isi' => $validatedData['content'],
            'tgl_agenda' => $validatedData['tgl_agenda'],
            'koordinator' => $request->input('koordinator'),
            'is_active' => $request->input('is_active', false),
        ];

        $artikel = Agenda::find($id)->update($data);
        return redirect('/staf/manajemen-web/agenda')->with('success', 'Agenda berhasil diubah!');
    }

    public function agendaDelete($id)
    {
        Agenda::destroy($id);

        return redirect('/staf/manajemen-web/agenda')->with('success', 'Agenda berhasil dihapus');
    }

    // public function storeImage(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|image|max:20480',
    //     ]);

    //     $image = $request->file('image');
    //     $filename = Str::random(40) . '.' . $image->getClientOriginalExtension();
    //     $path = $image->storeAs('images', $filename, 'public');

    //     $newImage = new Image();
    //     $newImage->filename = $filename;
    //     $newImage->path = $path;
    //     $newImage->user_id = auth()->id();
    //     $newImage->save();

    //     return response()->json([
    //         'success' => true,
    //         'image' => [
    //             'id' => $newImage->id,
    //             'url' => asset('storage/' . $path),
    //         ],
    //     ]);
    // }

    public function showAgendaList()
    {
        $agendaList = Agenda::select('judul', 'waktu', 'lokasi', 'koordinator')->get();
        return view('agendaList', ['agendaList' => $agendaList]);
    }
}
