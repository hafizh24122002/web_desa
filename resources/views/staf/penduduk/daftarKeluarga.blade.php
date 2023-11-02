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
					<h1>Data Penduduk dalam Keluarga</h1>

					<a href="#\" style="width: auto" class="btn btn-primary my-2">
						<i class="bx bx-user-plus align-middle"></i> Tambah Anggota Keluarga Baru
					</a>
					<div class="row mt-3 container">
						@if (session()->has('success'))
						<div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						@endif

						<table class="table table-hover">
							<thead>
								<tr class="bg-dark text-light text-center align-middle">
									<th>No</th>
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