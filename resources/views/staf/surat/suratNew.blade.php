@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
				{{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
					'title' => 'Buat Surat Baru',
					'parent_page' => 'Layanan Surat',
					'parent_link' => '/staf/layanan-surat/arsip-surat',
					'current_page' => 'Buat Surat'
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
								<th style="width: 9rem">Aksi</th>
								<th>Jenis Surat</th>
								<th>Kode Surat</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($surat as $key => $item)
								<tr class="text align-middle">
									<td class="d-flex gap-1 justify-content-center">
										<a href="/staf/layanan-surat/buat-surat/{{ $item->nama }}">
											<button class="btn btn-sm btn-primary text-light" data-bs-toggle="tooltip" title="Buat Surat Baru">
												Buat Surat
											</button>
										</a>
									</td>

									<td class="">{{ $item->nama }}</td>

									<td>{{ $item->kode_surat }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					<div class="d-flex justify-content-end">
						{{ $surat->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')

@endsection