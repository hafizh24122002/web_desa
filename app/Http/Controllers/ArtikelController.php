<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Artikel;
use App\Models\ArtikelView;
use App\Models\Dokumen;
use App\Models\DokumenDownload;
use App\Models\Image;

class ArtikelController extends Controller
{
    public function dashboard()
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        // fetch data for all the cards and charts
        $artikel_total = Artikel::where('is_active', '=', 1)->count();
        $artikel_bulan = Artikel::where('is_active', '=', 1)->whereMonth('created_at', now()->month)->count();
        $artikel_views_bulan = ArtikelView::whereMonth('created_at', now()->month)->count();

        $artikel_hari = Artikel::where('is_active', '=', 1)->whereMonth('created_at', now()->month)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();
        $artikel_views_hari = ArtikelView::whereMonth('created_at', now()->month)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();

        $dokumen_total = Dokumen::where('is_active', '=', 1)->count();
        $dokumen_download_bulan = DokumenDownload::whereMonth('created_at', now()->month)->count();

        $datesInMonth = [];
        $currentDate = $currentMonthStart;
        while ($currentDate <= $currentMonthEnd) {
            $datesInMonth[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        $mergedDataArtikel = [];
        foreach ($datesInMonth as $date) {
            $found = false;
            foreach ($artikel_hari as $entry) {
                if ($entry->date === $date) {
                    $mergedDataArtikel[] = [
                        'date' => $date,
                        'count' => $entry->count,
                    ];
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $mergedDataArtikel[] = [
                    'date' => $date,
                    'count' => 0,
                ];
            }
        }

        $mergedDataViews = [];
        foreach ($datesInMonth as $date) {
            $found = false;
            foreach ($artikel_views_hari as $entry) {
                if ($entry->date === $date) {
                    $mergedDataViews[] = [
                        'date' => $date,
                        'count' => $entry->count,
                    ];
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $mergedDataViews[] = [
                    'date' => $date,
                    'count' => 0,
                ];
            }
        }

        return view('staf.artikel.dashboard', [
            'title' => 'Dashboard Artikel',
            'artikel_total' => $artikel_total,
            'artikel_bulan' => $artikel_bulan,
            'artikel_views_bulan' => $artikel_views_bulan,
            'artikel_hari' => $mergedDataArtikel,
            'artikel_views_hari' => $mergedDataViews,
            'dokumen_total' => $dokumen_total,
            'dokumen_download_bulan' => $dokumen_download_bulan
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
        // validate
        $validatedData = $request->validate([
            'judul' => 'required|unique:artikel,judul',
            'isi' => ['required', function ($attribute, $value, $fail) {
                if ($value === '<p><br></p>') {
                    $fail('Isi artikel tidak boleh kosong!');
                }
            }],
            'id_cover' => 'nullable',
            'image' => 'array'
        ], [
            'judul.required' => 'Judul artikel tidak boleh kosong!',
            'judul.unique' => 'Judul artikel tidak boleh sama dengan artikel yang sudah ada!',
            'isi.required' => 'Isi artikel tidak boleh kosong!',
        ]);

        // store images in `isi`
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

        // replace img src from storage/temps/ directory to storage/images/
        $newIsi = preg_replace_callback('/src="((?:https?:\/\/)?[^"]*\/storage\/temps\/.*?)"/', function ($matches) {
            $imageUrl = $matches[1];
            $imageName = basename($imageUrl); // Extract the image filename from the URL
            return 'src="' . url('storage/images/' . $imageName) . '"';
        }, $validatedData['isi']);

        // store cover image
        $cover = $request->file('id_cover');
        if ($cover) {
            $coverHash = md5(file_get_contents($cover));

            $existingCoverImage = Image::where('hash', $coverHash)->first();
            if ($existingCoverImage) {
                $validatedData['id_cover'] = $existingCoverImage->id;
            } else {
                $coverFilename = 'artikel_'.Str::slug($validatedData['judul'], '_').Carbon::now()->format('Y-m-d').'.'.$cover->getClientOriginalExtension();

                $coverModel = Image::create([
                    'filename' => $coverFilename,
                    'hash' => $coverHash,
                    'path' => 'images/artikel/'.$coverFilename,
                ]);
                $cover->move(public_path('storage/images/artikel/'), $coverFilename);
                $validatedData['id_cover'] = $coverModel->id;
            }
        } else {
            $validatedData['id_cover'] = 1;
        }
        
        $data = [
            'id_staf' => auth()->user()->id_staf,
            'judul' => $validatedData['judul'],
            'isi' => $newIsi,
            'id_cover' => $validatedData['id_cover'],
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
        $artikel = Artikel::find($id);

        $validatedData = $request->validate([
            'judul' => 'required|unique:artikel,judul,'.$id,
            'isi' => ['required', function ($attribute, $value, $fail) {
                if ($value === '<p><br></p>') {
                    $fail('Isi artikel tidak boleh kosong!');
                }
            }],
            'id_cover' => 'nullable',
            'image' => 'array'
        ], [
        
            'judul.required' => 'Judul artikel tidak boleh kosong!',
            'judul.unique' => 'Judul artikel tidak boleh sama dengan artikel yang sudah ada!',
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

        // store cover image
        $cover = $request->file('id_cover');
        if ($cover) {
            $coverHash = md5(file_get_contents($cover));

            $existingCoverImage = Image::where('hash', $coverHash)->first();
            if ($existingCoverImage) {
                $validatedData['id_cover'] = $existingCoverImage->id;
            } else {
                $coverFilename = 'artikel_'.Str::slug($validatedData['judul'], '_').Carbon::now()->format('Y-m-d').'.'.$cover->getClientOriginalExtension();

                $coverModel = Image::create([
                    'filename' => $coverFilename,
                    'hash' => $coverHash,
                    'path' => 'images/artikel/'.$coverFilename,
                ]);
                $cover->move(public_path('storage/images/artikel/'), $coverFilename);
                $validatedData['id_cover'] = $coverModel->id;
            }
        } else {
            $validatedData['id_cover'] = $artikel->id_cover;
        }
        
        $data = [
            'id_staf' => auth()->user()->id_staf,
            'judul' => $validatedData['judul'],
            'isi' => $newIsi,
            'id_cover' => $validatedData['id_cover'],
            'is_active' => $request->input('is_active', false),
        ];

        $artikel->update($data);

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
