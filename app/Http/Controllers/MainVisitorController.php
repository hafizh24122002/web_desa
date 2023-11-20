<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\ArtikelView;
use App\Models\Agenda;
use App\Models\Staf;
use App\Models\Agama;
use App\Models\KelasSosial;
use App\Models\Keluarga;
use App\Models\Kewarganegaraan;
use App\Models\Pekerjaan;
use App\Models\PendidikanTerakhir;
use App\Models\Penduduk;
use App\Models\StatusPerkawinan;
use App\Models\Dokumen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MainVisitorController extends Controller
{
    public function index()
    {
        $artikel = Artikel::join(
            'users',
            'artikel.id_staf',
            '=',
            'users.id'
        )->select(
            'artikel.*',
            'users.name'
        )->where(
            'is_active',
            '=',
            1
        )->orderBy('updated_at', 'desc')->paginate(5);

        $currentDate = Carbon::now();

        // Mengelompokkan agenda yang sudah lewat dan agenda yang akan datang
        $pastAgenda = Agenda::select('judul', 'tgl_agenda', 'lokasi', 'koordinator')
            ->where('tgl_agenda', '<', $currentDate)
            ->orderBy('tgl_agenda', 'desc')
            ->get();

        $upcomingAgenda = Agenda::select('judul', 'tgl_agenda', 'lokasi', 'koordinator')
            ->where('tgl_agenda', '>', $currentDate)
            ->orderBy('tgl_agenda')
            ->get();

        // Ubah format tgl_agenda menggunakan translatedFormat('jS F Y')
        foreach ($pastAgenda as $agenda) {
            $agenda->tgl_agenda = Carbon::parse($agenda->tgl_agenda)->translatedFormat('jS F Y');
        }

        foreach ($upcomingAgenda as $agenda) {
            $agenda->tgl_agenda = Carbon::parse($agenda->tgl_agenda)->translatedFormat('jS F Y');
        }

        // Statistik
        $penduduk = Penduduk::all();
        $total_penduduk = $penduduk->count();

        $arr_gender = [];

        $l_count = $penduduk->where('id_jenis_kelamin', '1')->count();
        $p_count = $penduduk->where('id_jenis_kelamin', '2')->count();
        $total_gender = $l_count + $p_count;

        $l_percentage = $total_penduduk > 0 ? ($l_count / $total_penduduk) * 100 : 0;
        $p_percentage = $total_penduduk > 0 ? ($p_count / $total_penduduk) * 100 : 0;
        $total_gender_percentage = $total_penduduk > 0 ? ($total_gender / $total_penduduk) * 100 : 0;

        $arr_gender = [
            [
                'id' => 1,
                'name' => 'LAKI-LAKI',
                'count' => $l_count,
                'percentage' => $l_percentage,
            ],
            [
                'id' => 2,
                'name' => 'PEREMPUAN',
                'count' => $p_count,
                'percentage' => $p_percentage,
            ],
            [
                'id' => 3,
                'name' => 'TOTAL',
                'count' => $total_gender,
                'percentage' => $total_gender_percentage
            ]
        ];

        // Staf
        $staf = Staf::all();

        session([
            'artikel' => $artikel,
            'pastAgenda' => $pastAgenda,
            'upcomingAgenda' => $upcomingAgenda,
            'penduduk' => $penduduk,
            'total_penduduk' => $total_penduduk,
            'total_gender' => $total_gender,
            'total_gender_percentage' => $total_gender_percentage,
            'arr_gender' => $arr_gender,
            'staf' => $staf,
        ]);

        return view('visitor.index', compact('artikel', 'pastAgenda', 'upcomingAgenda'))
            ->with('title', 'Home')
            ->with([
                'penduduk' => $penduduk,
                'total_penduduk' => $total_penduduk,
                'total_gender' => $total_gender,
                'total_gender_percentage' => $total_gender_percentage,
                'arr_gender' => $arr_gender,
                'staf' => $staf,
            ]);
    }

    public function bacaArtikel($judul)
    {
        $data = Artikel::join(
            'users',
            'artikel.id_staf',
            '=',
            'users.id'
        )->select(
            'artikel.*',
            'users.name',
        )->where(
            'judul',
            '=',
            $judul
        )->first();

        $data->views()->create();       // catat artikel dilihat

        $upcomingAgenda = session('upcomingAgenda');
        $pastAgenda = session('pastAgenda');
        $penduduk = session('penduduk');
        $total_penduduk = session('total_penduduk');
        $total_gender = session('total_gender');
        $total_gender_percentage = session('total_gender_percentage');
        $arr_gender = session('arr_gender');
        $staf = session('staf');

        return view('visitor.bacaArtikel', [
            'title' => $judul,
            'artikel' => $data,
            'upcomingAgenda' => $upcomingAgenda,
            'pastAgenda' => $pastAgenda,
            'penduduk' => $penduduk,
            'total_penduduk' => $total_penduduk,
            'total_gender' => $total_gender,
            'total_gender_percentage' => $total_gender_percentage,
            'arr_gender' => $arr_gender,
            'staf' => $staf,
        ]);
    }

    public function aboutDesa()
    {
        $upcomingAgenda = session('upcomingAgenda');
        $pastAgenda = session('pastAgenda');
        $artikel = session('artikel');
        $penduduk = session('penduduk');
        $total_penduduk = session('total_penduduk');
        $total_gender = session('total_gender');
        $total_gender_percentage = session('total_gender_percentage');
        $arr_gender = session('arr_gender');
        $staf = session('staf');
        return view('visitor.aboutDesa', compact('artikel', 'pastAgenda', 'upcomingAgenda'))
            ->with('title', 'Tentang Desa')
            ->with([
                'penduduk' => $penduduk,
                'total_penduduk' => $total_penduduk,
                'total_gender' => $total_gender,
                'total_gender_percentage' => $total_gender_percentage,
                'arr_gender' => $arr_gender,
                'staf' => $staf,
            ]);
    }

    public function demografiDesa()
    {
        $upcomingAgenda = session('upcomingAgenda');
        $pastAgenda = session('pastAgenda');
        $artikel = session('artikel');
        $penduduk = session('penduduk');
        $total_penduduk = session('total_penduduk');
        $total_gender = session('total_gender');
        $total_gender_percentage = session('total_gender_percentage');
        $arr_gender = session('arr_gender');
        $staf = session('staf');

        // Tabel 2 - Agama
        $arr_agama = [];
        $agama = Agama::all();
        $agamaId = $agama->pluck('id');
        foreach ($agamaId as $data) {
            $data_agama = Agama::find($data);
            $agama_count = $penduduk->where('id_agama', $data)->count();
            $agama_percentage = $total_penduduk > 0 ? ($agama_count / $total_penduduk) * 100 : 0;

            if ($agama_count !== 0) {
                $arr_agama[] = [
                    'name' => $data_agama->nama,
                    'id' => $data_agama->id,
                    'count' => $agama_count,
                    'percentage' => $agama_percentage,
                ];
            }
        }

        $total_agama_count = array_sum(array_column($arr_agama, 'count'));
        $total_agama_percentage = $total_penduduk > 0 ? ($total_agama_count / $total_penduduk) * 100 : 0;

        // Tabel 3 - Pekerjaan
        $arr_pekerjaan = [];

        $pekerjaan = Pekerjaan::all();
        $total_pekerjaan = $pekerjaan->count();

        $pekerjaanId = $pekerjaan->pluck('id');

        foreach ($pekerjaanId as $data) {
            $data_pekerjaan = Pekerjaan::find($data);
            $pekerjaan_count = $penduduk->where('id_pekerjaan', $data)->count();
            $pekerjaan_percentage = $total_penduduk > 0 ? ($pekerjaan_count / $total_penduduk) * 100 : 0;

            if ($pekerjaan_count !== 0) {
                $arr_pekerjaan[] = [
                    'name' => $data_pekerjaan->nama,
                    'id' => $data_pekerjaan->id,
                    'count' => $pekerjaan_count,
                    'percentage' => $pekerjaan_percentage,
                ];
            }
        }

        $total_pekerjaan_count = array_sum(array_column($arr_pekerjaan, 'count'));
        $total_pekerjaan_percentage = $total_penduduk > 0 ? ($total_pekerjaan_count / $total_penduduk) * 100 : 0;

        // Tabel 4 - Status Penduduk
        $arr_status_penduduk = [];

        $tetap_count = $penduduk->where('penduduk_tetap', 0)->count();
        $tidaktetap_count = $penduduk->where('penduduk_tetap', 1)->count();
        $total_status_penduduk = $tetap_count + $tidaktetap_count;

        $tetap_percentage = $total_penduduk > 0 ? ($tetap_count / $total_penduduk) * 100 : 0;
        $tidaktetap_percentage = $total_penduduk > 0 ? ($tidaktetap_count / $total_penduduk) * 100 : 0;
        $total_status_penduduk_percentage = $total_penduduk > 0 ? ($total_status_penduduk / $total_penduduk) * 100 : 0;

        $arr_status_penduduk = [
            [
                'id' => 1,
                'name' => 'TETAP',
                'count' => $tetap_count,
                'percentage' => $tetap_percentage,
            ],
            [
                'id' => 2,
                'name' => 'TIDAK TETAP',
                'count' => $tidaktetap_count,
                'percentage' => $tidaktetap_percentage,
            ],
        ];

        // Tabel 5 - Pendidikan Terakhir
        $arr_pendidikan_terakhir = [];

        $pendidikan_terakhir = PendidikanTerakhir::all();
        $total_pendidikan_terakhir = $pendidikan_terakhir->count();

        $pendterakhirId = $pendidikan_terakhir->pluck('id');

        foreach ($pendterakhirId as $data) {
            $data_pendidikan_terakhir = PendidikanTerakhir::find($data);
            $pendidikan_terakhir_count = $penduduk->where('id_pendidikan_terakhir', $data)->count();
            $pendidikan_terakhir_percentage = $total_penduduk > 0 ? ($pendidikan_terakhir_count / $total_penduduk) * 100 : 0;

            if ($pendidikan_terakhir_count !== 0) {
                $arr_pendidikan_terakhir[] = [
                    'name' => $data_pendidikan_terakhir->nama,
                    'id' => $data_pendidikan_terakhir->id,
                    'count' => $pendidikan_terakhir_count,
                    'percentage' => $pendidikan_terakhir_percentage,
                ];
            }
        }

        $total_pendidikan_terakhir_count = array_sum(array_column($arr_pendidikan_terakhir, 'count'));
        $total_pendidikan_terakhir_percentage = $total_penduduk > 0 ? ($total_pendidikan_terakhir_count / $total_penduduk) * 100 : 0;

        // Tabel 6 - Status Perkawinan
        $arr_status_perkawinan = [];

        $status_perkawinan = StatusPerkawinan::all();
        $total_status_perkawinan = $status_perkawinan->count();

        $statusPerkawinanId = $status_perkawinan->pluck('id');

        foreach ($statusPerkawinanId as $data) {
            $data_status_perkawinan = StatusPerkawinan::find($data);
            $status_perkawinan_count = $penduduk->where('id_status_perkawinan', $data)->count();
            $status_perkawinan_percentage = $total_penduduk > 0 ? ($status_perkawinan_count / $total_penduduk) * 100 : 0;

            if ($status_perkawinan_count !== 0) {
                $arr_status_perkawinan[] = [
                    'name' => $data_status_perkawinan->nama,
                    'id' => $data_status_perkawinan->id,
                    'count' => $status_perkawinan_count,
                    'percentage' => $status_perkawinan_percentage,
                ];
            }
        }

        $total_status_perkawinan_count = array_sum(array_column($arr_status_perkawinan, 'count'));
        $total_status_perkawinan_percentage = $total_penduduk > 0 ? ($total_status_perkawinan_count / $total_penduduk) * 100 : 0;

        // Tabel 7 - Kewarganegaraan
        $arr_kewarganegaraan = [];

        $kewarganegaraan = Kewarganegaraan::all();
        $total_kewarganegaraan = $kewarganegaraan->count();

        $kewarganegaraanId = $kewarganegaraan->pluck('id');

        foreach ($kewarganegaraanId as $data) {
            $data_kewarganegaraan = Kewarganegaraan::find($data);
            $kewarganegaraan_count = $penduduk->where('id_kewarganegaraan', $data)->count();
            $kewarganegaraan_percentage = $total_penduduk > 0 ? ($kewarganegaraan_count / $total_penduduk) * 100 : 0;

            if ($kewarganegaraan_count !== 0) {
                $arr_kewarganegaraan[] = [
                    'name' => $data_kewarganegaraan->nama,
                    'id' => $data_kewarganegaraan->id,
                    'count' => $kewarganegaraan_count,
                    'percentage' => $kewarganegaraan_percentage,
                ];
            }
        }

        $total_kewarganegaraan_count = array_sum(array_column($arr_kewarganegaraan, 'count'));
        $total_kewarganegaraan_percentage = $total_penduduk > 0 ? ($total_kewarganegaraan_count / $total_penduduk) * 100 : 0;

        // Tabel 8 - Kelas Sosial
        $keluarga = Keluarga::all();
        $total_keluarga = $keluarga->count();

        $arr_kelas_sosial = [];

        $kelas_sosial = KelasSosial::all();
        $total_kelas_sosial = $kelas_sosial->count();

        $kelasSosialId = $kelas_sosial->pluck('id');

        foreach ($kelasSosialId as $data) {
            $data_kelas_sosial = KelasSosial::find($data);
            $kelas_sosial_count = $keluarga->where('id_kelas_sosial', $data)->count();
            $kelas_sosial_percentage = $total_keluarga > 0 ? ($kelas_sosial_count / $total_keluarga) * 100 : 0;

            if ($kelas_sosial_count !== 0) {
                $arr_kelas_sosial[] = [
                    'name' => $data_kelas_sosial->nama,
                    'id' => $data_kelas_sosial->id,
                    'count' => $kelas_sosial_count,
                    'percentage' => $kelas_sosial_percentage,
                ];
            }
        }

        $total_kelas_sosial_count = array_sum(array_column($arr_kelas_sosial, 'count'));
        $total_kelas_sosial_percentage = $total_keluarga > 0 ? ($total_kelas_sosial_count / $total_keluarga) * 100 : 0;

        return view('visitor.demografiDesa', compact('artikel', 'pastAgenda', 'upcomingAgenda'))
            ->with('title', 'Demografi Desa')
            ->with([
                'penduduk' => $penduduk,
                'total_penduduk' => $total_penduduk,
                'total_gender' => $total_gender,
                'total_gender_percentage' => $total_gender_percentage,
                'arr_gender' => $arr_gender,
                'staf' => $staf,
                'arr_agama' => $arr_agama,
                'agama' => $agama,
                'total_agama' => $total_agama_count,
                'total_agama_percentage' => $total_agama_percentage,
                'arr_pekerjaan' => $arr_pekerjaan,
                'pekerjaan' => $pekerjaan,
                'total_pekerjaan' => $total_pekerjaan_count,
                'total_pekerjaan_percentage' => $total_pekerjaan_percentage,
                'arr_status_penduduk' => $arr_status_penduduk,
                'total_status_penduduk' => $total_status_penduduk,
                'total_status_penduduk_percentage' => $total_status_penduduk_percentage,
                'arr_pendidikan_terakhir' => $arr_pendidikan_terakhir,
                'pendidikan_terakhir' => $pendidikan_terakhir,
                'total_pendidikan_terakhir' => $total_pendidikan_terakhir_count,
                'total_pendidikan_terakhir_percentage' => $total_pendidikan_terakhir_percentage,
                'keluarga' => $keluarga,
                'total_keluarga' => $total_keluarga,
                'arr_kelas_sosial' => $arr_kelas_sosial,
                'kelas_sosial' => $kelas_sosial,
                'total_kelas_sosial' => $total_kelas_sosial_count,
                'total_kelas_sosial_percentage' => $total_kelas_sosial_percentage,
                'arr_status_perkawinan' => $arr_status_perkawinan,
                'status_perkawinan' => $status_perkawinan,
                'total_status_perkawinan' => $total_status_perkawinan_count,
                'total_status_perkawinan_percentage' => $total_status_perkawinan_percentage,
                'arr_kewarganegaraan' => $arr_kewarganegaraan,
                'kewarganegaraan' => $kewarganegaraan,
                'total_kewarganegaraan' => $total_kewarganegaraan_count,
                'total_kewarganegaraan_percentage' => $total_kewarganegaraan_percentage,
            ]);
    }

    public function geografisDesa()
    {
        $upcomingAgenda = session('upcomingAgenda');
        $pastAgenda = session('pastAgenda');
        $artikel = session('artikel');
        $penduduk = session('penduduk');
        $total_penduduk = session('total_penduduk');
        $total_gender = session('total_gender');
        $total_gender_percentage = session('total_gender_percentage');
        $arr_gender = session('arr_gender');
        $staf = session('staf');
        return view('visitor.geografisDesa', compact('artikel', 'pastAgenda', 'upcomingAgenda'))
            ->with('title', 'Geografis Desa')
            ->with([
                'penduduk' => $penduduk,
                'total_penduduk' => $total_penduduk,
                'total_gender' => $total_gender,
                'total_gender_percentage' => $total_gender_percentage,
                'arr_gender' => $arr_gender,
                'staf' => $staf,
            ]);
    }

    public function strukturOrganisasi()
    {
        $upcomingAgenda = session('upcomingAgenda');
        $pastAgenda = session('pastAgenda');
        $artikel = session('artikel');
        $penduduk = session('penduduk');
        $total_penduduk = session('total_penduduk');
        $total_gender = session('total_gender');
        $total_gender_percentage = session('total_gender_percentage');
        $arr_gender = session('arr_gender');
        $staf = session('staf');
        return view('visitor.strukturOrganisasi', compact('artikel', 'pastAgenda', 'upcomingAgenda'))
            ->with('title', 'Struktur Organisasi')
            ->with([
                'staf' => Staf::all(),
                'penduduk' => $penduduk,
                'total_penduduk' => $total_penduduk,
                'total_gender' => $total_gender,
                'total_gender_percentage' => $total_gender_percentage,
                'arr_gender' => $arr_gender,
                'staf' => $staf,
            ]);
    }

    public function perangkatDesa()
    {
        $upcomingAgenda = session('upcomingAgenda');
        $pastAgenda = session('pastAgenda');
        $artikel = session('artikel');
        $penduduk = session('penduduk');
        $total_penduduk = session('total_penduduk');
        $total_gender = session('total_gender');
        $total_gender_percentage = session('total_gender_percentage');
        $arr_gender = session('arr_gender');
        $staf = session('staf');
        return view('visitor.perangkatDesa', compact('artikel', 'pastAgenda', 'upcomingAgenda'))
            ->with('title', 'Perangkat Desa')
            ->with([
                'staf' => Staf::all(),
                'penduduk' => $penduduk,
                'total_penduduk' => $total_penduduk,
                'total_gender' => $total_gender,
                'total_gender_percentage' => $total_gender_percentage,
                'arr_gender' => $arr_gender,
                'staf' => $staf,
            ]);
    }

    public function dokumen()
    {
        $upcomingAgenda = session('upcomingAgenda');
        $pastAgenda = session('pastAgenda');
        $artikel = session('artikel');
        $penduduk = session('penduduk');
        $total_penduduk = session('total_penduduk');
        $total_gender = session('total_gender');
        $total_gender_percentage = session('total_gender_percentage');
        $arr_gender = session('arr_gender');
        $staf = session('staf');
        $documents = Dokumen::paginate(10);
        return view('visitor.dokumen', compact('artikel', 'pastAgenda', 'upcomingAgenda'))
            ->with('title', 'Dokumen')
            ->with([
                'staf' => Staf::all(),
                'penduduk' => $penduduk,
                'total_penduduk' => $total_penduduk,
                'total_gender' => $total_gender,
                'total_gender_percentage' => $total_gender_percentage,
                'arr_gender' => $arr_gender,
                'staf' => $staf,
                'documents' => $documents
            ]);
    }

    public function downloadDokumen($filename)
    {
        $folder = 'documents'; // Change this to your actual folder name

        // Get the list of files in the directory
        $files = Storage::disk('public')->files($folder);

        // Find the file with a matching name (without extension)
        $matchingFile = null;
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_FILENAME) === $filename) {
                $matchingFile = $file;
                break;
            }
        }

        if ($matchingFile) {
            // Determine the MIME type of the file
            $mime = mime_content_type(storage_path('app/public/' . $matchingFile));

            // Set the appropriate HTTP headers for the response
            return response()->file(storage_path('app/public/' . $matchingFile), [
                'Content-Type' => $mime,
                'Content-Disposition' => 'attachment; filename="' . basename($matchingFile) . '"',
            ]);
        } else {
            // File not found, handle appropriately (e.g., show an error or redirect)
            return abort(404);
        }
    }
}
