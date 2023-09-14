@foreach ($kia as $key => $data)
	<tr class="align-middle">
		<td class="text-center">{{ $kia->firstitem() + $key }}</td>

		<td >
			<div style="display: flex; gap: 5px; justify-content: center;">
				<a href="/staf/kesehatan/kia/edit-kia/{{ $data->id }}">
					<button class="btn btn-sm btn-warning">
						<i class="bx bx-edit-alt text-light"></i>
					</button>
				</a>
	
				<form action="/staf/kesehatan/kia/{{ $data->id }}"
					onsubmit="return confirm('Apakah anda yakin ingin menghapus KIA dengan nomor {{ $data->no_kia }}? KIA yang dihapus tidak akan bisa dikembalikan!')"
					method="POST">
					
					@method('delete')
					@csrf
	
					<button class="btn btn-sm btn-danger" type="submit">
						<i class="bx bx-trash text-light"></i>
					</button>
				</form>
			</div>
		</td>

		<td>{{ $data->no_kia }}</td>

		<td>
			{{ $data->nama_ibu ?? '-' }}	
		</td>

		<td>
			{{ $data->nama_anak ?? '-' }}
		</td>

		<td>
			{{ $data->perkiraan_lahir ? $data->perkiraan_lahir->translatedFormat('jS F Y') : '-' }}
		</td>
	</tr>
@endforeach