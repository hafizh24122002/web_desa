<?php

namespace App\Http\Controllers;

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Writer\Pdf\DomPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

use App\Models\Agama;
use App\Models\ArsipSurat;
use App\Models\Kewarganegaraan;
use App\Models\Penduduk;
use App\Models\Pekerjaan;
use App\Models\StatusPerkawinan;
use App\Models\Surat;


class SuratController extends Controller
{
    public function suratNew()
    {
        return view('staf.surat.suratNew', [
            'title' => 'Buat Surat Baru',
            'surat' => Surat::paginate(10),
        ]);
    }

    public function suratNewInput($tipe)
    {
        $currDate = Carbon::now();

        $idTipeSurat = Surat::where('nama', '=', $tipe)->first()->id;
        $nomorTerakhir = (ArsipSurat::where('id_klasifikasi_surat', '=', $idTipeSurat)
            ->whereYear('created_at', '=', $currDate->year)
            ->max('no_surat') + 1);
        if (!$nomorTerakhir) {
            $nomorTerakhir = 1;
        }

        switch($idTipeSurat) {
            /**
             * Surat Keterangan Usaha
             * 512
             */
            case 1:
                $view = view('staf.surat.suratNewInput1', [
                    'title' => 'Buat Surat '.$tipe,
                    'id_tipe' => $idTipeSurat,
                    'tipe' => $tipe,
                    'nomorTerakhir' => $nomorTerakhir,
                    'agama' => Agama::all(),
                    'kewarganegaraan' => Kewarganegaraan::all(),
                    'penduduk' => Penduduk::pluck('nama'),
                    'pekerjaan' => Pekerjaan::all(),
                    'status_perkawinan' => StatusPerkawinan::all(),
                ]);
                break;

                /**
                 * Surat Keterangan Tidak Mampu
                 * 474.4
                 */
            case 2:
                $view = view('staf.surat.suratNewInput2', [
                    'title' => 'Buat Surat '.$tipe,
                    'id_tipe' => $idTipeSurat,
                    'tipe' => $tipe,
                    'nomorTerakhir' => $nomorTerakhir,
                    'agama' => Agama::all(),
                    'kewarganegaraan' => Kewarganegaraan::all(),
                    'penduduk' => Penduduk::pluck('nama'),
                    'pekerjaan' => Pekerjaan::all(),
                ]);
                break;

            /**
             * Surat Keterangan Penghasilan Orang Tua
             * 474.4
             */
            case 3:
                $view = view('staf.surat.suratNewInput3', [
                    'title' => 'Buat Surat '.$tipe,
                    'id_tipe' => $idTipeSurat,
                    'tipe' => $tipe,
                    'nomorTerakhir' => $nomorTerakhir,
                    'agama' => Agama::all(),
                    'penduduk' => Penduduk::pluck('nama'),
                    'pekerjaan' => Pekerjaan::all(),
                ]);
                break;

            /**
             * Surat Undangan Pembahasan HUT Bangka Selatan
             * 140
             */
            case 4:
                $view = view('staf.surat.suratNewInput4', [
                    'title' => 'Buat Surat '.$tipe,
                    'id_tipe' => $idTipeSurat,
                    'tipe' => $tipe,
                    'nomorTerakhir' => $nomorTerakhir,
                    'hari_jadi_num' => Carbon::parse('2003-02-25')->age+1,
                ]);
                break;

            /**
             * Surat Rekomendasi Izin Keramaian
             * 300
             */
            case 5:
                $view = view('staf.surat.suratNewInput5', [
                    'title' => 'Buat Surat '.$tipe,
                    'id_tipe' => $idTipeSurat,
                    'tipe' => $tipe,
                    'nomorTerakhir' => $nomorTerakhir,
                    'agama' => Agama::all(),
                    'kewarganegaraan' => Kewarganegaraan::all(),
                    'penduduk' => Penduduk::pluck('nama'),
                    'pekerjaan' => Pekerjaan::all(),
                ]);
                break;
        }
        
        return $view;
    }

    public function getDataPenduduk($nama)
    {
        $data = Penduduk::where('nama', '=', $nama)->first();
        
        return response()->json($data);
    }

    public function suratNewInputSubmit(Request $request)
    {
        $idTipeSurat = $request->input('id_tipe');

        switch ($idTipeSurat) {
            /**
             * Surat Keterangan Usaha
             * 512
             */
            case 1:
                // Retrieve user input from the web form
                $validate = $request->validate([
                    'no_surat' => [
                        'required',
                        Rule::unique('arsip_surat')->where('id_klasifikasi_surat', $idTipeSurat),
                    ],
                    'rt' => 'integer',
                    'rw' => 'integer',
                ], [
                    'no_surat.unique' => 'Nomor surat sudah ada!'
                ]);

                $nomorSurat = $validate['no_surat'];
                $nama = strtoupper($request->input('nama'));
                $jenis_kelamin = $request->input('jenis_kelamin');
                $tempat_lahir = ucwords(strtolower($request->input('tempat_lahir')));
                $tanggal_lahir_str = $request->input('tanggal_lahir');
                $kebangsaan = $request->input('kebangsaan');
                $id_agama = $request->input('id_agama');
                $id_status_perkawinan = $request->input('id_status_perkawinan');
                $id_pekerjaan = $request->input('id_pekerjaan');
                $alamat = $request->input('alamat');
                $rt = $validate['rt'];
                $rw = $validate['rw'];
                $usaha = $request->input('usaha');
                $tanggal_surat_str = $request->input('tanggal_surat');
                $tipe = $request->input('tipe');

                if($jenis_kelamin === "L") {
                    $jenis_kelamin = "Laki-Laki";
                } else {
                    $jenis_kelamin = "Perempuan";
                }

                $tanggal_lahir = Carbon::parse($tanggal_lahir_str)->translatedFormat('jS F Y');
                $tanggal_surat = Carbon::parse($tanggal_surat_str)->translatedFormat('jS F Y');

                $agama = ucwords(strtolower(Agama::find($id_agama)->nama));
                $status_perkawinan = ucwords(strtolower(StatusPerkawinan::find($id_status_perkawinan)->nama));
                $pekerjaan = ucwords(strtolower(Pekerjaan::find($id_pekerjaan)->nama));
                
                // Define the values to be filled in the template
                $values = [
                    'no_surat' => $nomorSurat,
                    'nama' => $nama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'kebangsaan' => $kebangsaan,
                    'agama' => $agama,
                    'status_perkawinan' => $status_perkawinan,
                    'pekerjaan' => $pekerjaan,
                    'alamat' => $alamat,
                    'rt' => $rt,
                    'rw' => $rw,
                    'nama_usaha' => $usaha,
                    'tanggal_surat' => $tanggal_surat,
                    'year' => Carbon::parse($tanggal_surat_str)->format('Y'),
                ];
                break;
            
            /**
             * Surat Keterangan Tidak Mampu
             * 474.4
            */
            case 2:
                $validate = $request->validate([
                    'no_surat' => [
                        'required',
                        Rule::unique('arsip_surat')->where('id_klasifikasi_surat', $idTipeSurat),
                    ],
                ], [
                    'no_surat.unique' => 'Nomor surat sudah ada!'
                ]);

                $nomorSurat = $validate['no_surat'];
                $nama = strtoupper($request->input('nama'));
                $jenis_kelamin = $request->input('jenis_kelamin');
                $tempat_lahir = ucwords(strtolower($request->input('tempat_lahir')));
                $tanggal_lahir_str = $request->input('tanggal_lahir');
                $kebangsaan = $request->input('kebangsaan');
                $id_agama = $request->input('id_agama');
                $id_pekerjaan = $request->input('id_pekerjaan');
                $alamat = $request->input('alamat');
                $tanggal_surat_str = $request->input('tanggal_surat');  
                $tipe = $request->input('tipe');

                if($jenis_kelamin === "L") {
                    $jenis_kelamin = "Laki-Laki";
                } else {
                    $jenis_kelamin = "Perempuan";
                }

                $tanggal_lahir = Carbon::parse($tanggal_lahir_str)->translatedFormat('jS F Y');
                $tanggal_surat = Carbon::parse($tanggal_surat_str)->translatedFormat('jS F Y');

                $agama = ucwords(strtolower(Agama::find($id_agama)->nama));
                $pekerjaan = ucwords(strtolower(Pekerjaan::find($id_pekerjaan)->nama));

                // Define the values to be filled in the template
                $values = [
                    'no_surat' => $nomorSurat,
                    'nama' => $nama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'kebangsaan' => $kebangsaan,
                    'agama' => $agama,
                    'pekerjaan' => $pekerjaan,
                    'alamat' => $alamat,
                    'tanggal_surat' => $tanggal_surat,
                    'year' => Carbon::parse($tanggal_surat_str)->format('Y'),
                ];
                break;

            /**
             * Surat Keterangan Penghasilan Orang Tua
             * 474.4
             */
            case 3:
                $validate = $request->validate([
                    'no_surat' => [
                        'required',
                        Rule::unique('arsip_surat')->where('id_klasifikasi_surat', $idTipeSurat),
                    ],
                    'penghasilan_ortu' => 'integer'
                ], [
                    'no_surat.unique' => 'Nomor surat sudah ada!',
                ]);

                $nomorSurat = $validate['no_surat'];
                $tanggal_surat_str = $request->input('tanggal_surat');  
                $tipe = $request->input('tipe');

                $nama = strtoupper($request->input('nama'));
                $jenis_kelamin = $request->input('jenis_kelamin');
                $tempat_lahir = ucwords(strtolower($request->input('tempat_lahir')));
                $tanggal_lahir_str = $request->input('tanggal_lahir');
                $id_agama = $request->input('id_agama');
                $id_pekerjaan = $request->input('id_pekerjaan');
                $alamat = $request->input('alamat');

                $nama_ortu = strtoupper($request->input('nama_ortu'));
                $jenis_kelamin_ortu = $request->input('jenis_kelamin_ortu');
                $tempat_lahir_ortu = ucwords(strtolower($request->input('tempat_lahir_ortu')));
                $tanggal_lahir_ortu_str = $request->input('tanggal_lahir_ortu');
                $id_agama_ortu = $request->input('id_agama_ortu');
                $id_pekerjaan_ortu = $request->input('id_pekerjaan_ortu');
                $alamat_ortu = $request->input('alamat_ortu');
                $penghasilan_ortu = $request->input('penghasilan_ortu');

                $tanggal_lahir = Carbon::parse($tanggal_lahir_str)->translatedFormat('jS F Y');
                $tanggal_lahir_ortu = Carbon::parse($tanggal_lahir_ortu_str)->translatedFormat('jS F Y');
                $tanggal_surat = Carbon::parse($tanggal_surat_str)->translatedFormat('jS F Y');
                $agama = ucwords(strtolower(Agama::find($id_agama)->nama));
                $agama_ortu = ucwords(strtolower(Agama::find($id_agama_ortu)->nama));
                $pekerjaan = ucwords(strtolower(Pekerjaan::find($id_pekerjaan)->nama));
                $pekerjaan_ortu = ucwords(strtolower(Pekerjaan::find($id_pekerjaan_ortu)->nama));

                if($jenis_kelamin === "L") {
                    $jenis_kelamin = "Laki-Laki";
                    $pekerjaan_jk = "Siswa";
                } else {
                    $jenis_kelamin = "Perempuan";
                    $pekerjaan_jk = "Siswi";
                }

                if($jenis_kelamin_ortu === "L") {
                    $jenis_kelamin_ortu = "Laki-Laki";
                } else {
                    $jenis_kelamin_ortu = "Perempuan";
                }

                $locale = 'id_ID';
                $formatter_txt = new \NumberFormatter($locale, \NumberFormatter::SPELLOUT);
                $penghasilan_ortu_txt = ucwords($formatter_txt->format($penghasilan_ortu));

                $formatter_num = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
                $formatter_num->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
                $penghasilan_ortu_num = $formatter_num->format($penghasilan_ortu);

                // Define the values to be filled in the template
                $values = [
                    'no_surat' => $nomorSurat,
                    'year' => Carbon::parse($tanggal_surat_str)->format('Y'),
                    'tanggal_surat' => $tanggal_surat,
                    'nama' => $nama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'agama' => $agama,
                    'pekerjaan' => $pekerjaan,
                    'alamat' => $alamat,
                    'nama_ortu' => $nama_ortu,
                    'jenis_kelamin_ortu' => $jenis_kelamin_ortu,
                    'tempat_lahir_ortu' => $tempat_lahir_ortu,
                    'tanggal_lahir_ortu' => $tanggal_lahir_ortu,
                    'agama_ortu' => $agama_ortu,
                    'pekerjaan_ortu' => $pekerjaan_ortu,
                    'alamat_ortu' => $alamat_ortu,
                    'penghasilan_ortu_num' => $penghasilan_ortu_num,
                    'penghasilan_ortu_text' => $penghasilan_ortu_txt,
                    'pekerjaan_jk' => $pekerjaan_jk,
                ];
                break;

            /**
             * Surat Undangan Pembahasan HUT Bangka Selatan
             * 140
             */
            case 4:
                $validate = $request->validate([
                    'no_surat' => [
                        'required',
                        Rule::unique('arsip_surat')->where('id_klasifikasi_surat', $idTipeSurat),
                    ],
                ]);

                $nomorSurat = $validate['no_surat'];
                $tanggal_surat_str = $request->input('tanggal_surat');
                $nama = $request->input('nama');
                $hari_jadi_num = $request->input('hari_jadi_num');
                $tanggal_kegiatan_str = $request->input('tanggal_kegiatan');
                $start_time = $request->input('start_time');
                $finish_time = $request->input('finish_time');
                $tempat_kegiatan = $request->input('tempat_kegiatan');
                $tipe = $request->input('tipe');

                if(!$finish_time) {
                    $finish_time = "Selesai";
                } else {
                    $finish_time = $finish_time.' WIB';
                }

                // Define the values to be filled in the template
                $values = [
                    'tanggal_surat' => Carbon::parse($tanggal_surat_str)->translatedFormat('jS F Y'),
                    'year' => Carbon::parse($tanggal_surat_str)->format('Y'),
                    'no_surat' => $nomorSurat,
                    'nama' => $nama,
                    'hari_jadi_num' => $hari_jadi_num,
                    'hari_kegiatan' => Carbon::parse($tanggal_kegiatan_str)->translatedFormat('l'),
                    'tanggal_kegiatan' => Carbon::parse($tanggal_kegiatan_str)->translatedFormat('jS F Y'),
                    'start_time' => $start_time,
                    'finish_time' => $finish_time,
                    'tempat_kegiatan' => $tempat_kegiatan,                   
                ];
                $nama = $hari_jadi_num;
                break;

            /**
             * Surat Rekomendasi Izin Keramaian
             * 300
             */
            case 5:
                $validate = $request->validate([
                    'no_surat' => [
                        'required',
                        Rule::unique('arsip_surat')->where('id_klasifikasi_surat', $idTipeSurat),
                    ],
                    'nik' => 'numeric',
                ], [
                    'no_surat.unique' => 'Nomor surat sudah ada!'
                ]);

                $nomorSurat = $validate['no_surat'];
                $nama = strtoupper($request->input('nama'));
                $nik = $request->input('nik');
                $tempat_lahir = ucwords(strtolower($request->input('tempat_lahir')));
                $tanggal_lahir_str = $request->input('tanggal_lahir');
                $jenis_kelamin = $request->input('jenis_kelamin');
                $id_pekerjaan = $request->input('id_pekerjaan');
                $alamat = $request->input('alamat');
                $id_agama = $request->input('id_agama');
                $id_kewarganegaraan = $request->input('id_kewarganegaraan');
                $nama_kegiatan = $request->input('kegiatan');
                $tanggal_kegiatan_str = $request->input('tanggal_kegiatan');
                $start_time = $request->input('start_time');
                $finish_time = $request->input('finish_time');
                $tempat_kegiatan = $request->input('tempat_kegiatan');
                $tanggal_surat_str = $request->input('tanggal_surat');
                $tanggal_ttd_str = $request->input('tanggal_ttd');
                $tipe = $request->input('tipe');

                if($jenis_kelamin === "L") {
                    $jenis_kelamin = "Laki-Laki";
                } else {
                    $jenis_kelamin = "Perempuan";
                }

                // Define the values to be filled in the template
                $values = [
                    'no_surat' => $nomorSurat,
                    'year' => Carbon::parse($tanggal_surat_str)->format('Y'),
                    'nama' => $nama,
                    'nik' => $nik,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => Carbon::parse($tanggal_lahir_str)->translatedFormat('jS F Y'),
                    'jenis_kelamin' => $jenis_kelamin,
                    'alamat' => $alamat,
                    'pekerjaan' => ucwords(strtolower(Pekerjaan::find($id_pekerjaan)->nama)),
                    'agama' => ucwords(strtolower(Agama::find($id_agama)->nama)),
                    'kewarganegaraan' => Kewarganegaraan::find($id_kewarganegaraan)->nama,
                    'kegiatan' => $nama_kegiatan,
                    'hari_kegiatan' => Carbon::parse($tanggal_kegiatan_str)->translatedFormat('l'),
                    'tanggal_kegiatan' => Carbon::parse($tanggal_kegiatan_str)->translatedFormat('jS F Y'),
                    'start_time' => $start_time,
                    'finish_time' => $finish_time,
                    'tempat_kegiatan' => $tempat_kegiatan,
                    'umur' => Carbon::parse($tanggal_lahir_str)->age,
                    'tanggal_surat' => Carbon::parse($tanggal_surat_str)->translatedFormat('jS F Y'),
                    'hari_ttd' => Carbon::parse($tanggal_ttd_str)->translatedFormat('l'),
                    'tanggal_ttd' => Carbon::parse($tanggal_ttd_str)->translatedFormat('jS F Y'),
                ];
                break;
        }

        $surat = Surat::firstWhere('nama', $tipe);

        // Load the docx template file
        $template = new TemplateProcessor(storage_path('app/surat/'.$surat->filename));

        // Fill in the template with the values
        $template->setValues($values);

        // Save the modified docx to a different directory
        $outputFilename = $tipe.'-'.$nomorSurat.'-'.$nama.'.docx';
        $outputDirectory = storage_path('app/arsip_surat/');

        if (!file_exists($outputDirectory)) {
            mkdir($outputDirectory, 0777, true);
        }

        $outputPath = $outputDirectory . '/' . $outputFilename;
        $template->saveAs($outputPath);

        $json = json_encode($values, JSON_FORCE_OBJECT);

        $data = [
            'no_surat' => $nomorSurat,
            'id_staf' => auth()->user()->id_staf,
            'id_klasifikasi_surat' => $idTipeSurat,
            'keterangan' => ucwords(strtolower($tipe)).'-'.ucwords(strtolower($nama)),
            'filename' => $outputFilename,
            'json' => $json,
            'tanggal_surat' => $tanggal_surat_str,
        ];

        ArsipSurat::create($data);

        return redirect('/staf/layanan-surat/arsip-surat')->with('success', 'Surat berhasil dibuat!');
    }

    public function arsipSurat()
    {
        return view('staf.surat.arsip', [
            'title' => 'Arsip Surat',
            'arsip' => ArsipSurat::join(
                'staf', 'arsip_surat.id_staf', '=', 'staf.id'
            )->join(
                'surat', 'arsip_surat.id_klasifikasi_surat', '=', 'surat.id'
            )->select(
                'arsip_surat.*',
                'staf.nama',
                'surat.kode_surat',
            )->paginate(10),
        ]);
    }

    public function lihatSurat($filename)
    {
        $file = storage_path('app/arsip_surat/'.$filename);

        if (!file_exists($file)) {
            abort(404);
        }

        $phpWord = IOFactory::load($file);
        
        Settings::setPdfRendererPath(base_path('vendor/dompdf/dompdf'));
        Settings::setPdfRendererName('DomPDF');

        $tempPath = storage_path('app/preview.pdf');

        $pdfWriter = IOFactory::createWriter($phpWord, 'PDF');
        $pdfWriter->save($tempPath);

        $response = response()->file($tempPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="preview.pdf"',
        ]);

        // Storage::delete('preview.pdf');

        return $response;
    }

    public function unduhSurat($filename)
    {
        $file = storage_path('app/arsip_surat/'.$filename);

        return response()->download($file);
    }

    public function hapusSurat($id, $filename)
    {
        $file = '/arsip_surat/'. $filename;

        ArsipSurat::destroy($id);
        Storage::delete($file);

        return redirect('/staf/layanan-surat/arsip-surat')->with('success', 'Surat berhasil dihapus!');
    }
}