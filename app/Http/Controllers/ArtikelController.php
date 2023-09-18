<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Artikel;
use App\Models\Image;

class ArtikelController extends Controller
{
    public function dashboard()
    {
        return view('staf.artikel.dashboard', [
            'title' => 'Dashboard Artikel',
        ]);
    }

    public function articleManager()
    {
        return view('staf.artikel.articleManager', [
            'title' => 'Manajer Artikel',
            'artikel' => Artikel::join(
                'users', 'artikel.id_staf', '=', 'users.id'
            )->select(
                'artikel.*',
                'users.name',
            )->orderBy('updated_at', 'desc')->paginate(10),
        ]);
    }

    public function artikelNew()
    {
        return view('staf.artikel.artikelNew', [
            'title' => 'Artikel Baru',
        ]);
    }

    public function artikelNewSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'isi' => ['required', function ($attribute, $value, $fail) {
                if ($value === '<p><br></p>') {
                    $fail('Isi artikel tidak boleh kosong!');
                }
            }],
            'image' => 'array'
        ], [
        
            'judul.required' => 'Judul artikel tidak boleh kosong!',
            'isi.required' => 'Isi artikel tidak boleh kosong!',
        ]);

        $imageIds = [];
        if (isset($validatedData['image'][0])) {
            $imageIds = explode(',', $validatedData['image'][0]);
        }

        if ($imageIds) {
            foreach ($imageIds as $id) {
                $existingImage = Image::find($id);
                if ($existingImage) {
                    $newPath = 'images/' . $existingImage->filename;
                    
                    Storage::disk('public')->move($existingImage->path, $newPath);
                    Image::find($id)->update(['path' => $newPath]);
                }
            }
        }

        $newIsi = preg_replace_callback('/src="((?:https?:\/\/)?[^"]*\/storage\/temps\/.*?)"/', function ($matches) {
            $imageUrl = $matches[1];
            $imageName = basename($imageUrl); // Extract the image filename from the URL
            return 'src="' . url('storage/images/' . $imageName) . '"';
        }, $validatedData['isi']);
        
        $data = [
            'id_staf' => auth()->user()->id,
            'judul' => $validatedData['judul'],
            'isi' => $newIsi,
            'is_active' => $request->input('is_active', false),
        ];

        Artikel::create($data);

        return redirect('/staf/manajemen-web/artikel')->with('success', 'Berhasil menambahkan artikel!');
    }

    public function artikelEdit($id)
    {
        $artikel = Artikel::find($id);

        return view('staf.artikel.artikelEdit', [
            'title' => 'Edit Artikel',
            'artikel' => $artikel,
        ]);
    }

    public function artikelEditSubmit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'isi' => ['required', function ($attribute, $value, $fail) {
                if ($value === '<p><br></p>') {
                    $fail('Isi artikel tidak boleh kosong!');
                }
            }],
            'image' => 'array'
        ], [
        
            'judul.required' => 'Judul artikel tidak boleh kosong!',
            'isi.required' => 'Isi artikel tidak boleh kosong!',
        ]);

        $imageIds = [];
        if (isset($validatedData['image'][0])) {
            $imageIds = explode(',', $validatedData['image'][0]);
        }

        if ($imageIds) {
            foreach ($imageIds as $id) {
                $existingImage = Image::find($id);
                if ($existingImage) {
                    $newPath = 'images/' . $existingImage->filename;
                    
                    Storage::disk('public')->move($existingImage->path, $newPath);
                    Image::find($id)->update(['path' => $newPath]);
                }
            }
        }

        $newIsi = preg_replace_callback('/src="((?:https?:\/\/)?[^"]*\/storage\/temps\/.*?)"/', function ($matches) {
            $imageUrl = $matches[1];
            $imageName = basename($imageUrl); // Extract the image filename from the URL
            return 'src="' . url('storage/images/' . $imageName) . '"';
        }, $validatedData['isi']);
        
        $data = [
            'id_staf' => auth()->user()->id,
            'judul' => $validatedData['judul'],
            'isi' => $newIsi,
            'is_active' => $request->input('is_active', false),
        ];

        $artikel = Artikel::find($id)->update($data);

        return redirect('/staf/manajemen-web/artikel')->with('success', 'Artikel berhasil diubah!');
    }

    public function artikelDelete($id)
    {
        Artikel::destroy($id);

        return redirect('/staf/manajemen-web/artikel')->with('success', 'Artikel berhasil dihapus');
    }

    public function storeImage(Request $request)
    {
        $MAX_IMAGE_SIZE = 10240;     // ukuran gambar maksimal (KB)

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:'.$MAX_IMAGE_SIZE,
        ], [
            'image.image' => 'File yang diupload harus berupa gambar!',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari '.($MAX_IMAGE_SIZE / 1024).'MB'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $image = $request->file('image');
        $imageHash = md5(file_get_contents($image)); // Generate a hash based on the image content

        $existingImage = Image::where('hash', $imageHash)->first();

        if ($existingImage) {
            return response()->json([
                'success' => true,
                'image' => [
                    'id_gambar' => $existingImage->id,
                    'url' => asset('storage/' . $existingImage->path),
                ],
            ]);
        } else {
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('temps', $filename, 'public');

            $newImage = new Image();
            $newImage->filename = $filename;
            $newImage->path = $path;
            $newImage->hash = $imageHash;
            $newImage->save();

            return response()->json([
                'success' => true,
                'image' => [
                    'id_gambar' => $newImage->id,
                    'url' => asset('storage/' . $newImage->path),
                ],
            ]);
        }
    }
}
