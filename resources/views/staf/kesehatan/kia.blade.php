@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="container">
				{{-- menu yang di atas --}}
				@include('partials.adminTopMenu', [
					'title' => 'Kesehatan Ibu dan Anak (KIA)',
					'parent_page' => 'Kesehatan',
					'parent_link' => '/staf/kesehatan',
					'current_page' => 'KIA',
				])
	
				{{-- content --}}
				<div class="row mt-3 container">
					@if (session()->has('success'))
						<div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
	
					<a href="/staf/kesehatan/kia/new-kia" style="width: auto" class="btn btn-primary my-2">
						<i class="bx bx-plus align-middle"></i> Tambah Data KIA Baru
					</a>
	
					<table class="table table-hover">
						<thead>
							<tr class="bg-dark text-light text-center align-middle">
								<th>No</th>
								<th>Aksi</th>
								<th>No KIA</th>
								<th>Nama Ibu</th>
								<th>Nama Anak</th>
								<th>Perkiraan Kelahiran</th>
							</tr>
						</thead>
	
						<tbody>
							@foreach ($kia as $key => $data)
								<tr class="align-middle">
									<td class="text-center">{{ $kia->firstitem() + $key }}</td>
	
									<td class="d-flex gap-1 justify-content-center">
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
									</td>
	
									<td>{{ $data->no_kia }}</td>
	
									<td>
										{{ $data->ibu->nama ?? '-' }}	
									</td>

									<td>
										{{ $data->anak->nama ?? '-' }}
									</td>

									<td>
										{{ $data->perkiraan_lahir ? $data->perkiraan_lahir->translatedFormat('jS F Y') : '-' }}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					<div class="d-flex justify-content-end">
						{{ $kia->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')

@endsection