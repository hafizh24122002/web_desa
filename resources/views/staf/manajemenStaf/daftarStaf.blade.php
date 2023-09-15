@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="container">
				{{-- menu yang di atas --}}
				@include('partials.adminTopMenu', [
					'title' => 'Daftar Staf',
					'parent_page' => 'Manajemen Staf',
					'parent_link' => '/staf/manajemen-staf/',
					'current_page' => 'Daftar Staf',
				])
	
				{{-- content --}}
				<div class="row mt-3 container">
					@if (session()->has('success'))
						<div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
	
					<a href="/staf/manajemen-staf/new-staf" style="width: auto" class="btn btn-primary my-2">
						<i class="bx bx-user-plus align-middle"></i> Tambah Data Staf Baru
					</a>
	
					<table class="table table-hover">
						<thead>
							<tr class="bg-dark text-light text-center align-middle">
								<th>No</th>
								<th>Aksi</th>
								<th>NIP</th>
								<th>Nama</th>
								<th>Jabatan</th>
								<th>Status User</th>
							</tr>
						</thead>
	
						<tbody>
							@foreach ($staf as $key => $data)
								<tr class="text-center align-middle">
									<td>{{ $staf->firstitem() + $key }}</td>
	
									<td>
										<div style="display: flex; gap: 5px; justify-content: center;">
											<a href="/staf/manajemen-staf/edit-staf/{{ $data->id }}">
												<button class="btn btn-sm btn-warning">
													<i class="bx bx-edit-alt text-light"></i>
												</button>
											</a>
		
											<form action="/staf/manajemen-staf/{{ $data->id }}"
												onsubmit="return confirm('Apakah anda yakin ingin menghapus staf dengan nama {{ $data->nama }}? Staf yang dihapus tidak akan bisa dikembalikan!')"
												method="POST">
												
												@method('delete')
												@csrf
		
												<button class="btn btn-sm btn-danger" type="submit">
													<i class="bx bx-trash text-light"></i>
												</button>
											</form>
										</div>
									</td>
	
									<td>
										@if ($data->nip)
											{{ $data->nip }}	
										@else
											{{ "-" }}
										@endif
									</td>
	
									<td>
										@if ($data->nama)
											{{ $data->nama }}	
										@else
											{{ "-" }}
										@endif
									</td>
	
									<td>
										@if ($data->jabatan)
											{{ $data->jabatan }}
										@else
											{{ "-" }}
										@endif
									</td>
	
									<td>
										@php $exist = false; @endphp
										@foreach ($user as $data_user)
											@if ($data->id === $data_user->id_staf)
												@php $exist = true; @endphp
											@endif
										@endforeach

										@if ($exist)
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
						{{ $staf->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')

@endsection