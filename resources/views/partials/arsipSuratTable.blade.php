@foreach ($arsip as $key => $item)
	<tr class="text align-middle text-center">
		<td>{{ $arsip->firstItem() + $key }}</td>

		<td>
			<div style="display: flex; gap: 5px; justify-content: center;">
				<a href="/staf/layanan-surat/arsip-surat/{{ $item->filename }}">
					<button class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Unduh Dokumen">
						<i class="bx bxs-download text-light" style="vertical-align: middle;"></i>
					</button>
				</a>

				<a href="/staf/layanan-surat/arsip-surat/edit-surat/{{ $item->id.'/'.$item->filename }}">
					<button class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Ubah Dokumen">
						<i class="bx bxs-edit text-light" style="vertical-align: middle;"></i>
					</button>
				</a>

				<form action="/staf/layanan-surat/arsip-surat/{{ $item->id.'/'.$item->filename }}"
					onsubmit="return confirm('Apakah anda yakin ingin menghapus surat ini? Surat yang dihapus tidak akan bisa dikembalikan!')"
					method="POST">
					
					@method('delete')
					@csrf

					<button class="btn btn-sm btn-danger" type="submit" data-bs-toggle="tooltip" title="Hapus Dokumen">
						<i class="bx bx-trash text-light" style="vertical-align: middle;"></i>
					</button>
				</form>
			</div>
		</td>

		<td>{{ $item->kode_surat }}</td>
		<td>{{ $item->no_surat }}</td>
		<td class="text-start">{{ $item->nama }}</td>
		<td class="text-start">{{ $item->keterangan }}</td>
		<td class="text-start">{{ $item->tanggal_surat->translatedFormat('jS F Y') }}</td>
		<td class="text-start">{{ $item->created_at->translatedFormat('jS F Y') }}</td>
	</tr>
@endforeach