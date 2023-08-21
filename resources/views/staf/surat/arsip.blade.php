@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
				{{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
					'title' => 'Arsip Surat',
					'parent_page' => 'Layanan Surat',
					'parent_link' => '/staf/layanan-surat/arsip-surat',
					'current_page' => $title,
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
							<input type="text" name="search" id="searchInput" class="form-control me-2" placeholder="Cari berdasarkan nama pembuat surat atau keterangan" value="{{ $search }}">
							<button type="submit" class="btn btn-primary">Cari</button>
						</form>
					</div>

					<table class="table table-hover">
						<thead>
							<tr class="bg-dark text-light text-center align-middle">
								<th>No.</th>
								<th>Aksi</th>
								<th class="sortable" data-field="kode_surat" data-order="{{ $sortField === 'kode_surat' ? $sortOrder : 'asc' }}">
									Kode Surat
									<i class="ms-2 fas {{ $sortField === 'kode_surat' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
								<th class="sortable" data-field="no_surat" data-order="{{ $sortField === 'no_surat' ? $sortOrder : 'asc' }}">
									No. Surat
									<i class="ms-2 fas {{ $sortField === 'no_surat' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
								<th class="sortable" data-field="nama" data-order="{{ $sortField === 'nama' ? $sortOrder : 'asc' }}">
									Dibuat Oleh
									<i class="ms-2 fas {{ $sortField === 'nama' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
								<th class="sortable" data-field="keterangan" data-order="{{ $sortField === 'keterangan' ? $sortOrder : 'asc' }}">
									Keterangan
									<i class="ms-2 fas {{ $sortField === 'keterangan' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
								<th class="sortable" data-field="tanggal_surat" data-order="{{ $sortField === 'tanggal_surat' ? $sortOrder : 'asc' }}">
									Tanggal Surat
									<i class="ms-2 fas {{ $sortField === 'tanggal_surat' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
								<th>Dibuat Pada</th>
							</tr>
						</thead>

						<tbody>
							@include('partials.arsipSuratTable')
						</tbody>
					</table>

					<div class="d-flex justify-content-end">
						{{ $arsip->links() }}
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

				fetch(`/staf/layanan-surat/arsip-surat?search={{ $search }}&sort_field=${sortField}&sort_order=${sortOrder}`, {
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