@extends('layouts/userFormMain')

@section('form')

<link rel="stylesheet" href="{{ asset('css/letterNameAutoComplete.css') }}">
<link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
<link rel="stylesheet" href="{{ asset('css/quill.imageUploader.min.css') }}">

<div class="mt-3 container">
	<a href="/staf/manajemen-web/artikel"
		class="btn btn-info btn-sm mb-4">

		<i class="fa fa-arrow-left"></i> Kembali ke Manajemen Artikel
	</a>

	<div class="col-lg">
		<form action="/staf/manajemen-web/artikel/new-artikel" method="POST" autocomplete="off" id="form" enctype="multipart/form-data">
			@csrf

			<div class="form-group row">
				<label for="id_cover" class="col-lg-2 col-form-label">Gambar Cover</label>
				<div class="col-lg-10">
					<input type="file"
						class="form-control form-control-sm  @error('id_cover') is-invalid @enderror"
						id="id_cover"
						name="id_cover"
						onchange="loadFile(event, 'image')"
						accept="image/*"
						aria-label="Upload">

					<div class="form-helper text-muted fst-italic" style="font-size: small">
						*Disarankan menggunakan gambar landscape agar gambar dapat ditampilkan dengan baik
					</div>

					@error('id_cover')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror

					<img id="image"
						class="my-2"
						style="max-width: 50%; max-height: 200px"/>
				</div>
			</div>
			
			<div class="form-group row">
				<label for="judul" class="col-lg-2 col-form-label">Judul<span style="color:red">*</span></label>
				<div class="col-lg-10">
					<input type="text"
						class="form-control form-control-sm  @error('judul') is-invalid @enderror"
						id="judul"
						name="judul"
						placeholder="Judul Artikel"
						value="{{ old('judul') }}">

						@error('judul')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="editor" class="col-lg-2 col-form-label">Isi<span style="color:red">*</span></label>
				<div class="col-lg-10">
					<div id="editor"
						name="editor"
						class="@error('isi') is-invalid @enderror"
						style="height: 15rem; margin-bottom: 20px; resize: vertical; overflow: auto;">

						{!! old('content', '') !!}
					</div>

					@error('isi')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
					<div class="error-messages" style="color: red"></div>
				</div>
			</div>

			<div class="form-group row">
				<label for="judul" class="col-lg-2 col-form-label">Status Artikel</label>
				<div class="col-lg-10 d-flex align-items-center gap-2">
					<input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
					<label class="form-check-label" for="flexCheckDefault">
						Aktif
					</label>
				</div>
			</div>

			<input type="hidden" name="isi" id="isi">
			<input type="hidden" name="image[]" id="image">

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Tambah Artikel Baru</button>
			</div>
		</form>
	</div>
</div>

@include('partials.commonScripts')

<script src="{{ asset('js/quill.min.js') }}"></script>

<script>
	var loadFile = function(event, id) {
		var output = document.getElementById(id);
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};
</script>

<script src="{{ asset('js/quill.imageUploader.min.js') }}"></script>
<script>
	const csrfToken = "{{ csrf_token() }}";

	var toolbarOptions = [
		['bold', 'italic', 'underline', 'strike'],        // toggled buttons
		['blockquote', 'code-block'],

		[{ 'list': 'ordered'}, { 'list': 'bullet' }],
		[{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
		[{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent

		[{ 'header': [1, 2, 3, 4, 5, 6, false] }],
		[ 'link', 'image', 'video', 'formula' ],          // add's image support
		[{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
		[{ 'align': [] }],

		['clean']                                         // remove formatting button
	];

	Quill.register('modules/imageUploader', ImageUploader);

	var quill = new Quill('#editor', {
		modules: {
			toolbar: toolbarOptions,
			imageUploader: {
				upload: (file) => {
					return new Promise((resolve, reject) =>{
						const formData = new FormData();
                  		formData.append("image", file);

						fetch("/staf/manajemen-web/artikel/upload-image", {
								method: "POST",
								body: formData,
								headers: {
									"X-CSRF-TOKEN": csrfToken
								}
							}
						)
						.then(response => response.json())
						.then((result) => {
							if (result.errors) {
								const errorMessagesElement = document.querySelector('.error-messages');
								errorMessagesElement.innerHTML = ''; // Clear previous error messages

								for (const field in result.errors) {
									errorMessagesElement.innerHTML += `<p>${result.errors[field][0]}</p>`;
								}

								reject("Uplaod Gagal!");
							} else {
								console.log(result.image.url);		// debug

								if (!window.imageIds) {
									window.imageIds = [];
								}
								window.imageIds.push(result.image.id_gambar);

								const imageInput = $('input[name="image[]"]');
								imageInput.val(window.imageIds.join(','));

								resolve(result.image.url);
							}
						})
						.catch((error) => {
							reject("Upload Gagal!");
							console.error(error);
						});
					});
				},
			}
		},
		theme: 'snow',
		placeholder: 'Tulis isi artikel anda disini',
	});

	var isi = $('input[name=isi]');
	var oldIsi = {!! json_encode(old('isi')) !!};
	isi.val(oldIsi);

	$('form').submit(function() {
		isi.val($('.ql-editor').html());
	});
</script>

@endsection