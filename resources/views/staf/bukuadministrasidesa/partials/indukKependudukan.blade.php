<div class="table-responsive table-min-height">
	<table
		class="table table-bordered table-striped table-hover text-nowrap">
		<thead class="bg-gray color-palette">
			<tr class="bg-dark text-light text-center align-middle">
				<th rowspan="2">NOMOR URUT</th>
				<th rowspan="2">NAMA LENGKAP / PANGGILAN</th>
				<th rowspan="2">JENIS KELAMIN</th>
				<th rowspan="2">STATUS PERKAWINAN</th>
				<th colspan="2">TEMPAT & TANGGAL LAHIR</th>
				<th rowspan="2">AGAMA</th>
				<th rowspan="2">PENDIDIKAN TERAKHIR</th>
				<th rowspan="2">PEKERJAAN</th>
				<th rowspan="2">DAPAT MEMBACA HURUF</th>
				<th rowspan="2">KEWARGANEGARAAN</th>
				<th rowspan="2">ALAMAT LENGKAP</th>
				<th rowspan="2">KEDUDUKAN DLM KELUARGA</th>
				<th rowspan="2">NIK</th>
				<th rowspan="2">NO. KK</th>
				<th rowspan="2">KET</th>

			</tr>
			<tr class="bg-dark text-light text-center align-middle">
				<th>Tempat Lahir</th>
				<th>Tgl</th>
			</tr>
		</thead>
		<tbody>
			
			@foreach ($penduduk as $key => $data)
			<tr class="text-center align-middle">
				<td>{{ $penduduk->firstItem() + $key }}</td>

				<td>{{ $data->nama ?? '-' }}</td>

				<td>
					{{ $data->jenisKelamin->singkatan ?? '-' }}
				</td>

				<td>{{ $data->statusPerkawinan->nama ?? '-' }}</td>
				<td>{{ $data->tempat_lahir ?? '-' }}</td>
				<td>{{ $data->tanggal_lahir ? strtoupper($data->tanggal_lahir->translatedFormat('jS F Y')) : '-' }}</td>

				<td>
					@if ($data->id_agama)
					{{ $data->agama->nama }}
					@else
					{{ "-" }}
					@endif
				</td>

				<td>
					@if ($data->id_pendidikan_terakhir)
					{{ $data->pendidikanTerakhir->nama }}
					@else
					{{ "-" }}
					@endif
				</td>

				<td>
					@if ($data->id_pekerjaan)
					{{ ($data->pekerjaan->nama) }}
					@else
					{{ "-" }}
					@endif
				</td>

				<td>{{ $data->bahasa->singkatan ?? '-' }}</td>
				<td>{{ $data->kewarganegaraan->nama ?? '-' }}</td>
				<td>{{ $todo->alamat ?? '-' }}</td>
				<td>{{ $data->hubunganKK->nama ?? '-' }}</td>
				<td>{{ $data->nik ?? '-' }}</td>
				<td>{{ $data->helperPendudukKeluarga->no_kk ?? '-' }}</td>
				<td>{{ $data->ket ?? '-' }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<div class="d-flex justify-content-end mt-4" id="pagination-links">
    {{ $penduduk->links() }}
</div>