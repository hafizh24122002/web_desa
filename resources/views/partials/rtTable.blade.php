
@foreach ($penduduk as $key => $data)
	<tr class="text-center align-middle">
		<td>{{ $penduduk->firstItem() + $key }}</td>

		<td>
			<div  style="display: flex; gap: 5px; justify-content: center;">
				<a href="/staf/kependudukan/penduduk/edit-penduduk/{{ $data->nik }}">
					<button class="btn btn-sm btn-warning">
						<i class="bx bx-edit-alt text-light"></i>
					</button>
				</a>

				<form action="/staf/kependudukan/penduduk/{{ $data->nik }}"
					onsubmit="return confirm('Apakah anda yakin ingin menghapus penduduk dengan NIK {{ $data->nik }}? Penduduk yang dihapus tidak akan bisa dikembalikan!')"
					method="POST">
					
					@method('delete')
					@csrf

					<button class="btn btn-sm btn-danger" type="submit">
						<i class="bx bx-trash text-light"></i>
					</button>
				</form>
			</div>
		</td>

		<td>{{ $data->nik }}</td>

		<td class="text-start">
			@if ($data->nama)
				{{ $data->nama }}	
			@else
				{{ "-" }}
			@endif
		</td>

		<td class="text-start">
			@if ($data->jenis_kelamin === 'L')
				{{ "Laki-laki" }}
			@elseif ($data->jenis_kelamin === 'P')
				{{ "Perempuan" }}
			@else
				{{ "-" }}
			@endif
		</td>

		<td>
			@if ($data->telepon)
				{{ $data->telepon }}
			@else
				{{ "-" }}
			@endif
		</td>

		<td>
			@if ($data->penduduk_tetap)
				{{ "Ya" }}
			@else
				{{ "Tidak" }}
			@endif
		</td>

		<td>
			@if ($data->telepon)
				{{ $data->telepon }}
			@else
				{{ "-" }}
			@endif
		</td>

		<td>
			@if ($data->telepon)
				{{ $data->telepon }}
			@else
				{{ "-" }}
			@endif
		</td>
	</tr>
@endforeach

