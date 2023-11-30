
@foreach ($penduduk as $key => $data)
	<tr class="text-center align-middle">
		<td>{{ $penduduk->firstItem() + $key }}</td>

		<td>
			<div  style="display: flex; gap: 5px; justify-content: center;">
				<a href="/staf/kependudukan/penduduk/detail-penduduk/{{ $data->nik }}">
					<button class="btn btn-sm btn-info"
						data-mdb-toggle="tooltip"
						data-mdb-placement="bottom"
						title="Detail penduduk">

						<i class="bx bxs-detail text-light"></i>
					</button>
				</a>

				<form action="/staf/kependudukan/penduduk/{{ $data->nik }}"
					onsubmit="return confirm('Apakah anda yakin ingin menghapus penduduk dengan NIK {{ $data->nik }}? Penduduk yang dihapus tidak akan bisa dikembalikan!')"
					method="POST">
					
					@method('delete')
					@csrf

					<button class="btn btn-sm btn-danger"
						type="submit" data-mdb-toggle="tooltip"
						data-mdb-placement="bottom"
						title="Hapus penduduk">
						
						<i class="bx bxs-trash text-light"></i>
					</button>
				</form>

				<div>
					<button class="btn btn-sm btn-warning dropdown-toggle w-auto"
						type="button"
						id="editDropdownMenuButton"
						data-mdb-toggle="dropdown"
						aria-expanded="false">

						<i class="bx bxs-edit-alt text-light"></i>
					</button>

					<ul class="dropdown-menu shadow" style="width: fit-content" aria-labelledby="editDropdownMenuButton">
						<li><a class="dropdown-item" href="/staf/kependudukan/penduduk/edit-penduduk/{{ $data->nik }}">Ubah detail penduduk</a></li>
						<li><a class="dropdown-item" href="/staf/kependudukan/penduduk/edit-penduduk/status-dasar/{{ $data->nik }}">Ubah status dasar penduduk</a></li>
					</ul>
				</div>
			</div>
		</td>

		<td class="text-start">{{ $data->nik ?? '-' }}</td>
		<td class="text-start">{{ $data->nama ?? '-' }}</td>
		<td class="text-start">{{ $data->helperPendudukKeluarga->no_kk ?? '-' }}</td>
		<td class="text-start">{{ $data->nama_ayah ?? '-' }}</td>
		<td class="text-start">{{ $data->nama_ibu ?? '-' }}</td>
		<td class="text-start">{{ $data->alamat_sekarang ?? '-' }}</td>
		<td class="text-start">{{ $data->todo ?? '-' }}</td>
		<td class="text-start">{{ $data->todo ?? '-' }}</td>
		<td class="text-start">{{ $data->todo ?? '-' }}</td>
		<td class="text-start">{{ $data->pendidikanTerakhir->nama ?? '-' }}</td>
		<td class="text-start">{{ $data->getUsiaAttribute() ?? '-' }}</td>
		<td class="text-start">{{ $data->pekerjaan->nama ?? '-' }}</td>
		<td class="text-start">{{ $data->statusPerkawinan->nama ?? '-' }}</td>
		<td class="text-start">{{ $data->tanggal_peristiwa ?? '-' }}</td>
		<td class="text-start">{{ $data->tanggal_lapor ?? '-' }}</td>









	</tr>
@endforeach

