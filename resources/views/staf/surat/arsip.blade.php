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
				<div class="row mt-3 justify-content-between container">
					@if (session()->has('success'))
						<div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif

					<div class="col-auto mb-3">
						<a href="/staf/layanan-surat/buat-surat" class="btn btn-social btn-primary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block me-2">
							<i class="bx bx-plus"></i>&nbsp; Buat Surat Baru
						</a>

						<button id="download" class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
							<i class="fa fa-download"></i>&nbsp; Unduh Arsip Surat
						</button>
					</div>

					<div class="col-auto d-flex mb-3">
						<a href="/staf/layanan-surat/arsip-surat" class="me-2 btn btn-secondary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
							<i class="fa fa-refresh"></i>&nbsp; Reset
						</a>

						<select name="year" id="year" class="form-select form-select-sm" style="width: 7rem">
							<option value="" selected>-- Tahun --</option>
							@for ($year = $earliestYear; $year <= \Carbon\Carbon::now()->year; $year++)
								<option value="{{ $year }}">
									{{ $year }}
								</option>
							@endfor
						</select>
					</div>

					<div class="mb-3">
						<form id="searchForm" class="d-flex">
							<input type="search" name="search" id="searchInput" class="form-control me-2" placeholder="Cari berdasarkan nama pembuat surat atau keterangan" value="{{ $search }}">
							<button type="submit" class="btn btn-primary">Cari</button>
						</form>
					</div>

					<div class="table-responsive table-min-height">
						<table class="table table-hover">
							<thead>
								<tr class="bg-dark text-light text-center align-middle text-nowrap">
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
					</div>

					<div class="d-flex justify-content-end">
						{{ $arsip->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		const tableBody = document.querySelector('tbody');
		const downloadBtn = document.getElementById('download');
		const columnHeaderCells = document.querySelectorAll('.sortable');
		const yearElem = document.getElementById('year');

		let sortField = '';
		let recentSortOrder = 'asc';

		yearElem.addEventListener('change', function () {
			const year = yearElem.value;

			fetchData('', recentSortOrder, year);
		});

		downloadBtn.addEventListener('click', function () {
			axios.get(`/staf/layanan-surat/arsip-surat/download`, {
				params: {
					search: '{{ $search }}',
					sort_field: sortField,
					sort_order: recentSortOrder,
					year: yearElem.value
				},
				responseType: 'blob',
				headers: {
					"X-Requested-With": "XMLHttpRequest",
				}
			})
			.then(response => {
				// Create a Blob from the response data
				const blob = new Blob([response.data], { type: response.headers['content-type'] });

				// Create a download link
				const downloadLink = document.createElement('a');
				downloadLink.href = window.URL.createObjectURL(blob);
				downloadLink.download = 'arsip_surat.xlsx';

				// Append the link to the document and trigger a click
				document.body.appendChild(downloadLink);
				downloadLink.click();

				// Remove the link from the document
				document.body.removeChild(downloadLink);
			})
			.catch(error => console.error('Error:', error));
		});

		columnHeaderCells.forEach(columnHeader => {
			columnHeader.addEventListener('click', function () {
				sortField = this.dataset.field;
				sortOrder = 'asc';
				const year = yearElem.value;

				if (sortField === this.dataset.field) {
					recentSortOrder = this.dataset.order === 'asc' ? 'desc' : 'asc';
				}

				fetchData(sortField, recentSortOrder, year);
			});
		});

		function fetchData(sortField, sortOrder, year) {
			const params = {
				search: '{{ $search }}',
				sort_field: sortField,
				sort_order: sortOrder,
				year: year,
			};

			axios.get(`/staf/layanan-surat/arsip-surat`, {
				params: params,
				headers: {
					"X-Requested-With": "XMLHttpRequest",
				},
			})
			.then(response => {
				tableBody.innerHTML = response.data;

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
		}
	});
</script>

@endsection