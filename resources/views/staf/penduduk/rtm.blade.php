@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="container">
				{{-- menu yang di atas --}}
				@include('partials.adminTopMenu', [
					'title' => 'Rumah Tangga',
					'parent_page' => 'rtm',
					'parent_link' => '/staf/kependudukan/rtm',
					'current_page' => 'Rumah Tangga',
				])
	
				{{-- content --}}
				<div class="row mt-3 container">
					@if (session()->has('success'))
						<div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
	
					<a href="/staf/kependudukan/rtm/new-rtm" style="width: auto" class="btn btn-primary my-2">
						<i class="bx bx-user-plus align-middle"></i> Tambah Data Rumah Tangga Baru
					</a>
	
					<table class="table table-hover">
						<thead>
							<tr class="bg-dark text-light text-center align-middle">
								<th>No</th>
								<th>Aksi</th>
								<th>No Rumah Tangga</th>
								<th>Kepala Rumah Tangga</th>
								<th>NIK</th>
								<th>DTKS</th>
								<th>Jumlah Anggota</th>
								<th>Alamat</th>
								<th>Tanggal Daftar</th>
							</tr>
						</thead>
	
						<tbody>
							@include('partials.rtmTable')
						</tbody>
					</table>

					<div class="d-flex justify-content-end">
						{{ $rtm->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')

@endsection