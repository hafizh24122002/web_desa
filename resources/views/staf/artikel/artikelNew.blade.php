@extends('layouts/userFormMain')

@section('form')

<link rel="stylesheet" href="{{ asset('css/letterNameAutoComplete.css') }}">
<link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
<link rel="stylesheet" href="{{ asset('css/quill.imageUploader.min.css') }}">

<div class="row mt-3 container">
	<div class="col-lg">
		<form action="/staf/manajemen-web/artikel/new-artikel" method="POST" autocomplete="off" id="form">
			@csrf
			<div class="form-group row">
				<label for="judul" class="col-sm-2 col-form-label">Judul<span style="color:red">*</span></label>
				<div class="col-sm-10">
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
				<label for="editor" class="col-sm-2 col-form-label">Isi<span style="color:red">*</span></label>
				<div class="col-sm-10">
					<div id="editor"
						name="editor"
						class=" @error('isi') is-invalid @enderror"
						style="height: 15rem; margin-bottom: 20px; resize: vertical; overflow: auto;">

						{!! old('content', '') !!}
					</div>
					@error('isi')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="judul" class="col-sm-2 col-form-label">Status Artikel</label>
				<div class="col-sm-10 d-flex align-items-center gap-2">
					<input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
					<label class="form-check-label" for="flexCheckDefault">
						Aktif
					</label>
				</div>
			</div>

			<input type="hidden" name="content" id="content">

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Tambah Artikel Baru</button>
			</div>
		</form>
	</div>
</div>

@include('partials.commonScripts')

<script src="{{ asset('js/quill.min.js') }}"></script>
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
						.then((response) => response.json())
						.then((result) => {
							console.log(result);
							resolve(result.data.url);
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

	var content = $('input[name=content]');
	var oldContent = {!! json_encode(old('content')) !!};
	content.val(oldContent);

	$('form').submit(function() {
		content.val($('.ql-editor').html());
  });
</script>

@endsection