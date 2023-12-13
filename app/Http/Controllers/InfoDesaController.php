<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\IdentitasDesa;
use App\Models\Image;
use App\Models\WilayahDusun;
use App\Models\Staf;
use App\models\Coordinate;
use App\Models\HelperDusun;
use App\Models\HelperRt;
use App\Models\Penduduk;
use App\Models\WilayahRt;
use Illuminate\Validation\Rule;

class InfoDesaController extends Controller
{
    public function showDataDesa()
    {
        $dataDesa = IdentitasDesa::first(); // Assuming you want to retrieve the first record. You can use other methods like find() or where() as per your requirement.
        $title = 'Identitas Desa'; // Add the title variable here.
        $lambangModel = Image::firstWhere('filename', 'LIKE', 'foto_lambang%');
        $lambangUrl = asset('storage/' . $lambangModel->path);
        $kantorModel = Image::firstWhere('filename', 'LIKE', 'kantor_desa%');
        $kantorUrl = asset('storage/' . $kantorModel->path);

        return view('staf.infodesa.identitasDesa', compact('dataDesa', 'title', 'lambangUrl', 'kantorUrl'));
    }

    public function editDataDesa()
    {
        $dataDesa = IdentitasDesa::first(); // Replace 'Desa' with your actual model name and fetch the necessary data from the database.
        $title = 'Identitas Desa'; // Add the title variable here.

        return view('staf.infodesa.identitasDesaEdit', compact('dataDesa', 'title'));
    }

    public function updateDataDesa(Request $request)
    {
        $MAX_IMAGE_SIZE = 10240;

        // Update the attributes with the data from the form submission
        $dataDesa = $request->validate([
            'nama_desa' => 'required',
            'kode_desa' => 'required',
            'kode_pos_desa' => 'nullable',
            'nama_kepala_desa' => 'required',
            'nip_kepala_desa' => 'nullable',
            'alamat_kantor' => 'nullable',
            'email_desa' => 'nullable|email:rfc,dns',
            'telepon' => 'nullable|numeric',
            'website' => 'nullable',
            'nama_kecamatan' => 'nullable',
            'kode_kecamatan' => 'nullable',
            'nama_kepala_camat' => 'nullable',
            'nip_kepala_camat' => 'nullable',
            'nama_kabupaten' => 'nullable',
            'kode_kabupaten' => 'nullable',
            'nama_provinsi' => 'nullable',
            'kode_provinsi' => 'nullable',
            'foto_lambang' => 'nullable|image|max:' . $MAX_IMAGE_SIZE,
            'kantor_desa' => 'nullable|image|max:' . $MAX_IMAGE_SIZE,
        ], [
            'nama_desa.required' => 'Nama desa harus diisi!',
            'kode_desa.required' => 'Kode desa harus diisi!',
            'nama_kepala_desa.required' => 'Nama Kepala Desa harus diisi!',
            'email_desa.email' => 'Email yang diisi tidak valid!',
            'telepon.numeric' => 'Nomor telepon yang diisi tidak valid!',
            'foto_lambang.image' => 'File lambang desa harus berupa gambar!',
            'foto_lambang.max' => 'Ukuran file tidak boleh lebih dari ' . ($MAX_IMAGE_SIZE / 1024) . 'MB',
            'kantor_desa.image' => 'File kantor desa harus berupa gambar!',
            'kantor_desa.max' => 'Ukuran gambar tidak boleh lebih dari ' . ($MAX_IMAGE_SIZE / 1024) . 'MB',
        ]);

        // Update other attributes as needed
        IdentitasDesa::first()->save($dataDesa);

        if ($request->hasFile('foto_lambang')) {
            $fotoLambang = $request->file('foto_lambang');
            $fotoLambangHash = md5(file_get_contents($fotoLambang));
            $fotoLambangFilename = 'foto_lambang.' . $fotoLambang->getClientOriginalExtension();
            Image::updateOrInsert([
                ['filename', 'LIKE', 'foto_lambang%']
            ], [
                'filename' => $fotoLambangFilename,
                'hash' => $fotoLambangHash,
                'path' => '/images/identitas_desa/' . $fotoLambangFilename,
            ]);
            $fotoLambang->move(public_path('storage/images/identitas_desa/'), $fotoLambangFilename);
        }

        if ($request->hasFile('kantor_desa')) {
            $kantorDesa = $request->file('kantor_desa');
            $kantorDesaHash = md5(file_get_contents($kantorDesa));
            $fotoKantorFilename = 'kantor_desa.' . $kantorDesa->getClientOriginalExtension();
            Image::updateOrInsert([
                'filename', 'LIKE', 'kantor_desa%'
            ], [
                'filename' => $fotoKantorFilename,
                'hash' => $kantorDesaHash,
                'path' => '/images/identitas_desa/' . $fotoKantorFilename,
            ]);
            $kantorDesa->move(public_path('storage/images/identitas_desa/'), $fotoKantorFilename);
        }

        // return back()->with('success', 'Desa data updated successfully!');

        return redirect()
            ->route('desa.data')
            ->with('success', 'Data desa telah diperbarui!');
    }

    public function showLokasiKantor()
    {
        $coordinate = Coordinate::where('nama', 'kantor_desa')->first();
        $location = DB::selectOne('SELECT X(coordinate) as lat, Y(coordinate) as lng FROM coordinates WHERE id = ?', [$coordinate->id]);

        return view('staf.infodesa.lokasiKantorDesa', [
            'title' => 'Lokasi Kantor Desa',
            'lat' => $location->lat,
            'lng' => $location->lng,
            'zoom' => $coordinate->zoom,
        ]);
    }

    public function editLokasiKantor()
    {
        return view('staf.infodesa.lokasiKantorDesaEdit', [
            'title' => 'Ubah Lokasi Kantor Desa',
        ]);
    }

    public function updateLokasiKantor(Request $request)
    {
        $validatedData = $request->validate([
            'lat' => 'required',
            'lng' => 'required',
            'zoom' => 'nullable',
        ]);

        $latitude = $validatedData['lat'];
        $longitude = $validatedData['lng'];
        $coordinate = Coordinate::where('nama', 'kantor_desa')->first();

        $coordinate->update([
            'coordinate' => DB::raw("POINT($latitude, $longitude)"),
            'zoom' => $validatedData['zoom'],
        ]);

        return redirect()
            ->route('desa.kantorDesa')
            ->with('success', 'Lokasi kantor berhasil diubah!');
    }

    public function showPetaWilayah()
    {
        $coordinate = Coordinate::where('nama', 'center')->first();
        $location = DB::selectOne('SELECT X(coordinate) as lat, Y(coordinate) as lng FROM coordinates WHERE id = ?', [$coordinate->id]);

        return view('staf.infodesa.petaWilayah', [
            'title' => 'Peta Wilayah',
            'koordinat' => Storage::get('koordinat_wilayah/coordinates.json'),
            'lat' => $location->lat,
            'lng' => $location->lng,
            'zoom' => $coordinate->zoom,
        ]);
    }

    public function editPetaWilayah()
    {
        return view('staf.infodesa.petaWilayahEdit', [
            'title' => 'Ubah Peta Wilayah',
        ]);
    }

    public function updatePetaWilayah(Request $request)
    {
        $validatedData = $request->validate([
            'lat' => 'nullable',
            'lng' => 'nullable',
            'zoom' => 'nullable',
            'geojson' => 'required'
        ]);

        if ($request->hasFile('geojson')) {
            $file = $request->file('geojson');
            $filename = 'coordinates.geojson';

            $file->storeAs('koordinat_wilayah', $filename);

            $latitude = $validatedData['lat'];
            $longitude = $validatedData['lng'];

            $coordinate = Coordinate::where('nama', 'center')->first();
            $coordinate->coordinate = DB::raw("POINT($latitude, $longitude)");
            $coordinate->save();

            return redirect()
                ->route('desa.petaWilayah')
                ->with('success', 'Peta wilayah berhasil diubah!');
        } else {
            return redirect()
                ->route('desa.petaWilayah')
                ->with('error', 'Gagal mengunggah file. Pastikan file terlampir.');
        }
    }

    public function dusunManager()
    {
        // $dusun = HelperDusun::paginate(10);
        $dusun = HelperDusun::leftJoin('wilayah_dusun', 'wilayah_dusun.id_helper_dusun', '=', 'helper_dusun.id')
            ->leftJoin('penduduk as kepala_dusun', 'kepala_dusun.nik', '=', 'helper_dusun.nik_kepala')
            ->leftJoin('wilayah_rt', 'wilayah_rt.id_wilayah_dusun', '=', 'wilayah_dusun.id')
            ->select(
                'helper_dusun.nik_kepala',
                'kepala_dusun.nama as nama_kepala_dusun',
                'wilayah_dusun.nama as nama_dusun',
                DB::raw('(SELECT COUNT(*) FROM wilayah_rt WHERE wilayah_rt.id_wilayah_dusun = wilayah_dusun.id) as jumlah_rt')
            )
            ->paginate(10);

        return view('staf.infodesa.dusunManager', [
            'title' => 'Daftar Dusun',
            'dusun' => $dusun,
        ]);
    }

    public function dusunNew()
    {
        $kepala_dusun = Staf::where('jabatan', 'like', 'Kepala Dusun%')->get();

        return view('staf.infodesa.dusunNew', [
            'title' => 'Tambah Dusun',
            'kepala_dusun' => $kepala_dusun,
            'helper_dusun' => HelperDusun::all(),
            'penduduk' => Penduduk::all(),
        ]);
    }

    public function dusunNewSubmit(Request $request)
    {
        $validatedCommonData = $request->validate([
            'nik_kepala' => [
                'required',
                Rule::exists('penduduk', 'nik'),
            ],
        ]);

        $helperDusun = HelperDusun::create($validatedCommonData);

        $validatedSpecificData = $request->validate([
            'nama' => 'nullable',
        ]);

        if (isset($validatedSpecificData['nama'])) {
            $validatedSpecificData['nama'] = strtoupper($validatedSpecificData['nama']);
        }

        // Include id_helper_dusun in the data array
        $validatedSpecificData['id_helper_dusun'] = $helperDusun->id;

        // Create new WilayahDusun
        $dusun = WilayahDusun::create($validatedSpecificData);

        // Update id_wilayah_dusun and set id_wilayah_rt to null in Penduduk
        Penduduk::where('nik', $validatedCommonData['nik_kepala'])
            ->update([
                'id_wilayah_dusun' => $dusun->id,
                'id_wilayah_rt' => null,
            ]);

        return redirect('/staf/info-desa/dusun')->with('success', 'Dusun berhasil ditambahkan!');
    }


    public function dusunEdit($id)
    {
        $kepala_dusun = Staf::where('jabatan', 'like', 'Kepala Dusun%')->get();

        return view('staf.infodesa.dusunEdit', [
            'title' => 'Edit Dusun',
            'dusun' => WilayahDusun::find($id),
            'kepala_dusun' => $kepala_dusun,
        ]);
    }

    public function dusunEditSubmit(Request $request, HelperDusun $helperDusun)
    {
        // Validasi untuk 'no_kk' dan 'nik_kepala' di tabel helper_penduduk_keluarga
        $validatedCommonData = $request->validate([
            'nik_kepala' => [
                'required',
                Rule::exists('penduduk', 'nik'),
            ],
        ]);


        // Validasi untuk tabel keluarga
        $validatedSpecificData = $request->validate([
            'nama' => 'nullable',
        ]);

        // Update data di tabel helper_penduduk_keluarga
        $helperDusun->update($validatedCommonData);

        if (isset($validatedSpecificData['nama'])) {
            $validatedSpecificData['nama'] = strtoupper($validatedSpecificData['nama']);
        }

        // Update data di tabel keluarga
        WilayahDusun::where('id_helper_dusun', $helperDusun->id)
            ->update($validatedSpecificData);

        // Update id_helper_penduduk_keluarga di tabel penduduk
        Penduduk::where('nik', $validatedCommonData['nik_kepala'])
            ->update([
                'id_wilayah_dusun' => $helperDusun->id,
            ]);

        return redirect('/staf/info-desa/dusun')->with('success', 'Dusun berhasil diubah!');
    }

    public function dusunDelete(HelperDusun $helperDusun)
    {
        // Perbarui id_wilayah_dusun dan id_wilayah_rt di Penduduk
        Penduduk::where('id_wilayah_dusun', $helperDusun->id)
            ->update([
                'id_wilayah_dusun' => null,
                'id_wilayah_rt' => null,
            ]);

        // Ambil data wilayah dusun yang sesuai dengan id_helper_dusun yang akan dihapus
        $dusun = WilayahDusun::where('id_helper_dusun', $helperDusun->id)->first();

        // Hapus data di tabel wilayah dusun
        if ($dusun) {
            $dusun->delete();
        }

        // Hapus data di tabel helper_penduduk_keluarga
        $helperDusun->delete();

        return redirect('/staf/info-desa/dusun')->with('success', 'Dusun berhasil dihapus!');
    }


    public function rtManager(WilayahDusun $wilayahDusun)
    {
        // Ambil data wilayah dusun berdasarkan id
        $dusun = WilayahDusun::findOrFail($wilayahDusun->id);

        // Ambil data RT berdasarkan id wilayah dusun
        $rt = WilayahRt::where('wilayah_rt.id_wilayah_dusun', $dusun->id)
            ->leftJoin('helper_rt', 'wilayah_rt.id_helper_rt', '=', 'helper_rt.id')
            ->leftJoin('penduduk as kepala_rt', 'kepala_rt.nik', '=', 'helper_rt.nik_kepala')
            ->select(
                'wilayah_rt.nama as nama_rt',
                'helper_rt.nik_kepala',
                'kepala_rt.nama as nama_kepala_rt'
            )
            ->paginate(10);

        // dd($rt);

        return view('staf.infodesa.rtManager', [
            'title' => 'Daftar RT - ' . $dusun->nama,
            'rt' => $rt,
            'dusun' => $dusun,
        ]);
    }

    public function rtNewSubmit(Request $request, $id_wilayah_dusun)
    {
        $validatedCommonData = $request->validate([
            'nik_kepala' => [
                'required',
                Rule::exists('penduduk', 'nik'),
            ],
        ]);

        $helperRt = HelperRt::create($validatedCommonData);

        $validatedSpecificData = $request->validate([
            'nama' => 'nullable',
        ]);

        if (isset($validatedSpecificData['nama'])) {
            $validatedSpecificData['nama'] = strtoupper($validatedSpecificData['nama']);
        }

        $validatedSpecificData['id_helper_rt'] = $helperRt->id;

        // Set the id_wilayah_dusun from the parameter
        $validatedSpecificData['id_wilayah_dusun'] = $id_wilayah_dusun;

        $rt = WilayahRt::create($validatedSpecificData);

        // Update id_wilayah_rt in the Penduduk table
        Penduduk::where('nik', $validatedCommonData['nik_kepala'])
            ->update([
                'id_wilayah_rt' => $helperRt->id,
            ]);

        return redirect('/staf/info-desa/rt/' . $id_wilayah_dusun)->with('success', 'RT berhasil ditambahkan!');
    }

    public function rtDelete($id_wilayah_dusun, HelperRt $helperRt)
    {
        // Perbarui id_wilayah_dusun dan id_wilayah_rt di Penduduk
        Penduduk::where('id_wilayah_rt', $helperRt->id)
            ->update([
                'id_wilayah_rt' => null,
            ]);

        // Ambil data wilayah rt yang sesuai dengan id_helper_rt yang akan dihapus
        $rt = WilayahRt::where('id_helper_rt', $helperRt->id)->first();

        // Hapus data di tabel wilayah rt
        if ($rt) {
            $rt->delete();
        }

        // Hapus data di tabel helper_penduduk_keluarga
        $helperRt->delete();

        return redirect('/staf/info-desa/rt/' . $id_wilayah_dusun)->with('success', 'RT berhasil dihapus!');
    }
}
