@extends('layouts/adminMain')

@section('main-content')
    <section class="wrapper">
        <div class="container-fostrap">
            <div class="content">
                <div class="container">
                    {{-- menu yang di atas --}}
                    @include('partials.adminTopMenu', [
                        'title' => 'Daftar Anggota Rumah Tangga',
                        'parent_page' => 'Kependudukan',
                        'parent_link' => '/staf/kependudukan/penduduk',
                        'current_page' => 'Rumah Tangga',
                    ])

                    <div class="container">
						<a href="#" style="width: auto" class="btn btn-primary my-2">
							<i class="bx bx-user-plus align-middle"></i> Tambah Anggota Rumah Tangga Baru
						</a>

						<a href="#" style="width: auto" class="btn btn-danger my-2">
							<i class="bx bx-user-plus align-middle"></i> Hapus Data Terpilih
						</a>

						<a href="#" style="width: auto" class="btn btn-info my-2">
							<i class="bx bx-user-plus align-middle"></i> Kembali ke Daftar Rumah Tangga
						</a>
						<br>
						<br>
						<h6>Rincian Keluarga</h6>

						@foreach ($pendudukDalamRtm as $penduduk)
                            <div class="card mb-3">
                                <div class="card-body">
									<table class="table table-sm table-hover">
										<tr>
											<td>Nomor Rumah Tangga (RT)</td>
											<td>:</td>
											<td>{{ $penduduk->no_rtm}}</td>
										</tr>
										<tr>
											<td>Kepala Rumah Tangga</td>
											<td>:</td>
											<td>{{ $penduduk->nama }}</td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td>:</td>
											<td>{{ $penduduk->alamat_sekarang }}</td>
										</tr>
										<tr>
											<td>BDT</td>
											<td>:</td>
											<td>{{ $penduduk->bdt}}</td>
										</tr>
										<tr>
											<td>Program Bantuan</td>
											<td>:</td>
											<td>{{ $penduduk->dtks}}</td>
										</tr>
									</table>
                                </div>
                            </div>
                        @endforeach
						
						<div class="card mb-3">
							<h6>Daftar Anggota</h6>
						</div>
						

                        {{ $pendudukDalamRtm->links() }}
                    </div>

                    {{-- content --}}
                    {{-- <div class="row mt-3 container">
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
								<th>No KK</th>
								<th>NIK Kepala Keluarga</th>
								<th>Kelas Sosial</th>
								<th>Alamat</th>
								<th>Tanggal Dikeluarkan</th>
							</tr>
						</thead>
	
						<tbody>
							@foreach ($rtm as $key => $data)
								<tr class="text-center align-middle">
									<td>{{ $rtm->firstitem() + $key }}</td>
	
									<td>
										<div style="display: flex; gap: 5px; justify-content: center;">
											<a href="#">
												<button class="btn btn-sm btn-primary">
													<i class="bx bx-list-ul text-light"></i>
												</button>
											</a>
											
											<a href="/staf/kependudukan/keluarga/edit-rtm/{{ $data->no_kk }}">
												<button class="btn btn-sm btn-warning">
													<i class="bx bx-edit-alt text-light"></i>
												</button>
											</a>
		
											<form action="/staf/kependudukan/rtm/{{ $data->no_kk }}"
												onsubmit="return confirm('Apakah anda yakin ingin menghapus keluarga dengan No. KK {{ $data->no_kk }}? Keluarga yang dihapus tidak akan bisa dikembalikan!')"
												method="POST">
												
												@method('delete')
												@csrf
		
												<button class="btn btn-sm btn-danger" type="submit">
													<i class="bx bx-trash text-light"></i>
												</button>
											</form>
										</div>
									</td>
	
									<td>{{ $data->no_kk }}</td>
	
									<td>
										@if ($data->nik_kepala)
											{{ $data->nik_kepala }}	
										@else
											{{ "-" }}
										@endif
									</td>
	
									<td>
										@if ($data->nama)
											{{ $data->nama }}
										@else
											{{ "-" }}
										@endif
									</td>
	
									<td>
										@if ($data->alamat)
											{{ $data->alamat }}
										@else
											{{ "-" }}
										@endif
									</td>
	
									<td>
										@if ($data->tgl_dikeluarkan)
											{{ $data->tgl_dikeluarkan }}
										@else
											{{ "-" }}
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					<div class="d-flex justify-content-end">
						{{ $keluarga->links() }}
					</div>
				</div> --}}
                </div>
            </div>
        </div>
    </section>

    @include('partials.commonScripts')
@endsection
