<div class="table-responsive table-min-height" id="table-container" data-mdb-perfect-scrollbar='true'>
    <table
        class="table table-condensed table-bordered dataTable table-striped table-hover tabel-daftar table text-nowrap bg-light">
        <thead class="bg-gray color-palette">
            <tr class="bg-dark text-light text-center align-middle">
                <th rowspan="2">NO URUT</th>
                <th rowspan="2">NO KK</th>
                <th rowspan="2">NAMA LENGKAP</th>
                <th rowspan="2">NIK</th>
                <th rowspan="2">JENIS KELAMIN</th>
                <th rowspan="2">TEMPAT/TANGGAL LAHIR</th>
                <th rowspan="2">GOL DARAH</th>
                <th rowspan="2">AGAMA</th>
                <th rowspan="2">PENDIDIKAN</th>
                <th rowspan="2">PEKERJAAN</th>
                <th rowspan="2">ALAMAT</th>
                <th rowspan="2">STATUS PERKAWINAN</th>
                <th rowspan="2">TEMPAT DAN TANGGAL DIKELUARKAN</th>
                <th rowspan="2">STATUS HUB KELUARGA</th>
                <th rowspan="2">KEWARGANEGARAAN</th>
                <th colspan="2">ORANG TUA</th>
                <th rowspan="2">TGL MULAI TINGGAL DI DESA</th>
                <th rowspan="2">KET</th>
            </tr>
            
            <tr class="bg-dark text-light text-center align-middle">
                <th>AYAH</th>
                <th>IBU</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($penduduk as $key => $data)
                <tr class="text-center align-middle">
                    <td>{{ $penduduk->firstItem() + $key }}</td>
                    <td>{{ $data->helperPendudukKeluarga->no_kk ?? '-' }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->nik ?? '-' }}</td>
                    <td>
                        @if ($data->jenisKelamin->id === 1)
							L
						@elseif ($data->jenisKelamin->id === 2)
							P
						@else
							-
						@endif
                    </td>
                    <td>{{ ($data->tempat_lahir ?? '-').', '.($data->tanggal_lahir ? strtoupper($data->tanggal_lahir->translatedFormat('jS F Y')) : '-') }}</td>
                    <td>{{ $data->golonganDarah->nama ?? '-' }}</td>
                    <td>{{ $data->agama->nama ?? '-' }}</td>
                    <td>{{ $data->pendidikanTerakhir->nama ?? '-' }}</td>
                    <td>{{ $data->pekerjaan->nama ?? '-' }}</td>
                    <td>{{ $data->alamat_sekarang ?? '-' }}</td>
                    <td>{{ $data->statusPerkawinan->nama ?? '-' }}</td>
                    <td>
                        @if($data->tempat_cetak_ktp === null || $data->tanggal_cetak_ktp === null)
                            -
                        @else
                            {{ $data->tempat_cetak_ktp.', '.strtoupper($data->tanggal_cetak_ktp->translatedFormat('jS F Y')) }}
                        @endif
                    </td>
                    <td>{{ $data->hubunganKK->nama ?? '-' }}</td>
                    <td>{{ $data->kewarganegaraan->nama ?? '-' }}</td>
                    <td>{{ $data->nama_ayah ?? '-' }}</td>
                    <td>{{ $data->nama_ibu ?? '-' }}</td>
                    <td>{{ $data->created_at ? strtoupper($data->created_at->translatedFormat('jS F Y')) : '-' }}</td>
                    <td>{{ $data->ket ?? '-' }}</td>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-end mt-4">
    {{ $penduduk->links() }}
</div>