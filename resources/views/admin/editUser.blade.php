@extends('layouts/userFormMain')

@section('form')

<div>
	<form action="/admin/user-manager/edit-user/{{ $user->username }}" class="row mt-3 container" enctype="multipart/form-data" method="POST">
		@method('put')
		@csrf

		<div class="col-lg-4">
			<div class="input-group" style="width: 300px">
				<input type="file" class="form-control form-control-sm @error('photo') is-invalid @enderror" id="photo" name="photo" onchange="preview()" aria-label="Upload">

				@error('photo')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="profile-picture-container mt-2" style="height: 400px; width:300px">
				<img id="frame" src="{{ $user->photo ? asset('storage/'.$user->photo) : '' }}" class="img-fluid" />
			</div>
		</div>

		<div class="col-lg-8">
			<div class="form-group row">
				<label for="username" class="col-sm-3 col-form-label">Username<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text" 
						class="form-control form-control-sm @error('username') is-invalid @enderror"
						name="username"
						placeholder="Username" 
						value="@if(null!==old('username')){{old('username')}}@else{{$user->username}}@endif">
					
					@error('username')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="password" class="col-sm-3 col-form-label">Password<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="password"
						class="form-control form-control-sm @error('password') is-invalid @enderror"
						name="password"
						value="{{ old('password') }}"
						placeholder="Kata Sandi">
					
					@error('password')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="confirm_password" class="col-sm-3 col-form-label">Konfirmasi Password<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="password"
						class="form-control form-control-sm"
						name="password_confirmation"
						id="confirm_password"
						placeholder="Konfirmasi Kata Sandi">
				</div>
			</div>

			<div class="form-group row">
				<label for="grup" class="col-sm-3 col-form-label">Grup<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="id_grup">
						<option value="1" {{ (old('id_grup') ?? $user['id_grup']) == 1 ? 'selected' : '' }}>Administrator</option>
						<option value="2" {{ (old('id_grup') ?? $user['id_grup']) == 2 ? 'selected' : '' }}>Staf</option>
					</select>
				</div>
			</div>

			<div class="form-group row" id="pamong-input">
				<label for="pamong" class="col-sm-3 col-form-label">Nama Staf<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="id_staf" required>
						<option value="">-- Pilih --</option>
						@foreach ($staf as $item)
							<option value="{{ $loop->iteration }}"
								{{ old('id_staf') == $loop->iteration ||
								(old('id_staf') == null && $user['id_staf'] == $item->id) ? 
								'selected' : '' }}>
								{{ $item->jabatan.' - '.$item->nama }}
							</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="email" class="col-sm-3 col-form-label">E-mail</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm @error('email') is-invalid @enderror"
						name="email"
						value="{{ old('email') ?? $user['email'] }}"
						placeholder="Alamat E-mail">
					
					@error('email')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="name" class="col-sm-3 col-form-label">Nama<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="name"
						id="name"
						value="{{ old('name') ?? $user['name'] }}"
						placeholder="Nama Lengkap">
				</div>
			</div>

			<div class="form-group row">
				<label for="phone" class="col-sm-3 col-form-label">Telepon</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="phone"
						value="{{ old('phone') ?? $user['phone'] }}"
						placeholder="No. Telepon">
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 px-3 py-1">Edit Pengguna</button>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		if ($("#id_staf").val() == '') {
			$("#pamong-input").hide();
			$("#id_staf").prop('disabled', true);
		} else {
			$("#name").prop('readonly', true);
		}

		// toggle tampilan input untuk staf
		$("#grup-input").change(function() {
			if ($("#grup-input").val() == "2") {
				$("#pamong-input").slideDown();
				$("#id_staf").prop('disabled', false);
				$("#name").prop('readonly', true);
			} else {
				$("#pamong-input").slideUp();
				$("#id_staf").prop('disabled', true);
				$("#name").prop('readonly', false);
			}
		});

		$("#id_staf").change(function () {
			let selectedOption = $(this).find("option:selected");
			let stafNama = selectedOption.text().split(' - ')[1];
			
			$("#name").val(stafNama);
		});
	});
</script>

<script>
	function preview() {
		frame.src = URL.createObjectURL(event.target.files[0]);
	}
	function clearImage() {
		document.getElementById('formFile').value = null;
		frame.src = "";
	}
</script>

@endsection