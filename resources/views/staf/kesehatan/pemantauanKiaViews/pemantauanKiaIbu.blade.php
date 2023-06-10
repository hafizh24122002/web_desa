<a href="/staf/kesehatan/pemantauan/new-pemantauan-ibu" style="width: auto" class="btn btn-primary my-2">
	<i class="bx bx-plus align-middle"></i> Tambah Data Ibu Hamil Baru
</a>

<div style="width: 100%; overflow-x: auto;">
	<table class="table table-hover table-bordered">
		<thead class="table-dark">
			<tr class="text-light text-center align-middle">
				<th rowspan="2">No</th>
				<th rowspan="2">Aksi</th>
				<th rowspan="2">No KIA</th>
				<th rowspan="2">Nama Ibu</th>
				<th rowspan="2">Tanggal Periksa</th>
				<th rowspan="2">Status Kehamilan</th>
				<th rowspan="2">Perkiraan Kelahiran</th>
				<th colspan="2">Usia Kehamilan dan Persalinan</th>
				<th colspan="8">Status Penerimaan Indikator</th>
			</tr>

			<tr class="text-light text-center align-middle">
				<th>Usia Kehamilan (Bulan)</th>
				<th>Tanggal Melahirkan</th>
				
				<th>Pemeriksaan Kehamilan</th>
				<th>Dapat & Konsumsi Pil Fe</th>
				<th>Pemeriksaan Nifas</th>
				<th>Konseling Gizi</th>
				<th>Kunjungan Rumah</th>
				<th>Akses Air Bersih</th>
				<th>Kepemilikan Jamban</th>
				<th>Jaminan Kesehatan</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($ibu as $key => $data)
			<tr class="align-middle">
				<td class="text-center">{{ $ibu->firstitem() + $key }}</td>

				<td>
					<div style="display: flex; gap: 5px; justify-content: center;">
						<a href="/staf/kesehatan/pemantauan/edit-pemantauan-ibu/{{ $data->id }}">
							<button class="btn btn-sm btn-warning">
								<i class="bx bx-edit-alt text-light"></i>
							</button>
						</a>

						<form action="/staf/kesehatan/pemantauan/ibu/{{ $data->id }}"
							onsubmit="return confirm('Apakah anda yakin ingin menghapus data ibu hamil dengan nomor KIA {{ $data->no_kia }}? data ibu hamil yang dihapus tidak akan bisa dikembalikan!')"
							method="POST">
							
							@method('delete')
							@csrf

							<button class="btn btn-sm btn-danger" type="submit">
								<i class="bx bx-trash text-light"></i>
							</button>
						</form>
					</div>
				</td>

				<td>{{ $data->kia->no_kia }}</td>

				<td>{{ $data->kia->ibu->nama }}</td>

				<td>{{ $data->tanggal_periksa->translatedFormat('jS F Y') }}</td>

				<td>{{ $data->status_kehamilan }}</td>

				<td>{{ $data->kia->perkiraan_lahir ?? '-' }}</td>

				<td>{{ $data->usia_kehamilan }}</td>

				<td>
					{{ $data->tanggal_melahirkan ? $data->tanggal_melahirkan->translatedFormat('jS F Y') : '-' }}</td>

				<td>
					@if ($data->pemeriksaan_kehamilan)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->konsumsi_pil_fe)
						{{ 'Ya, '.$data->butir_pil_fe.' butir' }}
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->pemeriksaan_nifas)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->konseling_gizi)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->kunjungan_rumah)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->akses_air_bersih)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->kepemilikan_jamban)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->jaminan_kesehatan)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>
			</tr>
		@endforeach											
		</tbody>
	</table>							
</div>

<div class="d-flex justify-content-end">
	{{ $ibu->links() }}
</div>
