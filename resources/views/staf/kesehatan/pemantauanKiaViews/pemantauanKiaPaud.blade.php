<a href="/staf/kesehatan/pemantauan/new-sasaran-paud" style="width: auto" class="btn btn-primary my-2">
	<i class="bx bx-plus align-middle"></i> Tambah Data Sasaran PAUD Anak Baru
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
				<th colspan="2">Usia Menurut Kategori</th>
				<th colspan="12">Mengikuti Layanan PAUD (Parenting bagi Orang Tua Anak Usia 2 - &lt;3 Tahun) atau Kelas PAUD bagi Anak 3 - 6 Tahun</th>
			</tr>

			<tr class="text-light text-center align-middle">
				<th>Anak Usia 2 - &lt;3 Tahun</th>
				<th>Anak Usia 3 - 6 Tahun</th>
				
				<th>Januari</th>
				<th>Februari</th>
				<th>Maret</th>
				<th>April</th>
				<th>Mei</th>
				<th>Juni</th>
				<th>Juli</th>
				<th>Agustus</th>
				<th>September</th>
				<th>Oktober</th>
				<th>November</th>
				<th>Desember</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($paud as $key => $data)
			<tr class="align-middle">
				<td class="text-center">{{ $paud->firstitem() + $key }}</td>

				<td>
					<div style="display: flex; gap: 5px; justify-content: center;">
						<a href="/staf/kesehatan/pemantauan/edit-pemantauan-paud/{{ $data->id }}">
							<button class="btn btn-sm btn-warning">
								<i class="bx bx-edit-alt text-light"></i>
							</button>
						</a>

						<form action="/staf/kesehatan/pemantauan/paud/{{ $data->id }}"
							onsubmit="return confirm('Apakah anda yakin ingin menghapus data sasaran PAUD anak dengan nomor KIA {{ $data->no_kia }}? data sasaran PAUD anak yang dihapus tidak akan bisa dikembalikan!')"
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

				<td>
					@if (!$data->umur)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@endif
				</td>

				<td>
					@if ($data->umur)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@endif
				</td>

				<td>
					@if ($data->januari)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->februari)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->maret)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->april)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->mei)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->juni)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->juli)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->agustus)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->september)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->oktober)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->november)
						<i class="bx bx-check fs-4" style="color: green"></i>
					@else
						<i class="bx bx-x fs-4" style="color: red"></i>
					@endif
				</td>

				<td>
					@if ($data->desember)
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
