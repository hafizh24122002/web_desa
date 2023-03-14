@extends('layouts/userFormMain')

@section('form')

<div class="row mt-3 container">
	<div class="col-lg-4">
		<img id="frame" src="" class="img-fluid" />
		<div class="input-group">
			<input type="file" class="form-control form-control-sm" id="formFile" onchange="preview()" aria-label="Upload">
			<button class="btn btn-outline-secondary btn-sm" type="button" id="inputGroupFileAddon04">Upload</button>
		</div>
	</div>

	<div class="col-lg-8">
		<form action="/admin/user-manager/new-user" method="POST">
			@csrf
			<div class="form-group row">
				<label for="username" class="col-sm-2 col-form-label">Username</label>
				<div class="col-sm-10">
					<input type="text" 
						class="form-control form-control-sm @error('username') is-invalid @enderror"
						name="username"
						placeholder="Username" 
						value="{{ old('username') }}"
						required>
					
					@error('username')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="password" class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-10">
					<input type="password"
						class="form-control form-control-sm @error('password') is-invalid @enderror"
						name="password"
						value="{{ old('password') }}"
						placeholder="Kata Sandi"
						required>
					
					@error('password')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="grup" class="col-sm-2 col-form-label">Grup</label>
				<div class="col-sm-10">
					<select class="form-select form-select-sm" id="grup-input" name="id_grup">
						<option value="1">Administrator</option>
						<option value="2">Staf</option>
					</select>
				</div>
			</div>

			<div class="form-group row" id="pamong-input">
				<label for="pamong" class="col-sm-2 col-form-label">Nama Pamong</label>
				<div class="col-sm-10">
					<select class="form-select form-select-sm" name="id_pamong">
						<option value="">TODO</option>    {{-- TODO --}}
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="email" class="col-sm-2 col-form-label">E-mail</label>
				<div class="col-sm-10">
					<input type="text"
						class="form-control form-control-sm @error('email') is-invalid @enderror"
						name="email"
						value="{{ old('email') }}"
						placeholder="Alamat E-mail">
					
					@error('email')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="name" class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-10">
					<input type="text"
						class="form-control form-control-sm"
						name="name"
						placeholder="Nama Lengkap">
				</div>
			</div>

			<div class="form-group row">
				<label for="phone" class="col-sm-2 col-form-label">Telepon</label>
				<div class="col-sm-10">
					<input type="text"
						class="form-control form-control-sm"
						name="phone"
						placeholder="No. Telepon">
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 px-3 py-1">Tambah User</button>
			</div>
		</form>
	</div>
</div>

@endsection