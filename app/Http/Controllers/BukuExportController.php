<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

use App\Models\Penduduk;
use App\Models\LogPenduduk;
use App\Models\Tamu;
use App\Models\Staf;
use App\Models\IdentitasDesa;

class BukuExportController extends Controller
{
    public function bukuExport(Request $request, $type, $month, $year)
    {
        switch ($type) {
            case 'indukKependudukan':
                $path = $this->indukKependudukanExport(
                    $type,
                    $month,
                    $year,
                    $request->input('nama'),
                    $request->input('action')
                );
                break;
            case 'mutasiPendudukDesa':
                break;
            case 'rekapitulasiJumlahPenduduk':
                break;
            case 'pendudukSementara':
                $path = $this->pendudukSementaraExport(
                    $type,
                    $month,
                    $year,
                    $request->input('nama'),
                    $request->input('action')
                );
                break;
            case 'ktpKk':
                $path = $this->ktpKkExport(
                    $type,
                    $month,
                    $year,
                    $request->input('nama'),
                    $request->input('action')
                );
                break;
        }

        return response()->file($path)->deleteFileAfterSend(true);
    }

    private function indukKependudukanExport($type, $month, $year, $nama, $action)
    {
        // Load the Excel template
        $templatePath = Storage::path('buku_administrasi_penduduk/induk_penduduk.xlsx');
        $spreadsheet = IOFactory::load($templatePath);

        // Get the active worksheet
        $worksheet = $spreadsheet->getActiveSheet();

        // Set BIP date
        $worksheet->setCellValueByColumnAndRow(1, 7, 'BUKU INDUK PENDUDUK BULAN '.strtoupper(Carbon::create(null, $month, 1)->translatedFormat('F')).' TAHUN '.$year);
        $worksheet->getStyleByColumnAndRow(1, 7)->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'size' => 9,
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Define the row where you want to start inserting data
        $row = 12;

        $request = Request::create(route('buku.getData', ['type' => $type]), 'GET', [
            'month' => $month,
            'year' => $year,
            'nama' => $nama,
        ]);

        $response = app()->handle($request);
        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getContent());
        } else {
            abort($response->getStatusCode(), 'Gagal mengambil data!');
        }

        foreach ($data as $item) {
            // Insert data into the worksheet
            $worksheet->setCellValueByColumnAndRow(1, $row, ($row - 11) ?? '-');
            $worksheet->setCellValueByColumnAndRow(2, $row, $item->nama ?? '-');
            $worksheet->setCellValueByColumnAndRow(3, $row, $item->jenis_kelamin->singkatan ?? '-');
            $worksheet->setCellValueByColumnAndRow(4, $row, $item->status_perkawinan->nama ?? '-');
            $worksheet->setCellValueByColumnAndRow(5, $row, $item->tempat_lahir ?? '-');
            $worksheet->setCellValueByColumnAndRow(6, $row, $item->tanggal_lahir ? strtoupper(Carbon::parse($item->tanggal_lahir)->translatedFormat('jS F Y')) : '-');
            $worksheet->setCellValueByColumnAndRow(7, $row, $item->agama->nama ?? '-');
            $worksheet->setCellValueByColumnAndRow(8, $row, $item->pendidikan_terakhir->nama ?? '-');
            $worksheet->setCellValueByColumnAndRow(9, $row, $item->pekerjaan->nama ?? '-');
            $worksheet->setCellValueByColumnAndRow(10, $row, $item->bahasa->singkatan ?? '-');
            $worksheet->setCellValueByColumnAndRow(11, $row, $item->kewarganegaraan->nama ?? '-');
            $worksheet->setCellValueByColumnAndRow(12, $row, $item->alamat_sekarang ?? '-');
            $worksheet->setCellValueByColumnAndRow(13, $row, $item->hubungan_kk->nama ?? '-');
            $worksheet->setCellValueExplicitByColumnAndRow(14, $row, $item->nik ?? '-', DataType::TYPE_STRING);
            $worksheet->setCellValueExplicitByColumnAndRow(15, $row, $item->helper_penduduk_keluarga->no_kk ?? '-', DataType::TYPE_STRING);
            $worksheet->setCellValueByColumnAndRow(16, $row, $item->ket ?? '-');

            $row++;
        }

        $lastRow = $row - 1;
        $cellRange = 'A12:P' . $lastRow;

        // Get the style for the cell range
        $style = $worksheet->getStyle($cellRange);

        // Define the border style
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $alignment = [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ];
        // Apply the border style to the cell range
        $style->applyFromArray($borderStyle);
        // Apply the alignment to the cell range
        $style->getAlignment()->applyFromArray($alignment);
        $style->getAlignment()->setWrapText(true);

        // Add signatures
        $namaDesa = strtoupper(IdentitasDesa::find(1)->nama_desa);
        $worksheet->getStyle('B'. $row+1 .':O' . $row+7)->getAlignment()->setWrapText(false);
        $worksheet->setCellValueByColumnAndRow(3, $row+1, 'MENGETAHUI');
        $worksheet->setCellValueByColumnAndRow(14, $row+1, $namaDesa.', '.Carbon::now()->translatedFormat('jS F Y'));
        $worksheet->setCellValueByColumnAndRow(3, $row+2, 'KEPALA DESA '.$namaDesa);
        $worksheet->setCellValueByColumnAndRow(14, $row+2, 'SEKRETARIS DESA '.$namaDesa);
        $worksheet->setCellValueByColumnAndRow(3, $row+7, Staf::where('jabatan', 'Kepala Desa')->value('nama'));
        $worksheet->setCellValueByColumnAndRow(14, $row+7, Staf::where('jabatan', 'Sekretaris Desa')->value('nama'));

        // Save the modified Excel file
        if ($action === 'print') {
            $writer = new Mpdf($spreadsheet);

            $outputDirectory = public_path('storage/temps');
            $outputPath = $outputDirectory . '/' . 'buku_temp.pdf';
        } else if ($action === 'download') {
            $writer = new Xlsx($spreadsheet);

            $outputDirectory = public_path('storage/temps');
            $outputPath = $outputDirectory . '/' . 'buku_temp.xlsx';
        } else {
            abort(422, 'Action tidak terdefinisi!');
        }

        $writer->save($outputPath);

        return $outputPath;
    }

    private function mutasiPendudukDesaExport($type, $month, $year, $nama, $action)
    {
        // TODO
    }

    private function rekapitulasiJumlahPendudukExport()
    {
        // TODO
    }

    private function pendudukSementaraExport($type, $month, $year, $nama, $action)
    {
        // Load the Excel template
        $templatePath = Storage::path('buku_administrasi_penduduk/penduduk_sementara.xlsx');
        $spreadsheet = IOFactory::load($templatePath);

        // Get the active worksheet
        $worksheet = $spreadsheet->getActiveSheet();

        // Set BIP date
        $worksheet->setCellValueByColumnAndRow(1, 7, 'BUKU PENDUDUK SEMENTARA TAHUN '.$year);
        $worksheet->getStyleByColumnAndRow(1, 7)->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'size' => 9,
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Define the row where you want to start inserting data
        $row = 12;

        $request = Request::create(route('buku.getData', ['type' => $type]), 'GET', [
            'month' => $month,
            'year' => $year,
            'nama' => $nama,
        ]);

        $response = app()->handle($request);
        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getContent());
        } else {
            abort($response->getStatusCode(), 'Gagal mengambil data!');
        }

        foreach ($data as $item) {
            // Insert data into the worksheet
            $worksheet->setCellValueByColumnAndRow(1, $row, ($row - 11) ?? '-');
            $worksheet->setCellValueByColumnAndRow(2, $row, $item->penduduk->nama ?? '-');
            if ($item->penduduk->jenis_kelamin->id === 1) {
                $worksheet->setCellValueByColumnAndRow(3, $row, $item->penduduk->jenis_kelamin->singkatan);
            }
            if ($item->penduduk->jenis_kelamin->id === 2) {
                $worksheet->setCellValueByColumnAndRow(4, $row, $item->penduduk->jenis_kelamin->singkatan);
            }
            $worksheet->setCellValueExplicitByColumnAndRow(5, $row, $item->penduduk->nik ?? $item->penduduk->tag_id_card ??'-', DataType::TYPE_STRING);
            $worksheet->setCellValueByColumnAndRow(6, $row, ($item->penduduk->tempat_lahir ?? '-').', '.($item->penduduk->tanggal_lahir ? strtoupper(Carbon::parse($item->penduduk->tanggal_lahir)->translatedFormat('jS F Y')) : '-').' / '.$item->penduduk->usia ?? '-');
            $worksheet->setCellValueByColumnAndRow(7, $row, $item->penduduk->pekerjaan->nama ?? '-');
            $worksheet->setCellValueByColumnAndRow(8, $row, $item->penduduk->kewarganegaraan->nama ?? '-');
            $worksheet->setCellValueByColumnAndRow(9, $row, $item->penduduk->suku ?? '-');
            $worksheet->setCellValueByColumnAndRow(10, $row, $item->penduduk->alamat_sebelumnya ?? '-');
            $worksheet->setCellValueByColumnAndRow(11, $row, $item->maksud_tujuan_kedatangan ?? '-');
            $worksheet->setCellValueByColumnAndRow(12, $row, $item->alamat_tujuan ?? '-');
            $worksheet->setCellValueByColumnAndRow(13, $row, $item->tanggal_lapor ? strtoupper(Carbon::parse($item->tanggal_lapor)->translatedFormat('jS F Y')) : '-');
            $worksheet->setCellValueByColumnAndRow(14, $row, $item->tamu ? ($item->tamu->logPenduduk ? strtoupper(Carbon::parse($item->tamu->logPenduduk->tanggal_lapor)->translatedFormat('jS F Y')) : '-') : '-');
            $worksheet->setCellValueByColumnAndRow(15, $row, $item->tamu ? ($item->tamu->logPenduduk ? $item->tamu->logPenduduk->catatan : '-') : '-');

            $row++;
        }

        $lastRow = $row - 1;
        $cellRange = 'A12:O' . $lastRow;

        // Get the style for the cell range
        $style = $worksheet->getStyle($cellRange);

        // Define the border style
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $alignment = [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ];

        // Apply the border style to the cell range
        $style->applyFromArray($borderStyle);

        // Apply the alignment to the cell range
        $style->getAlignment()->applyFromArray($alignment);
        $style->getAlignment()->setWrapText(true);

        // Add signatures
        $namaDesa = strtoupper(IdentitasDesa::find(1)->nama_desa);
        $worksheet->getStyle('B'. $row+1 .':N' . $row+7)->getAlignment()->setWrapText(false);
        $worksheet->setCellValueByColumnAndRow(3, $row+1, 'MENGETAHUI');
        $worksheet->setCellValueByColumnAndRow(13, $row+1, $namaDesa.', '.Carbon::now()->translatedFormat('jS F Y'));
        $worksheet->setCellValueByColumnAndRow(3, $row+2, 'KEPALA DESA '.$namaDesa);
        $worksheet->setCellValueByColumnAndRow(13, $row+2, 'SEKRETARIS DESA '.$namaDesa);
        $worksheet->setCellValueByColumnAndRow(3, $row+7, Staf::where('jabatan', 'Kepala Desa')->value('nama'));
        $worksheet->setCellValueByColumnAndRow(13, $row+7, Staf::where('jabatan', 'Sekretaris Desa')->value('nama'));

        // Save the modified Excel file
        if ($action === 'print') {
            $writer = new Mpdf($spreadsheet);

            $outputDirectory = public_path('storage/temps');
            $outputPath = $outputDirectory . '/' . 'buku_temp.pdf';
        } else if ($action === 'download') {
            $writer = new Xlsx($spreadsheet);

            $outputDirectory = public_path('storage/temps');
            $outputPath = $outputDirectory . '/' . 'buku_temp.xlsx';
        } else {
            abort(422, 'Action tidak terdefinisi!');
        }

        $writer->save($outputPath);

        return $outputPath;
    }

    private function ktpKkExport($type, $month, $year, $nama, $action)
    {
        // Load the Excel template
        $templatePath = Storage::path('buku_administrasi_penduduk/ktp_kk.xlsx');
        $spreadsheet = IOFactory::load($templatePath);

        // Get the active worksheet
        $worksheet = $spreadsheet->getActiveSheet();

        // Set date
        $worksheet->setCellValueByColumnAndRow(1, 7, 'BUKU KARTU TANDA PENDUDUK TAHUN '.$year.' DAN KARTU KELUARGA');
        $worksheet->getStyleByColumnAndRow(1, 7)->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'size' => 9,
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Define the row where you want to start inserting data
        $row = 12;

        $request = Request::create(route('buku.getData', ['type' => $type]), 'GET', [
            'month' => $month,
            'year' => $year,
            'nama' => $nama,
        ]);

        $response = app()->handle($request);
        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getContent());
        } else {
            abort($response->getStatusCode(), 'Gagal mengambil data!');
        }

        foreach ($data as $item) {
            if ($item->tempat_cetak_ktp && $item->tanggal_cetak_ktp) {
                $cetakKtp = $item->tempat_cetak_ktp.', '.strtoupper(Carbon::parse($item->tanggal_cetak_ktp)->translatedFormat('jS F Y'));
            /* Uncomment this part if you want to show the available cetak_ktp data even if it is incomplete */
            // } else if ($item->tempat_cetak_ktp && !$item->tanggal_cetak_ktp) {
            //     $cetakKtp = $item->tempat_cetak_ktp.', -';
            // } else if (!$item->tempat_cetak_ktp && $item->tanggal_cetak_ktp) {
            //     $cetakKtp = '-, '.strtoupper(Carbon::parse($item->tanggal_cetak_ktp)->translatedFormat('jS F Y'));
            } else {
                $cetakKtp = '-';
            }

            // Insert data into the worksheet
            $worksheet->setCellValueByColumnAndRow(1, $row, ($row - 11) ?? '-');
            $worksheet->setCellValueExplicitByColumnAndRow(2, $row, $item->helper_penduduk_keluarga->no_kk ?? '-', DataType::TYPE_STRING);
            $worksheet->setCellValueByColumnAndRow(3, $row, $item->nama ?? '-');
            $worksheet->setCellValueExplicitByColumnAndRow(4, $row, $item->nik ?? '-', DataType::TYPE_STRING);
            $worksheet->setCellValueByColumnAndRow(5, $row, $item->jenis_kelamin->singkatan ?? '-');
            $worksheet->setCellValueByColumnAndRow(6, $row, ($item->tempat_lahir ?? '-').', '.($item->tanggal_lahir ? strtoupper(Carbon::parse($item->tanggal_lahir)->translatedFormat('jS F Y')) : '-'));
            $worksheet->setCellValueByColumnAndRow(7, $row, $item->golongan_darah->nama);
            $worksheet->setCellValueByColumnAndRow(8, $row, $item->agama->nama ?? '-');
            $worksheet->setCellValueByColumnAndRow(9, $row, $item->pendidikan_terakhir->nama ?? '-');
            $worksheet->setCellValueByColumnAndRow(10, $row, $item->pekerjaan->nama ?? '-');
            $worksheet->setCellValueByColumnAndRow(11, $row, $item->alamat_sekarang ?? '-');
            $worksheet->setCellValueByColumnAndRow(12, $row, $item->status_perkawinan->nama ?? '-');
            $worksheet->setCellValueByColumnAndRow(13, $row, $cetakKtp);
            $worksheet->setCellValueByColumnAndRow(14, $row, $item->hubungan_kk->nama ?? '-');
            $worksheet->setCellValueByColumnAndRow(15, $row, $item->kewarganegaraan->nama ?? '-');
            $worksheet->setCellValueByColumnAndRow(16, $row, $item->nama_ayah ?? '-');
            $worksheet->setCellValueByColumnAndRow(17, $row, $item->nama_ibu ?? '-');
            $worksheet->setCellValueByColumnAndRow(18, $row, $item->tanggal_lapor ? strtoupper(Carbon::parse($item->tanggal_lapor)->translatedFormat('jS F Y')) : '-');
            $worksheet->setCellValueByColumnAndRow(19, $row, $item->ket ?? '-');

            $row++;
        }

        $lastRow = $row - 1;
        $cellRange = 'A12:S' . $lastRow;

        // Get the style for the cell range
        $style = $worksheet->getStyle($cellRange);

        // Define the border style
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $alignment = [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ];

        // Apply the border style to the cell range
        $style->applyFromArray($borderStyle);

        // Apply the alignment to the cell range
        $style->getAlignment()->applyFromArray($alignment);
        $style->getAlignment()->setWrapText(true);

        // Add signatures
        $namaDesa = strtoupper(IdentitasDesa::find(1)->nama_desa);
        $worksheet->getStyle('B'. $row+1 .':O' . $row+7)->getAlignment()->setWrapText(false);
        $worksheet->setCellValueByColumnAndRow(3, $row+1, 'MENGETAHUI');
        $worksheet->setCellValueByColumnAndRow(17, $row+1, $namaDesa.', '.Carbon::now()->translatedFormat('jS F Y'));
        $worksheet->setCellValueByColumnAndRow(3, $row+2, 'KEPALA DESA '.$namaDesa);
        $worksheet->setCellValueByColumnAndRow(17, $row+2, 'SEKRETARIS DESA '.$namaDesa);
        $worksheet->setCellValueByColumnAndRow(3, $row+7, Staf::where('jabatan', 'Kepala Desa')->value('nama'));
        $worksheet->setCellValueByColumnAndRow(17, $row+7, Staf::where('jabatan', 'Sekretaris Desa')->value('nama'));

        // Save the modified Excel file
        if ($action === 'print') {
            $writer = new Mpdf($spreadsheet);

            $outputDirectory = public_path('storage/temps');
            $outputPath = $outputDirectory . '/' . 'buku_temp.pdf';
        } else if ($action === 'download') {
            $writer = new Xlsx($spreadsheet);

            $outputDirectory = public_path('storage/temps');
            $outputPath = $outputDirectory . '/' . 'buku_temp.xlsx';
        } else {
            abort(422, 'Action tidak terdefinisi!');
        }

        $writer->save($outputPath);

        return $outputPath;
    }
}
