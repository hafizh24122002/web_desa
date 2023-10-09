@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="container">
				{{-- menu yang di atas --}}
				@include('partials.adminTopMenu', [
					'title' => 'Data Keluarga',
					'parent_page' => 'Kependudukan',
					'parent_link' => '/staf/kependudukan/penduduk',
					'current_page' => 'keluarga',
				])
	
				{{-- content --}}
				<div class="row mt-3 container">
					@if (session()->has('success'))
						<div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
	
					<a href="/staf/kependudukan/keluarga/new-keluarga" style="width: auto" class="btn btn-primary my-2">
						<i class="bx bx-user-plus align-middle"></i> Tambah Data Keluarga Baru
					</a>
	
					<table class="table table-hover">
						<thead>
							<tr class="bg-dark text-light text-center align-middle">
								<th>No</th>
								<th>Aksi</th>
								<th>No KK</th>
								<th>Kepala Keluarga</th>
								<th>NIK</th>
								<th>Jumlah Anggota</th>
								<th>Alamat</th>
								<th>Tanggal Daftar</th>
								<th>Tanggal Cetak</th>
							</tr>
						</thead>
	
						<tbody>
							@foreach ($keluarga as $key => $data)
								<tr class="text-center align-middle">
									<td>{{ $keluarga->firstitem() + $key }}</td>
	
									<td>
										<div style="display: flex; gap: 5px; justify-content: center;">
											<a href="/staf/kependudukan/keluarga/anggota/{{ $data->no_kk }}">
												<button class="btn btn-sm btn-primary">
													<i class="bx bx-list-ul text-light"></i>
												</button>
											</a>
											
											<a href="/staf/kependudukan/keluarga/edit-keluarga/{{ $data->no_kk }}">
												<button class="btn btn-sm btn-warning">
													<i class="bx bx-edit-alt text-light"></i>
												</button>
											</a>
		
											<form action="/staf/kependudukan/keluarga/{{ $data->no_kk }}"
												onsubmit="return confirm('Apakah anda yakin ingin menghapus keluarga dengan No. KK {{ $data->no_kk }}? Keluarga yang dihapus tidak akan bisa dikembalikan!')"
												method="POST">
												
												@method('delete')
												@csrf
		
												<button class="btn btn-sm btn-danger" type="submit">
													<i class="bx bx-trash text-light"></i>
												</button>
											</form>
										</div>
									</td>
	
									<td>{{ $data->no_kk }}</td>

									<td>
										@if ($data->kepala_keluarga)
											{{ $data->kepala_keluarga }}	
										@else
											{{ "-" }}
										@endif
									</td>
	
									<td>
										@if ($data->nik_kepala)
											{{ $data->nik_kepala }}	
										@else
											{{ "-" }}
										@endif
									</td>

									<td>
										@if ($data->jumlah_anggota)
											{{ $data->jumlah_anggota }}	
										@else
											{{ "-" }}
										@endif
									</td>
	
									<td>
										@if ($data->alamat)
											{{ $data->alamat }}
										@else
											{{ "-" }}
										@endif
									</td>
	
									<td>
										@if ($data->tgl_daftar)
											{{ $data->tgl_daftar }}
										@else
											{{ "-" }}
										@endif
									</td>

									<td>
										@if ($data->tgl_cetak_kk)
											{{ $data->tgl_cetak_kk }}
										@else
											{{ "-" }}
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					<div class="d-flex justify-content-end">
						{{ $keluarga->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')

@endsection