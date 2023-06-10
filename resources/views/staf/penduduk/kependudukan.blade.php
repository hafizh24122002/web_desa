@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="container">
				{{-- menu yang di atas --}}
				@include('partials.adminTopMenu', [
					'title' => 'Data Penduduk',
					'parent_page' => 'Kependudukan',
					'parent_link' => '/staf/kependudukan/penduduk',
					'current_page' => 'Penduduk',
				])
	
				{{-- content --}}
				<div class="row mt-3 container">
					@if (session()->has('success'))
						<div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
	
					<a href="/staf/kependudukan/penduduk/new-penduduk" style="width: auto" class="btn btn-primary my-2">
						<i class="bx bx-user-plus align-middle"></i> Tambah Data Penduduk Baru
					</a>
	
					<table class="table table-hover">
						<thead>
							<tr class="bg-dark text-light text-center align-middle">
								<th>No</th>
								<th>Aksi</th>
								<th>NIK</th>
								<th>Nama</th>
								<th>Jenis Kelamin</th>
								<th>Telepon</th>
								<th>Penduduk Tetap</th>
							</tr>
						</thead>
	
						<tbody>
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
	
									<td>
										@if ($data->nama)
											{{ $data->nama }}	
										@else
											{{ "-" }}
										@endif
									</td>
	
									<td>
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
								</tr>
							@endforeach
						</tbody>
					</table>

					{{ $penduduk->links() }}
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')

@endsection