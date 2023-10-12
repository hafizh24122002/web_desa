<div class="table-responsive table-min-height">
	<table
		class="table table-condensed table-bordered dataTable table-striped table-hover tabel-daftar table text-nowrap ">
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
				<th width="50px">Tgl</th>
				<th>Ayah</th>
				<th>Ibu</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($penduduk as $key => $data)
			<tr class="text-center align-middle">
				<td>{{ $penduduk->firstItem() + $key }}</td>

				<td class="d-flex gap-1 justify-content-center">
					@if ($data->nama)
					{{ $data->nama }}
					@else
					{{ "-" }}
					@endif
				</td>
				<td>
					@if ($data->nik)
					{{ $data->nik }}
					@else
					{{ "-" }}
					@endif
				</td>

				<td>
					{{ $data->tempat_lahir }}
				</td>

				<td>
					{{ strtoupper($data->tanggal_lahir->translatedFormat('jS F Y')) }}
				</td>

				<td>@if ($data->jenis_kelamin === 'L')
					{{ "Laki-laki" }}
					@elseif ($data->jenis_kelamin === 'P')
					{{ "Perempuan" }}
					@else
					{{ "-" }}
					@endif</td>

				<td>
					@if ($data->status)
					{{ $data->status }}
					@else
					{{ "-" }}
					@endif
				</td>

				<td>
					@if ($data->id_agama)
					{{ $data->id_agama }}
					@else
					{{ "-" }}
					@endif
				</td>

				<td>
					@if ($data->id_pendidikan_terakhir)
					{{ $data->id_pendidikan_terakhir }}
					@else
					{{ "-" }}
					@endif
				</td>
				<td>
					@if ($data->id_pekerjaan)
					{{ ($data->id_pekerjaan) }}
					@else
					{{ "-" }}
					@endif
				</td>
				<td>
					{{-- @if ($data->nik_ayah)
					{{ ($data->nik_ayah) }}
					@else
					{{ "-" }}
					@endif --}}
				</td>
				<td>
					{{-- @if ($data->nik_ibu)
					{{ ($data->nik_ibu) }}
					@else
					{{ "-" }}
					@endif --}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<div class="d-flex justify-content-end mt-4">
    {{ $penduduk->links() }}
</div>