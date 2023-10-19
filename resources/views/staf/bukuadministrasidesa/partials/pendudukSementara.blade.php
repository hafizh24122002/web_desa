<div class="table-responsive table-min-height" id="table-container" data-mdb-perfect-scrollbar='true'>
    <table
        class="table table-condensed table-bordered dataTable table-striped table-hover tabel-daftar table text-nowrap bg-light">
        <thead class="bg-gray color-palette">
            <tr class="bg-dark text-light text-center align-middle">
                <th rowspan="2">NO</th>
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
            @foreach ($penduduk as $key => $data)
                <tr class="text-center align-middle">
                    <td>{{ $penduduk->firstItem() + $key }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>
						@if ($data->jenisKelamin->id === 1)
							L
						@elseif ($data->jenisKelamin->id === 2)
							P
						@else
							-
						@endif
					</td>
                    <td>
						{{ ($data->nik !== null) ? 
							$data->nik : (($data->tag_id_card !== null) ?
							$data->tag_id_card : '-') }}
					</td>
                    <td>
						@if ($data->tempat_lahir !== null || $data->tanggal_lahir !== null)
							{{ $data->tempat_lahir.', '.strtoupper($data->tanggal_lahir->translatedFormat('jS F Y')).' / '.$data->usia }}
						@else
							-
						@endif
					</td>
                    <td>{{ $data->pekerjaan->nama ?? '-' }}</td>
                    <td>{{ $data->kewarganegaraan->nama ?? '-' }}</td>
                    <td>{{ $data->suku ?? '-' }}</td>
                    <td>{{ $data->alamat_sebelumnya ?? '-' }}</td>
                    <td>{{ $todo ?? '-' }}</td> 			{{-- maksud dan tujuan --}}
					<td>{{ $data->alamat_sekarang ?? '-' }}</td>
					<td>{{ $todo ?? '-' }}</td> 			{{-- datang tanggal --}}
					<td>{{ $todo ?? '-' }}</td>				{{-- pergi tanggal --}}
					<td>{{ $todo ?? '-' }}</td>				{{-- ket --}}
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-end mt-4">
    {{ $penduduk->links() }}
</div>