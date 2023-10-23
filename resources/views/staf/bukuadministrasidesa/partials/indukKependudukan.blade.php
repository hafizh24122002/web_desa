<div class="table-responsive table-min-height">
	<table
		class="table table-bordered table-striped table-hover text-nowrap">
		<thead class="bg-gray color-palette">
			<tr class="bg-dark text-light text-center align-middle">
				<th rowspan="2">No</th>
				<th rowspan="2">Nama Lengkap / Panggilan</th>
				<th rowspan="2">NIK</th>
				<th colspan="2">Tempat & Tanggal Lahir</th>
				<th rowspan="2">Jenis Kelamin</th>
				<th rowspan="2">SHDK</th>
				<th rowspan="2">Agama</th>
				<th rowspan="2">Pendidikan Terakhir</th>
				<th rowspan="2">Pekerjaan</th>
				<th colspan="2">Nama Orang Tua Kandung</th>
			</tr>
			<tr class="bg-dark text-light text-center align-middle">
				<th>Tempat Lahir</th>
				<th>Tgl</th>
				<th>Ayah</th>
				<th>Ibu</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($penduduk as $key => $data)
			<tr class="text-center align-middle">
				<td>{{ $penduduk->firstItem() + $key }}</td>

				<td>{{ $data->nama ?? '-' }}</td>
				<td>{{ $data->nik ?? '-' }}</td>
				<td>{{ $data->tempat_lahir ?? '-' }}</td>
				<td>{{ $data->tanggal_lahir ? strtoupper($data->tanggal_lahir->translatedFormat('jS F Y')) : '-' }}</td>

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
					@if ($data->id_status_dasar)
					{{ $data->statusDasar->nama }}
					@else
					{{ "-" }}
					@endif
				</td>

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
				<td>
					{{ $data->nik_ayah ? $data->ayah->nama : ($data->nama_ayah ?? '-') }}
				</td>
				<td>
					{{ $data->nik_ibu ? $data->ibu->nama : ($data->nama_ibu ?? '-') }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<div class="d-flex justify-content-end mt-4">
    {{ $penduduk->links() }}
</div>