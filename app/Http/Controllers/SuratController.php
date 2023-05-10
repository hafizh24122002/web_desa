<?php

namespace App\Http\Controllers;

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Writer\Pdf\DomPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
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

        return view('staf.surat.suratNewInput', [
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
    }

    public function getDataPenduduk($nama)
    {
        $data = Penduduk::where('nama', '=', $nama)->first();
        
        return response()->json($data);
    }

    public function suratNewInputSubmit(Request $request)
    {
        // Retrieve user input from the web form
        $nomorSurat = $request->input('no');
        $nama = $request->input('nama');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $tempat_lahir = $request->input('tempat_lahir');
        $tanggal_lahir_str = $request->input('tanggal_lahir');
        $kebangsaan = $request->input('kebangsaan');
        $id_agama = $request->input('id_agama');
        $id_status_perkawinan = $request->input('id_status_perkawinan');
        $id_pekerjaan = $request->input('id_pekerjaan');
        $alamat = $request->input('alamat');
        $rt = $request->input('rt');
        $rw = $request->input('rw');
        $usaha = $request->input('usaha');
        $tanggal_surat_str = $request->input('tanggal_surat');
        $idTipeSurat = $request->input('id_tipe');
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

        $surat = Surat::firstWhere('nama', $tipe);

        // Load the docx template file
        $template = new TemplateProcessor(storage_path('app/surat/'.$surat->filename));

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
            'tanggal_surat' => $tanggal_surat
        ];

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

        $data = [
            'no_surat' => $nomorSurat,
            'id_staf' => auth()->user()->id_staf,
            'id_klasifikasi_surat' => $idTipeSurat,
            'keterangan' => $nama,
            'filename' => $outputFilename,
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