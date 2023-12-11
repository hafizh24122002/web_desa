<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Banner;
use App\Models\Image;

class BannerController extends Controller
{
    public function bannerManager()
    {
        return view('staf.banner.bannerManager', [
            'title' => 'Manajer Banner',
            'banner' => Banner::orderBy('no_urut', 'asc')->get(),
        ]);
    }

    public function bannerNew()
    {
        $noUrutTerakhir = (Banner::max('no_urut') + 1);

        if (!$noUrutTerakhir) {
            $noUrutTerakhir = 1;
        }

        return view('staf.banner.bannerNew', [
            'title' => 'Halaman Banner Baru',
            'no_urut_terakhir' => $noUrutTerakhir,
        ]);
    }

    public function bannerNewSubmit(Request $request)
    {
        $MAX_IMAGE_SIZE = 10240;

        $validatedData = $request->validate([
            'no_urut' => 'required|unique:banner,no_urut',
            'judul' => 'required',
            'deskripsi' => 'required',
            'id_image' => 'required|image|max:'.$MAX_IMAGE_SIZE,
        ], [
            'no_urut.required' => 'Nomor urut tidak boleh kosong!',
            'no_urut.unique' => 'Nomor urut sudah terdaftar!',
            'judul.required' => 'Judul tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
            'id_image.required' => 'Gambar tidak boleh kosong!',
            'id_image.max' => 'Ukuran gambar tidak boleh lebih besar dari '.($MAX_IMAGE_SIZE / 1024).'MB'
        ]);

        $gambar = $request->file('id_image');
        $gambarHash = md5(file_get_contents($gambar));

        $existingImage = Image::where('hash', $gambarHash)->first();
        if ($existingImage) {
            $validatedData['id_image'] = $existingImage->id;
        } else {
            $gambarFilename = 'banner_'.$validatedData['no_urut'].'_'.Carbon::now()->format('Y-m-d').'.'.$gambar->getClientOriginalExtension();

            $gambarModel = Image::create([
                'filename' => $gambarFilename,
                'hash' => $gambarHash,
                'path' => 'images/banner/'.$gambarFilename,
            ]);
            $gambar->move(public_path('storage/images/banner/'), $gambarFilename);

            $validatedData['id_image'] = $gambarModel->id;
        }

        Banner::create($validatedData);

        return redirect('/staf/manajemen-web/banner')->with('success', 'Halaman banner berhasil ditambahkan!');
    }

    public function bannerEdit($no_urut)
    {
        return view('staf.banner.bannerEdit', [
            'title' => 'Halaman Banner Baru',
            'banner' => Banner::where('no_urut', $no_urut)->first(),
        ]);
    }

    public function bannerEditSubmit(Request $request, $no_urut)
    {
        $MAX_IMAGE_SIZE = 10240;

        $banner = Banner::where('no_urut', $no_urut)->first();

        $validatedData = $request->validate([
            'no_urut' => 'required|unique:banner,no_urut,'.$banner->id,
            'judul' => 'required',
            'deskripsi' => 'required',
            'id_image' => 'nullable|image|max:'.$MAX_IMAGE_SIZE,
        ], [
            'no_urut.required' => 'Nomor urut tidak boleh kosong!',
            'no_urut.unique' => 'Nomor urut sudah terdaftar!',
            'judul.required' => 'Judul tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
            'id_image.max' => 'Ukuran gambar tidak boleh lebih besar dari '.($MAX_IMAGE_SIZE / 1024).'MB'
        ]);

        if ($banner->no_urut === 1) {
            $validatedData['no_urut'] = 1;
        }

        $gambar = $request->file('id_image');
        if ($gambar) {
            $gambarHash = md5(file_get_contents($gambar));

            $existingImage = Image::where('hash', $gambarHash)->first();
            if ($existingImage) {
                $validatedData['id_image'] = $existingImage->id;
            } else {
                $gambarFilename = 'banner_'.$validatedData['no_urut'].'_'.Carbon::now()->format('Y-m-d').'.'.$gambar->getClientOriginalExtension();

                $gambarModel = Image::create([
                    'filename' => $gambarFilename,
                    'hash' => $gambarHash,
                    'path' => 'images/banner/'.$gambarFilename,
                ]);
                $gambar->move(public_path('storage/images/banner/'), $gambarFilename);

                $validatedData['id_image'] = $gambarModel->id;
            }
        }

        $banner->update($validatedData);

        return redirect('/staf/manajemen-web/banner')->with('success', 'Halaman banner berhasil diubah!');
    }

    public function bannerDelete($id)
    {
        if ($id !== 1) {
            Banner::destroy($id);
            return redirect('/staf/manajemen-web/banner')->with('success', 'Halaman banner berhasil dihapus!');
        }

        abort(403);
    }
}
