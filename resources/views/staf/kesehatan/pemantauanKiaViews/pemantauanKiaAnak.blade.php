<a href="/staf/kesehatan/pemantauan/new-pemantauan-anak" style="width: auto" class="btn btn-primary my-2">
	<i class="bx bx-plus align-middle"></i> Tambah Data Anak Baru
</a>
<a href="/staf/kesehatan/pemantauan/scorecard" style="width: auto" class="btn btn-success my-2">
	<i class="bi bi-list-ol align-middle"></i> Scorecard
</a>

<div style="width: 100%; overflow-x: auto;">
	<table class="table table-hover table-bordered">
		<thead class="table-dark">
			<tr class="text-light text-center align-middle">
				<th rowspan="2">No</th>
				<th rowspan="2">Aksi</th>
				<th rowspan="2">No KIA</th>
				<th rowspan="2">Nama Anak</th>
				<th rowspan="2">Tanggal Periksa</th>
				<th rowspan="2">Jenis Kelamin</th>
				<th rowspan="2">Tanggal Lahir Anak</th>
				<th rowspan="2">Status Gizi Anak</th>
				<th rowspan="2">Berat Badan Anak</th>
				<th rowspan="2">Tinggi Badan Anak</th>
				<th colspan="2">Umur dan Status Tikar</th>
				<th colspan="11">Indikator Layanan</th>
			</tr>

			<tr class="text-light text-center align-middle">
				<th>Umur (Bulan)</th>
				<th>Hasil (M/K/H)</th>
				
				<th>Pemberian Imunisasi Dasar</th>
				<th>Pengukuran Berat Badan</th>
				<th>Pengukuran Tinggi Badan</th>
				<th>Konseling Gizi Ayah</th>
				<th>Konseling Gizi Ibu</th>
				<th>Kunjungan Rumah</th>
				<th>Kepemilikan Akses Air Bersih</th>
				<th>Kepemilikan Jamban Sehat</th>
				<th>Akta Lahir</th>
				<th>Jaminan Kesehatan</th>
				<th>Pengasuhan (PAUD)</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($anak as $key => $data)
			<tr class="align-middle">
				<td class="text-center">{{ $anak->firstitem() + $key }}</td>

				<td>
					<div style="display: flex; gap: 5px; justify-content: center;">
						<a href="/staf/kesehatan/pemantauan/edit-pemantauan-anak/{{ $data->id }}">
							<button class="btn btn-sm btn-warning">
								<i class="bx bx-edit-alt text-light"></i>
							</button>
						</a>

						<form action="/staf/kesehatan/pemantauan/anak/{{ $data->id }}"
							onsubmit="return confirm('Apakah anda yakin ingin menghapus data anak dengan nomor KIA {{ $data->no_kia }}? data anak yang dihapus tidak akan bisa dikembalikan!')"
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

				<td>{{ $data->kia->anak->nama }}</td>

				<td>{{ $data->tanggal_periksa->translatedFormat('jS F Y') }}</td>

				<td>{{ $data->kia->anak->jenis_kelamin }}</td>

				<td>{{ $data->kia->anak->tanggal_lahir ? \Illuminate\Support\Carbon::parse($data->kia->anak->tanggal_lahir)->translatedFormat('jS F Y') : '-' }}</td>

				<td>{{ $data->status_gizi_anak }}</td>

				<td>{{ $data->berat_badan ?? '-' }}</td>

				<td>{{ $data->tinggi_badan ?? '-' }}</td>

				<td>
					{{ $data->umur ?? '-' }}
				</td>
				
				<td>{{ $data->hasil_status_tikar }}</td>

				<td>
					@if ($data->imunisasi_dasar)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->pengukuran_berat_badan)
						{{ 'Ya, '.$data->berat_badan.' kg' }}
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->pengukuran_tinggi_badan)
						{{ 'Ya, '.$data->tinggi_badan.' cm' }}
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->konseling_gizi_ayah)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->konseling_gizi_ibu)
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
					@if ($data->akta_lahir)
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

				<td>
					@if ($data->pengasuhan_paud)
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
	{{ $anak->links() }}
</div>
