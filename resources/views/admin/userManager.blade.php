@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
				{{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
					'title' => 'Manajemen Pengguna',
					'current_page' => 'User Manager',
					])

				{{-- content --}}
				<div class="row mt-3 container">
					@if (session()->has('success'))
						<div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif

					<a href="/admin/user-manager/new-user" class="my-2">
						<button class="btn btn-primary">Tambah Pengguna Baru</button>
					</a>

					<table class="table table-hover">
						<thead>
							<tr class="bg-dark text-light text-center align-middle">
								<th>No</th>
								<th>Aksi</th>
								<th>Username</th>
								<th>Nama</th>
								<th>Staf</th>
								<th>Grup</th>
								<th>Login Terakhir</th>
								<th>Tanggal Verifikasi</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($users as $user)
								<tr class="text-center align-middle">
									<td>{{ $loop->iteration }}</td>

									<td class="d-flex gap-1 justify-content-center">
										<a href="/admin/user-manager/edit-user/{{ $user->username }}">
											<button class="btn btn-sm btn-warning">
												<i class="bx bx-edit-alt text-light"></i>
											</button>
										</a>
										
										<form action="/admin/user-manager/{{ $user->username }}"
											onsubmit="return confirm('Apakah anda yakin ingin menghapus pengguna dengan username {{ $user->username }}? Pengguna yang dihapus tidak akan bisa dikembalikan!')"
											method="POST">
											
											@method('delete')
											@csrf

											<button class="btn btn-sm btn-danger" type="submit">
												<i class="bx bx-trash text-light"></i>
											</button>
										</form>
									</td>

									<td>{{ $user->username }}</td>

									<td>
										@if ($user->name === null)
											{{ "-" }}
										@else
											{{ $user->name }}
										@endif
									</td>

									<td>
										@if ($user->id_pamong === null)
											<span class='badge bg-info'>Bukan staf</span>
										@else
											<span class='badge bg-success'>Staf</span>
										@endif
									</td>

									<td>
										@if ($user->id_grup === 1)
											{{ "Administrator" }}
										@else
											{{ "Staf" }}
										@endif
									</td>

									<td>
										@if ($user->last_login === null)
											{{ "-" }}
										@else
											{{ $user->last_login }}
										@endif
									</td>

									<td>
										@if ($user->email_verified_at === null)
											{{ "-" }}
										@else
											{{ $user->name }}
										@endif	
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')

@endsection