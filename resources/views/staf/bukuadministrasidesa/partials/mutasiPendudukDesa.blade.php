<div class="table-responsive table-min-height" id="table-container" data-mdb-perfect-scrollbar='true'>
    <table
        class="table table-condensed table-bordered dataTable table-striped table-hover tabel-daftar table text-nowrap bg-light">
        <thead class="bg-gray color-palette">
            <tr class="bg-dark text-light text-center align-middle">
                <th rowspan="2">NO URUT</th>
                <th rowspan="2">NAMA LENGKAP / PANGGILAN</th>
                <th colspan="2">TEMPAT & TANGGAL LAHIR</th>
                <th rowspan="2">JENIS KELAMIN</th>
                <th rowspan="2">KEWARGANEGARAAN</th>
				<th colspan="2">PENAMBAHAN</th>
				<th colspan="4">PENGURANGAN</th>
				<th rowspan="2">KET</th>
            </tr>
            
            <tr class="bg-dark text-light text-center align-middle">
                <th>TEMPAT LAHIR</th>
                <th>TANGGAL</th>
                <th>DATANG DARI</th>
                <th>TANGGAL</th>
                <th>PINDAH KE</th>
                <th>TANGGAL</th>
                <th>MENINGGAL</th>
                <th>TANGGAL</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($logPenduduk as $key => $data)
                <tr class="text-center align-middle">
                    <td>{{ $logPenduduk->firstItem() + $key }}</td>
                    <td>{{ $data->penduduk->nama }}</td>
                    <td>{{ $data->penduduk->tempat_lahir ?? '-' }}</td>
                    <td>{{ $data->penduduk->tanggal_lahir ? strtoupper($data->penduduk->tanggal_lahir->translatedFormat('jS F Y')) : '-' }}</td>
					<td>{{ $data->penduduk->jenisKelamin->nama ?? '-' }}</td>
					<td>{{ $data->penduduk->kewarganegaraan->nama }}</td>
					<td>
						@if ($data->id_peristiwa === 5)
							{{ $data->penduduk->alamat_sebelumnya ?? '-' }}
						@else
							-
						@endif
					</td>
					<td>
						@if ($data->id_peristiwa === 5)
							{{ $data->tanggal_lapor ? strtoupper($data->tanggal_lapor->translatedFormat('jS F Y')) : '-' }}
						@else
							-
						@endif
					</td>
					<td>
						@if ($data->id_peristiwa === 3)
							{{ $data->alamat_tujuan ?? '-' }}
						@else
							-
						@endif
					</td>
					<td>
						@if ($data->id_peristiwa === 3)
							{{ $data->tanggal_lapor ? strtoupper($data->tanggal_lapor->translatedFormat('jS F Y')) : '-' }}
						@else
							-
						@endif
					</td>
					<td>
						@if ($data->id_peristiwa === 2)
							{{ $data->meninggal_di ?? '-' }}
						@else
							-
						@endif
					</td>
					<td>
						@if ($data->id_peristiwa === 2)
							{{ $data->tanggal_lapor ? strtoupper($data->tanggal_lapor->translatedFormat('jS F Y')) : '-' }}
						@else
							-
						@endif
					</td>
					<td>{{ $data->catatan ?? '-' }}</td>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-end mt-4">
    {{ $logPenduduk->links() }}
</div>