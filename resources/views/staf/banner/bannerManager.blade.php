@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
				{{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
					'title' => 'Manajemen Banner',
					'parent_page' => 'Manajemen Web',
					'parent_link' => '/staf/manajemen-web/dashboard',
					'current_page' => 'Banner'
					])

				{{-- content --}}
				<div class="mt-3 container">
					@if (session()->has('success'))
						<div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif

					<a href="/staf/manajemen-web/banner/new-banner" style="width: auto" class="btn btn-primary my-2">
						<i class="bx bx-plus align-middle"></i> Tambah Halaman Banner Baru
					</a>

					<div class="form-helper text-muted fst-italic">
						*Jumlah halaman banner yang direkomendasikan adalah 3
					</div>

					<table class="table table-hover">
						<thead>
							<tr class="bg-dark text-light text-center align-middle">
								<th>No Urut</th>
								<th>Aksi</th>
								<th>Judul</th>
								<th>Deskripsi</th>
								<th>Gambar</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($banner as $key => $item)
								<tr class="text-center align-middle">
									<td>{{ $item->no_urut }}</td>
									<td>
										<div style="display: flex; gap: 5px; justify-content: center;">
											<a href="/staf/manajemen-web/banner/edit-banner/{{ $item->no_urut }}">
												<button class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit banner">
													<i class="bx bx-edit-alt text-light"></i>
												</button>
											</a>

											@if ($item->no_urut !== 1)
												<form action="/staf/manajemen-web/banner/{{ $item->id }}"
													onsubmit="return confirm('Apakah anda yakin ingin menghapus banner no_urut {{ $item->no_urut }}? Banner yang dihapus tidak akan bisa dikembalikan!')"
													method="POST">
													
													@method('delete')
													@csrf

													<button class="btn btn-sm btn-danger" type="submit" data-bs-toggle="tooltip"title="Hapus artikel">
														<i class="bx bx-trash text-light"></i>
													</button>
												</form>
											@endif
										</div>
									</td>
									<td class="fw-bold">{{ $item->judul }}</td>
									<td>{{ $item->deskripsi }}</td>
									<td>
										<img src="{{ asset('storage/'.$item->image->path) }}" style="max-height: 150px; max-width: 300px">
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')

@endsection