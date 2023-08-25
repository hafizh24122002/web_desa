@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="container">
				{{-- menu yang di atas --}}
				@include('partials.adminTopMenu', [
					'title' => 'Kesehatan Ibu dan Anak (KIA)',
					'parent_page' => 'Kesehatan',
					'parent_link' => '/staf/kesehatan',
					'current_page' => 'KIA',
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
							<input type="text" name="search" id="searchInput" class="form-control me-2" placeholder="Cari berdasarkan nama Ibu atau Anak" value="{{ $search }}">
							<button type="submit" class="btn btn-primary">Cari</button>
						</form>
					</div>
	
					<a href="/staf/kesehatan/kia/new-kia" style="width: auto" class="btn btn-primary my-2">
						<i class="bx bx-plus align-middle"></i> Tambah Data KIA Baru
					</a>
	
					<table class="table table-hover">
						<thead>
							<tr class="bg-dark text-light text-center align-middle">
								<th>No</th>
								<th>Aksi</th>
								<th class="sortable" data-field="no_kia" data-order="{{ $sortField === 'no_kia' ? $sortOrder : 'asc' }}">
									No KIA
									<i class="ms-2 fas {{ $sortField === 'no_kia' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
								<th class="sortable" data-field="nama_ibu" data-order="{{ $sortField === 'nama_ibu' ? $sortOrder : 'asc' }}">
									Nama Ibu
									<i class="ms-2 fas {{ $sortField === 'nama_ibu' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
								<th class="sortable" data-field="nama_anak" data-order="{{ $sortField === 'nama_anak' ? $sortOrder : 'asc' }}">
									Nama Anak
									<i class="ms-2 fas {{ $sortField === 'nama_anak' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
								<th class="sortable" data-field="perkiraan_lahir" data-order="{{ $sortField === 'perkiraan_lahir' ? $sortOrder : 'asc' }}">
									Perkiraan Kelahiran
									<i class="ms-2 fas {{ $sortField === 'perkiraan_lahir' ? ($sortOrder === 'asc' ? 'fa-caret-up' : 'fa-caret-down') : '' }}"></i>
								</th>
							</tr>
						</thead>
	
						<tbody>
							@include('partials.kiaTable')
						</tbody>
					</table>

					<div class="d-flex justify-content-end">
						{{ $kia->links() }}
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

                fetch(`/staf/kesehatan/kia?search={{ $search }}&sort_field=${sortField}&sort_order=${sortOrder}`, {
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