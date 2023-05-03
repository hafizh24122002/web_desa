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

					<table class="table table-hover">
						<thead>
							<tr class="bg-dark text-light text-center align-middle">
								<th>No.</th>
								<th>Aksi</th>
								<th>Kode Surat</th>
								<th>No. Surat</th>
								<th>Dibuat Oleh</th>
								<th>Keterangan</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($arsip as $key => $item)
								<tr class="text align-middle text-center">
									<td>{{ $arsip->firstItem() + $key }}</td>
	
									<td class="d-flex gap-1 justify-content-center">
										<a href="/staf/layanan-surat/arsip-surat/lihat-surat/{{ $item->filename }}" target="_blank">
											<button class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Lihat Dokumen">
												<i class="bx bx-show-alt text-light" style="vertical-align: middle;"></i>
											</button>
										</a>

										<a href="">
											<button class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Unduh Dokumen">
												<i class="bx bxs-download text-light" style="vertical-align: middle;"></i>
											</button>
										</a>

										<form action=""
											onsubmit=""
											method="POST">
											
											@method('delete')
											@csrf
	
											<button class="btn btn-sm btn-danger" type="submit" data-bs-toggle="tooltip" title="Hapus Dokumen">
												<i class="bx bx-trash text-light" style="vertical-align: middle;"></i>
											</button>
										</form>
									</td>

									<td>{{ $item->kode_surat }}</td>

									<td>{{ $item->no_surat }}</td>

									<td>{{ $item->nama }}</td>

									<td>{{ $item->keterangan }}</td>
								</tr>
							@endforeach
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

@endsection