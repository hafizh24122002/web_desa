@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
				{{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
					'title' => 'Manajemen Dokumen',
					'parent_page' => 'Manajemen Web',
					'parent_link' => '/staf/manajemen-web/dashboard',
					'current_page' => 'Dokumen'
					])

				{{-- content --}}
				<div class="row mt-3 container">
					@if (session()->has('success'))
						<div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif

					<a href="/staf/manajemen-web/dokumen/new-dokumen" style="width: auto" class="btn btn-primary my-2">
						<i class="bx bx-plus align-middle"></i> Tambah Dokumen Baru
					</a>

					<table class="table table-hover">
						<thead>
							<tr class="bg-dark text-light text-center align-middle">
								<th>No</th>
								<th>Aksi</th>
								<th>Judul</th>
								<th>Keterangan</th>
								<th>Ditulis pada</th>
								<th>Diedit pada</th>
								<th>Aktif</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($documents as $key => $item)
								<tr class="text-center align-middle">
									<td>{{ $documents->firstitem() + $key }}</td>

									<td>
										<div style="display: flex; gap: 5px; justify-content: center;">
											<a href="/staf/manajemen-web/dokumen/edit-dokumen/{{ $item->id }}">
												<button class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit dokumen">
													<i class="bx bx-edit-alt text-light"></i>
												</button>
											</a>
											
											<form action="/staf/manajemen-web/dokumen/{{ $item->id }}"
												onsubmit="return confirm('Apakah anda yakin ingin menghapus dokumen dengan judul {{ $item->judul }}? Dokumen yang dihapus tidak akan bisa dikembalikan!')"
												method="POST">
												
												@method('delete')
												@csrf

												<button class="btn btn-sm btn-danger" type="submit" data-bs-toggle="tooltip"title="Hapus dokumen">
													<i class="bx bx-trash text-light"></i>
												</button>
											</form>
										</div>
									</td>

									<td>{{ $item->judul }}</td>
									<td>{{ $item->keterangan }}</td>
									<td>{{ $item->created_at->translatedFormat('jS F Y') }}</td>
									<td>{{ $item->updated_at->translatedFormat('jS F Y') }}</td>

									<td>
										@if ($item->is_active)
											<i class="bx bx-check fs-4" style="color: green"></i>
										@else
											<i class="bx bx-x fs-4" style="color: red"></i>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					<div class="d-flex justify-content-end">
						{{ $documents->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')

@endsection