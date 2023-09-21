@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="container">
				{{-- menu yang di atas --}}
				@include('partials.adminTopMenu', [
					'title' => 'Pengelompokan Rumah Tangga',
					'parent_page' => 'Kependudukan',
					'parent_link' => '/staf/kependudukan/rumah-tangga',
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

					<div class="mb-3">
						<form id="searchForm" class="d-flex">
							<input type="text" name="search" id="searchInput" class="form-control me-2" placeholder="Cari berdasarkan NIK atau Nama" value="{{ $search }}">
							<button type="submit" class="btn btn-primary">Cari</button>
						</form>
					</div>
	
					<a href="/staf/kependudukan/rumah-tangga/new-rt" style="width: auto" class="btn btn-primary my-2">
						<i class="bx bx-user-plus align-middle"></i> Tambah Data Rumah Tangga Baru
					</a>

					<table class="table table-hover">
						<thead>
							<tr class="bg-dark text-light text-center align-middle">
								<th>No</th>
								<th>Aksi</th>
								<th class="sortable" data-field="nik" data-order="{{ $sortField === 'nik' ? $sortOrder : 'asc' }}">
									NOMOR RUMAH TANGGA
									<i class="ms-2 fas {{ $sortField === 'nik' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
								<th class="sortable" data-field="nama" data-order="{{ $sortField === 'nama' ? $sortOrder : 'asc' }}">
									KEPALA RUMAH TANGGA
									<i class="ms-2 fas {{ $sortField === 'nama' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
								<th class="sortable" data-field="jenis_kelamin" data-order="{{ $sortField === 'jenis_kelamin' ? $sortOrder : 'asc' }}">
									NIK
									<i class="ms-2 fas {{ $sortField === 'jenis_kelamin' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
								<th class="sortable" data-field="telepon" data-order="{{ $sortField === 'telepon' ? $sortOrder : 'asc' }}">
									DTKS
									<i class="ms-2 fas {{ $sortField === 'telepon' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
								<th class="sortable" data-field="penduduk_tetap" data-order="{{ $sortField === 'penduduk_tetap' ? $sortOrder : 'asc' }}">
									JUMLAH ANGGOTA
									<i class="ms-2 fas {{ $sortField === 'penduduk_tetap' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
								<th class="sortable" data-field="penduduk_tetap" data-order="{{ $sortField === 'penduduk_tetap' ? $sortOrder : 'asc' }}">
									ALAMAT
									<i class="ms-2 fas {{ $sortField === 'penduduk_tetap' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
								<th class="sortable" data-field="penduduk_tetap" data-order="{{ $sortField === 'penduduk_tetap' ? $sortOrder : 'asc' }}">
									TANGGAL TERDAFTAR
									<i class="ms-2 fas {{ $sortField === 'penduduk_tetap' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
							</tr>
						</thead>						

						</tbody>
							@include('partials.rtTable')
						</tbody>
					</table>

					<div class="d-flex justify-content-end">
						{{ $penduduk->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tableBody = document.querySelector('tbody');
        const columnHeaderCells = document.querySelectorAll('.sortable');

        columnHeaderCells.forEach(columnHeader => {
            columnHeader.addEventListener('click', function () {
                const sortField = this.dataset.field;
                let sortOrder = 'asc';

                if (sortField === this.dataset.field) {
                    sortOrder = this.dataset.order === 'asc' ? 'desc' : 'asc';
                }

                fetch(`/staf/kependudukan/penduduk?search={{ $search }}&sort_field=${sortField}&sort_order=${sortOrder}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(data => {
                    tableBody.innerHTML = data;

                    // Update sorting indicators and icons
                    columnHeaderCells.forEach(header => {
                        if (header.dataset.field === sortField) {
                            header.dataset.order = sortOrder;
                            const icon = header.querySelector('i');
                            icon.classList.remove('fa-caret-up', 'fa-caret-down');
                            icon.classList.add(sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down');
                        } else {
                            header.dataset.order = '';
                            header.querySelector('i').classList.remove('fa-caret-up', 'fa-caret-down');
                        }
                    });
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>


@endsection