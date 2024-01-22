@extends('layouts/adminMain')

@section('main-content')
<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="container">
				{{-- menu yang di atas --}}
				@include('partials.adminTopMenu', [
				'title' => 'Daftar Anggota Keluarga',
				'parent_page' => 'Kependudukan',
				'parent_link' => '/staf/kependudukan/penduduk',
				'current_page' => 'Keluarga',
				])

				<div class="container">

					<a href="/staf/kependudukan/keluarga/daftar-anggota/{{$keluarga->no_kk}}/new-anggota/" style="width: auto" class="btn btn-primary my-2">
						<i class="bx bx-user-plus align-middle"></i> Tambah Anggota Keluarga Baru
					</a>
					<!-- <a href="#" style="width: auto" class="btn btn-info my-2">
						<i class="bi bi-file-text align-middle"></i> Kartu Keluarga
					</a> -->
					<a href="/staf/kependudukan/keluarga/" style="width: auto" class="btn btn-success my-2">
						<i class="bi bi-arrow-left-circle align-middle"></i> Kembali ke Daftar Keluarga
					</a>

					<div class="row mt-3 container">
						@if (session()->has('success'))
						<div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						@endif

						<h5 class="text-center fw-bold"> No. KK: {{ $keluarga->no_kk }}</h5>
						<table class="table table-hover">
							<thead>
								<tr class="bg-dark text-light text-center align-middle">
									<th>No</th>
									<th>Aksi</th>
									<th>NIK</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Hubungan</th>
								</tr>
							</thead>

							<tbody>
								@foreach ($pendudukDalamKeluarga as $penduduk)
								<tr class="text-center align-middle">
									<td>{{ $loop->iteration }}</td>
									<td>
										<div style="display: flex; gap: 5px; justify-content: center;">
											<a href="/staf/kependudukan/penduduk/edit-penduduk/{{ $penduduk->nik }}">
												<button class="btn btn-sm btn-warning" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Edit Data Penduduk">
													<i class="bx bx-edit-alt text-light"></i>
												</button>
											</a>

											<a href="/staf/kependudukan/keluarga/daftar-anggota/edit-hubungan/{{ $penduduk->nik }}">
												<button class="btn btn-sm btn-info" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Ubah Hubungan Keluarga">
													<i class="bi bi-link-45deg" text-light"></i>
												</button>
											</a>

											<form action="/staf/kependudukan/keluarga/daftar-anggota/{{ $penduduk->no_kk }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus {{ $penduduk->nama }} dengan NIK {{ $penduduk->nik }} dari Kartu Keluarga?')" method="POST">

												@method('delete')
												@csrf

												<button class="btn btn-sm btn-danger" type="submit" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Keluarkan dari KK">
													<i class="bi bi-x-lg text-light"></i>
												</button>
											</form>
										</div>
									</td>
									<td>{{ $penduduk->nik }}</td>
									<td>{{ $penduduk->nama }}</td>
									<td>{{ $penduduk->alamat_sekarang }}</td>
									<td>{{ $penduduk->hubunganKK->nama }}</td>

								</tr>
								@endforeach
							</tbody>
						</table>
						{{ $pendudukDalamKeluarga->links() }}
					</div>
				</div>
			</div>
		</div>
</section>

@include('partials.commonScripts')
@endsection