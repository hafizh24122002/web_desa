@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="container">
				{{-- menu yang di atas --}}
				@include('partials.adminTopMenu', [
					'title' => 'Daftar Posyandu',
					'parent_page' => 'Kesehatan',
					'parent_link' => '/staf/kesehatan',
					'current_page' => 'posyandu',
				])
	
				{{-- content --}}
				<div class="row mt-3 container">
					@if (session()->has('success'))
						<div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
	
					<a href="/staf/kesehatan/posyandu/new-posyandu" style="width: auto" class="btn btn-primary my-2">
						<i class="bx bx-plus align-middle"></i> Tambah Data Posyandu Baru
					</a>
	
					<table class="table table-hover">
						<thead>
							<tr class="bg-dark text-light text-center align-middle">
								<th>No</th>
								<th>Aksi</th>
								<th>Nama Posyandu</th>
								<th>Alamat</th>
							</tr>
						</thead>
	
						<tbody>
							@foreach ($posyandu as $key => $data)
								<tr class="align-middle">
									<td class="text-center">{{ $posyandu->firstitem() + $key }}</td>
	
									<td class="d-flex gap-1 justify-content-center">
										<a href="/staf/kesehatan/posyandu/edit-posyandu/{{ $data->id }}">
											<button class="btn btn-sm btn-warning">
												<i class="bx bx-edit-alt text-light"></i>
											</button>
										</a>
	
										<form action="/staf/kesehatan/posyandu/{{ $data->id }}"
											onsubmit="return confirm('Apakah anda yakin ingin menghapus posyandu ini? Posyandu yang dihapus tidak akan bisa dikembalikan!')"
											method="POST">
											
											@method('delete')
											@csrf
	
											<button class="btn btn-sm btn-danger" type="submit">
												<i class="bx bx-trash text-light"></i>
											</button>
										</form>
									</td>
	
									<td>{{ $data->nama }}</td>
	
									<td>
										@if ($data->alamat)
											{{ $data->alamat }}	
										@else
											{{ "-" }}
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					<div class="d-flex justify-content-end">
						{{ $posyandu->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')

@endsection