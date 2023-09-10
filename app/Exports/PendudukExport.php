<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendudukExport implements FromQuery, WithHeadings, WithStyles, WithMapping
{
    use Exportable;

    private $rowNumber = 1; // Inisialisasi nomor baris

    public function query()
    {
        return Penduduk::query()
            ->select(
                'nama',
                'nik',
                'tempat_lahir',
                'tanggal_lahir',
                'jenis_kelamin',
                'status',
                'id_agama',
                'id_pendidikan_terakhir',
                'id_pekerjaan',
                'nik_ayah',
                'nik_ibu'
            )
            ->with([
                'agama:id,nama', // Select only the 'id' and 'nama' columns from the 'agama' relationship
                'pendidikanTerakhir:id,nama', // Select only the 'id' and 'nama' columns from the 'pendidikanTerakhir' relationship
                'pekerjaan:id,nama', // Select only the 'id' and 'nama' columns from the 'pekerjaan' relationship
            ])
            ->whereNotNull('id_agama')
            ->whereNotNull('id_pendidikan_terakhir')
            ->whereNotNull('id_pekerjaan');
    }

    public function headings(): array
    {
        return [
            ['No', 'Nama Lengkap / Panggilan', 'NIK', 'Tempat Lahir', 'Tgl', 'Jenis Kelamin', 'SHDK', 'Agama', 'Pendidikan Terakhir', 'Pekerjaan', 'Orang Tua Kandung', ''],
            ['', '', '', 'Tempat Lahir', 'Tgl', '', '', '', '', '', 'Ayah', 'Ibu'],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Tambahkan gaya di sini, misalnya, menambahkan border ke seluruh data
        $sheet->getStyle('A1:L2')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A2:L2')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A3:L' . ($sheet->getHighestRow()))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Set wrap text untuk semua kolom
        foreach (range('A', 'L') as $column) {
            $sheet->getStyle($column . '1:' . $column . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
        }

        // Set lebar kolom secara manual
        $sheet->getColumnDimension('A')->setWidth(5); // Misalnya, lebar kolom A adalah 5
        $sheet->getColumnDimension('B')->setWidth(20); // Misalnya, lebar kolom B adalah 20
        // Lanjutkan untuk kolom lain sesuai kebutuhan.

        // Merge cells for Tempat & Tanggal Lahir
        $sheet->mergeCells('D1:E1');

        // Merge cells for Nama Orang Tua Kandung
        $sheet->mergeCells('K1:L1');

        $sheet->mergeCells('A1:A2');
        $sheet->mergeCells('B1:B2');
        $sheet->mergeCells('C1:C2');
        $sheet->mergeCells('F1:F2');
        $sheet->mergeCells('G1:G2');
        $sheet->mergeCells('H1:H2');
        $sheet->mergeCells('I1:I2');
        $sheet->mergeCells('J1:J2');
    }

    public function map($penduduk): array
{
    return [
        $this->rowNumber++, // Nomor berurutan
        $penduduk->nama,
        $penduduk->nik,
        $penduduk->tempat_lahir,
        $penduduk->tanggal_lahir,
        $penduduk->jenis_kelamin,
        $penduduk->status ?? '-', // Use "-" if 'status' is empty
        $penduduk->agama->nama ?? '-', // Use "-" if 'agama' is empty
        $penduduk->pendidikanTerakhir->nama ?? '-', // Use "-" if 'pendidikanTerakhir' is empty
        $penduduk->pekerjaan->nama ?? '-', // Use "-" if 'pekerjaan' is empty
        $penduduk->nik_ayah,
        $penduduk->nik_ibu,
    ];
}
}
