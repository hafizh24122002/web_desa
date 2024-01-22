<div class="table-responsive table-min-height" id="table-container" data-mdb-perfect-scrollbar='true'>
    <table
        class="table table-condensed table-bordered dataTable table-striped table-hover tabel-daftar table text-nowrap bg-light">
        <thead class="bg-gray color-palette">
            <tr class="bg-dark text-light text-center align-middle">
                <th rowspan="2">NO URUT</th>
                <th rowspan="2">NAMA LENGKAP</th>
                <th rowspan="2">JENIS KELAMIN</th>
                <th rowspan="2">NOMOR IDENTITAS / TANDA PENGENAL</th>
                <th rowspan="2">TEMPAT DAN TANGGAL LAHIR / UMUR</th>
                <th rowspan="2">PEKERJAAN</th>
                <th colspan="2">KEWARGANEGARAAN</th>
                <th rowspan="2">DATANG DARI</th>
                <th rowspan="2">MAKSUD DAN TUJUAN KEDATANGAN</th>
                <th rowspan="2">NAMA DAN ALAMAT YANG DIDATANGI</th>
                <th rowspan="2">DATANG TANGGAL</th>
                <th rowspan="2">PERGI TANGGAL</th>
                <th rowspan="2">KET</th>
            </tr>
            
            <tr class="bg-dark text-light text-center align-middle">
                <th>KEBANGSAAN</th>
                <th>KETURUNAN</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($logPenduduk as $key => $data)
                <tr class="text-center align-middle">
                    <td>{{ $logPenduduk->firstItem() + $key }}</td>
                    <td>{{ $data->penduduk->nama }}</td>
                    <td>
						@if ($data->penduduk->jenisKelamin->id === 1)
							L
						@elseif ($data->penduduk->jenisKelamin->id === 2)
							P
						@else
							-
						@endif
					</td>
                    <td>
						{{ ($data->penduduk->nik !== null) ? 
							$data->penduduk->nik : (($data->penduduk->tag_id_card !== null) ?
							$data->penduduk->tag_id_card : '-') }}
					</td>
                    <td>
                        {{ ($data->penduduk->tempat_lahir ?? '-').', '.($data->penduduk->tanggal_lahir ? strtoupper($data->penduduk->tanggal_lahir->translatedFormat('jS F Y')) : '-').' / '.$data->penduduk->usia }}
					</td>
                    <td>{{ $data->penduduk->pekerjaan->nama ?? '-' }}</td>
                    <td>{{ $data->penduduk->kewarganegaraan->nama ?? '-' }}</td>
                    <td>{{ $data->penduduk->suku ?? '-' }}</td>
                    <td>{{ $data->penduduk->alamat_sebelumnya ?? '-' }}</td>
                    <td>{{ $data->maksud_tujuan_kedatangan ?? '-' }}</td>
					<td>{{ $data->alamat_tujuan ?? '-' }}</td>
					<td>{{ $data->tanggal_lapor ? strtoupper($data->tanggal_lapor->translatedFormat('jS F Y')) : '-' }}</td> 
					<td>
                        @if ($data->tamu)
                            {{ $data->tamu->logPenduduk ? strtoupper($data->tamu->logPenduduk->tanggal_lapor->translatedFormat('jS F Y')) : '-' }}
                        @else
                            -
                        @endif
                    </td>
					<td>
                        @if ($data->tamu)
                            {{ $data->tamu->logPenduduk ? $data->tamu->logPenduduk->catatan : '-' }}
                        @else
                            -
                        @endif
                    </td>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-end mt-4">
    {{ $logPenduduk->links() }}
</div>