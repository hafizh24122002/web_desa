@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
				{{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
					'title' => 'Manajemen Pengguna',
					'current_page' => 'Pengguna',
					])

				{{-- content --}}
				<div class="row mt-3">
					<table class="table table-hover">
						<thead>
							<tr class="bg-dark text-light text-center">
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
								<tr class="text-center">
									<td>{{ $loop->iteration }}</td>
									<td> - </td>		{{-- TODO --}}
									<td>{{ $user->username }}</td>
									<td>{{ $user->name }}</td>
									<td> - </td>		{{-- TODO --}}
									<td> - </td>		{{-- TODO --}}
									<td>{{ $user->last_login }}</td>
									<td> - </td>		{{-- TODO --}}
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection