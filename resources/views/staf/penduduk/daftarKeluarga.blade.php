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

					<a href="#" style="width: auto" class="btn btn-primary my-2">
						<i class="bx bx-user-plus align-middle"></i> Tambah Anggota Keluarga Baru
					</a>

					@foreach ($pendudukDalamKeluarga as $penduduk)
					<div class="card mb-3">
						<div class="card-body">
							<h5 class="card-title">{{ $penduduk->nama }}</h5>
							<p class="card-text">ID Helper Penduduk Keluarga:
								{{ $penduduk->id_helper_penduduk_keluarga }}
							</p>
							<p class="card-text">ID Hubungan KK: {{ $penduduk->id_hubungan_kk }}</p>
							<!-- Add other fields you want to display -->
						</div>
					</div>
					@endforeach

					{{ $pendudukDalamKeluarga->links() }}
				</div>

				{{-- content --}}
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
								<th>Aksi</th>
								<th>NIK</th>
								<th>Nama</th>
								<th>Tanggal Lahir</th>
								<th>Jenis Kelamin</th>
								<th>Hubungan</th>
							</tr>
						</thead>

						<tbody>
							<tr class="text-center align-middle">
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')
@endsection