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

use App\Services\Surat1Service;         // Surat Keterangan Usaha
use App\Services\Surat2Service;         // Surat Keterangan Tidak Mampu
use App\Services\Surat3Service;         // Surat Keterangan Penghasilan Orang Tua
use App\Services\Surat4Service;         // Surat Undangan Pembahasan HUT Bangka Selatan
use App\Services\Surat5Service;         // Surat Rekomendasi Izin Keramaian
use App\Services\Surat6Service;         // Surat Keterangan Belum Menikah

use App\Models\ArsipSurat;
use App\Models\Surat;
use App\Models\Staf;


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
        $nomorTerakhir = (ArsipSurat::whereYear('tanggal_surat', '=', $currDate->year)
            ->max('no_surat') + 1);

        if (!$nomorTerakhir) {
            $nomorTerakhir = 1;
        }

        $commonViewData = [
            'title' => 'Buat Surat '.$tipe,
            'id_tipe' => $idTipeSurat,
            'tipe' => $tipe,
            'nomorTerakhir' => $nomorTerakhir
        ];

        switch($idTipeSurat) {
            /**
             * Surat Keterangan Usaha
             * 512
             */
            case 1:
                $view = view('staf.surat.suratNewInput1', 
                    array_merge(
                        $commonViewData, 
                        app(Surat1Service::class)->getViewData()
                    )
                );
                break;

            /**
             * Surat Keterangan Tidak Mampu
             * 474.4
             */
            case 2:
                $view = view('staf.surat.suratNewInput2', 
                    array_merge(
                        $commonViewData,
                        app(Surat2Service::class)->getViewData()
                    )
                );
                break;

            /**
             * Surat Keterangan Penghasilan Orang Tua
             * 474.4
             */
            case 3:
                $view = view('staf.surat.suratNewInput3', 
                    array_merge(
                        $commonViewData,
                        app(Surat3Service::class)->getViewData()
                    )
                );
                break;

            /**
             * Surat Undangan Pembahasan HUT Bangka Selatan
             * 140
             */
            case 4:
                $view = view('staf.surat.suratNewInput4', [
                    array_merge(
                        $commonViewData,
                        app(Surat4Service::class)->getViewData()
                    )
                ]);
                break;

            /**
             * Surat Rekomendasi Izin Keramaian
             * 300
             */
            case 5:
                $view = view('staf.surat.suratNewInput5', 
                    array_merge(
                        $commonViewData,
                        app(Surat5Service::class)->getViewData()
                    )
                );
                break;

            /**
             * Surat Keterangan Belum Menikah
             * 474.4
             */
            case 6:
                $view = view('staf.surat.suratNewInput6', [
                    'title' => 'Buat Surat '.$tipe,
                    'id_tipe' => $idTipeSurat,
                    'tipe' => $tipe,
                    'nomorTerakhir' => $nomorTerakhir,
                    'agama' => Agama::all(),
                    'kewarganegaraan' => Kewarganegaraan::all(),
                    'penduduk' => Penduduk::pluck('nama'),
                    'pekerjaan' => Pekerjaan::all(),
                    'staf' => Staf::all(),
                ]);
                break;
        }
        return $view;
    }

    private function suratSubmit(Request $request, $id = null)
    {
        $idTipeSurat = $request->input('id_tipe');

        switch ($idTipeSurat) {
            /**
             * Surat Keterangan Usaha
             * 512
             */
            case 1:
                $values = app(Surat1Service::class)->submit($request, $id);
                break;
            
            /**
             * Surat Keterangan Tidak Mampu
             * 474.4
            */
            case 2:
                $values = app(Surat2Service::class)->submit($request, $id);
                break;

            /**
             * Surat Keterangan Penghasilan Orang Tua
             * 474.4
             */
            case 3:
                $values = app(Surat3Service::class)->submit($request, $id);
                break;

            /**
             * Surat Undangan Pembahasan HUT Bangka Selatan
             * 140
             */
            case 4:
                $values = app(Surat4Service::class)->submit($request, $id);
                break;

            /**
             * Surat Rekomendasi Izin Keramaian
             * 300
             */
            case 5:
                $values = app(Surat5Service::class)->submit($request, $id);
                break;
        }
        $tipe = $request->input('tipe');

        $surat = Surat::firstWhere('nama', $tipe);

        // Load the docx template file
        $template = new TemplateProcessor(storage_path('app/surat/'.$surat->filename));

        // Fill in the template with the values
        $template->setValues($values);

        // Filename formatting for 'Surat Undangan Pembahasan HUT Bangka Selatan'
        if ($idTipeSurat === 4) {
            $values['nama'] = $values['hari_jadi_num'];
        }

        // Save the modified docx to arsip
        $outputFilename = $tipe.'-'.$values['no_surat'].'-'.$values['tanggal_surat_raw']->year.'-'.$values['nama'].'.docx';
        $outputDirectory = storage_path('app/arsip_surat/');

        if (!file_exists($outputDirectory)) {
            mkdir($outputDirectory, 0777, true);
        }

        $outputPath = $outputDirectory . '/' . $outputFilename;
        $template->saveAs($outputPath);

        $json = json_encode($values, JSON_FORCE_OBJECT);

        return $data = [
            'no_surat' => $values['no_surat'],
            'id_staf' => auth()->user()->id_staf,
            'id_klasifikasi_surat' => $idTipeSurat,
            'keterangan' => ucwords(strtolower($tipe)).'-'.ucwords(strtolower($values['nama'])),
            'filename' => $outputFilename,
            'json' => $json,
            'tanggal_surat' => $values['tanggal_surat_raw'],
        ];
    }

    public function suratNewInputSubmit(Request $request)
    {
        $data = $this->suratSubmit($request);

        ArsipSurat::create($data);

        return redirect('/staf/layanan-surat/arsip-surat')->with('success', 'Surat berhasil dibuat!');
    }


    public function arsipSurat(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort_field', 'no_surat');
        $sortOrder = $request->input('sort_order', 'asc');

        $query = ArsipSurat::join(
            'staf', 'arsip_surat.id_staf', '=', 'staf.id'
        )->join(
            'surat', 'arsip_surat.id_klasifikasi_surat', '=', 'surat.id'
        )->select(
            'arsip_surat.*',
            'staf.nama',
            'surat.kode_surat',
        );

        if($search) {
            $query->where('staf.nama', 'LIKE', '%' . $search . '%')
                ->orWhere('keterangan', 'LIKE', '%' . $search . '%');
        }

        $query->orderBy($sortField, $sortOrder);

        $arsip = $query->paginate(10);

        if ($request->ajax()) {
            return view('partials.arsipSuratTable', ['arsip' => $arsip])->render();
        }

        return view('staf.surat.arsip', [
            'title' => 'Arsip Surat',
            'arsip' => $arsip,
            'search' => $search,
            'sortField' => $sortField,
            'sortOrder' => $sortOrder,
        ]);
    }

    public function suratEdit($id, $filename)
    {
        $file = storage_path('app/arsip_surat/'.$filename);

        if (!file_exists($file)) {
            abort(404);
        }

        $surat = ArsipSurat::find($id);
        $arrayData = json_decode($surat->json, true);  
        $idTipeSurat = $surat->id_klasifikasi_surat;
        $id_tipe = Surat::find($surat->id_klasifikasi_surat);
        $tipe = $id_tipe->nama;

        $arrayData['id_staf'] = Staf::where('nama', $arrayData['nama_staf'])->first()->id;

        $commonViewData = [
            'title' => 'Ubah Surat ',
            'id_tipe' => $idTipeSurat,
            'surat' => $surat,
            'data' => $arrayData,
            'tipe' => $tipe,
        ];

        switch($idTipeSurat) {
            /**
             * Surat Keterangan Usaha
             * 512
             */
            case 1:
                $view = view('staf.surat.suratEdit1',
                    array_merge(
                        $commonViewData,
                        app(Surat1Service::class)->getViewData()
                    )
                );
                break;

                /**
                 * Surat Keterangan Tidak Mampu
                 * 474.4
                 */
            case 2:
                $view = view('staf.surat.suratEdit2', 
                    array_merge(
                        $commonViewData,
                        app(Surat2Service::class)->getViewData()
                    )
                );
                break;

            /**
             * Surat Keterangan Penghasilan Orang Tua
             * 474.4
             */
            case 3:
                $view = view('staf.surat.suratEdit3', 
                    array_merge(
                        $commonViewData,
                        app(Surat3Service::class)->getViewData()
                    )
                );
                break;

            /**
             * Surat Undangan Pembahasan HUT Bangka Selatan
             * 140
             */
            case 4:
                $view = view('staf.surat.suratEdit4', 
                    array_merge(
                        $commonViewData,
                        app(Surat4Service::class)->getViewData(),
                        [
                            'hari_jadi_num' => Carbon::parse('2003-02-25')->age+1,
                        ]
                    )
                );
                break;

            /**
             * Surat Rekomendasi Izin Keramaian
             * 300
             */
            case 5:
                $view = view('staf.surat.suratEdit5',
                    array_merge(
                        $commonViewData,
                        app(Surat5Service::class)->getViewData()
                    )
                );
                break;
        }
        
        return $view;
    }

    public function suratEditSubmit(Request $request, $id)
    {
        $data = $this->suratSubmit($request, $id);

        ArsipSurat::find($id)->update($data);

        return redirect('/staf/layanan-surat/arsip-surat')->with('success', 'Surat berhasil diubah!');
    }

    public function suratDownload($filename)
    {
        $file = storage_path('app/arsip_surat/'.$filename);

        if (!file_exists($file)) {
            abort(404);
        }

        return response()->download($file);
    }

    public function suratDelete($id, $filename)
    {
        $file = storage_path('app/arsip_surat/'.$filename);

        ArsipSurat::destroy($id);

        if (!file_exists($file)) {
            abort(404);
        }
        Storage::delete($file);

        return redirect('/staf/layanan-surat/arsip-surat')->with('success', 'Surat berhasil dihapus!');
    }
}