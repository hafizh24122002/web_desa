@extends('layouts/userFormMain')

@section('form')
<div class="mt-3 container">
	<a href="/staf/manajemen-web/banner"
		class="btn btn-info btn-sm mb-4">

		<i class="fa fa-arrow-left"></i> Kembali ke Manajemen Banner
	</a>

	<div class="col-lg">
		<form action="/staf/manajemen-web/banner/new-banner" method="POST" autocomplete="off" id="form" enctype="multipart/form-data">
			@csrf
			<div class="form-group row">
				<label for="no_urut" class="col-sm-2 col-form-label">No. Urut<span style="color:red">*</span></label>
				<div class="col-sm-10">
					<input type="number"
						class="form-control form-control-sm  @error('no_urut') is-invalid @enderror"
						id="no_urut"
						name="no_urut"
						placeholder="Nomor Urut Banner"
						value="{{ old('no_urut') ?? $no_urut_terakhir }}">

					@error('no_urut')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="judul" class="col-sm-2 col-form-label">Judul<span style="color:red">*</span></label>
				<div class="col-sm-10">
					<input type="text"
						class="form-control form-control-sm  @error('judul') is-invalid @enderror"
						id="judul"
						name="judul"
						placeholder="Judul Banner (maksimum 50 karakter)"
						maxlength="50"
						value="{{ old('judul') }}">

					@error('judul')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi<span style="color:red">*</span></label>
				<div class="col-sm-10">
					<input type="text"
						class="form-control form-control-sm  @error('deskripsi') is-invalid @enderror"
						id="deskripsi"
						name="deskripsi"
						placeholder="Deskripsi Banner (maksimum 80 karakter)"
						maxlength="80"
						value="{{ old('deskripsi') }}">

					@error('deskripsi')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="id_image" class="col-sm-2 col-form-label">Gambar<span style="color:red">*</span></label>
				<div class="col-sm-10">
					<input type="file"
						class="form-control form-control-sm  @error('id_image') is-invalid @enderror"
						id="id_image"
						name="id_image"
						onchange="loadFile(event, 'image')"
						accept="image/*"
						aria-label="Upload">

					<div class="form-helper text-muted fst-italic" style="font-size: small">
						*Disarankan menggunakan gambar landscape agar gambar dapat ditampilkan dengan baik
					</div>

					@error('id_image')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror

					<img id="image"
						class="my-2"
						style="max-width: 50%; max-height: 400px"/>
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Tambah Halaman Banner Baru</button>
			</div>
		</form>
	</div>
</div>

<script>
	var loadFile = function(event, id) {
		var output = document.getElementById(id);
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};
</script>

@endsection