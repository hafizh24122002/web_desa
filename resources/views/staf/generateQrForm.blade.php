@extends('layouts/userFormMain')

@section('form')
<div class="mt-3 container">
	<a href="{{ url()->previous() }}"
		class="btn btn-info btn-sm mb-4">

		<i class="fa fa-arrow-left"></i> Kembali ke Halaman Sebelumnya
	</a>

	<div class="col-lg">
		<form action="/staf/buat-qr" method="POST" autocomplete="off" id="form" enctype="multipart/form-data">
			@csrf
			
			<div class="form-group row">
				<label for="url" class="col-lg-3 col-form-label">URL yang ingin dibuat menjadi kode QR<span style="color:red">*</span></label>
				<div class="col-lg-9">
					<input type="text"
						class="form-control form-control-sm  @error('url') is-invalid @enderror"
						id="url"
						name="url"
						placeholder="URL"
						value="{{ old('url') }}">

					@error('url')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="image" class="col-lg-3 col-form-label">Embed Gambar pada Kode QR</label>
				<div class="col-lg-9">
					<input type="file"
						class="form-control form-control-sm  @error('image') is-invalid @enderror"
						id="image"
						name="image"
						onchange="loadFile(event, 'image_preview')"
						accept="image/png"
						aria-label="Upload">

					<div class="form-helper text-muted fst-italic" style="font-size: small">
						*Format gambar harus berupa PNG, pastikan gambar memiliki aspek rasio 1:1
					</div>

					@error('image')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror

					<img id="image_preview"
						class="my-2"
						style="max-width: 50%; max-height: 200px"/>
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Buat Kode QR</button>
			</div>
		</form>
	</div>
</div>

@include('partials.commonScripts')
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