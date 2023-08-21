@extends('layouts/userFormMain')

@section('form')

<link rel="stylesheet" href="{{ asset('css/letterNameAutoComplete.css') }}">
<link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">


<div class="row mt-3 container">
	<div class="col-lg">
		<form action="/staf/manajemen-web/artikel/edit-artikel/{{ $artikel->id }}" method="POST" autocomplete="off" id="form">
			@method('put')
			@csrf

			<div class="form-group row">
				<label for="judul" class="col-sm-2 col-form-label">Judul<span style="color:red">*</span></label>
				<div class="col-sm-10">
					<input type="text"
						class="form-control form-control-sm autocomplete"
						id="judul"
						name="judul"
						placeholder="Judul Artikel"
						value="{{ old('judul') ?? $artikel->judul }}"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="editor" class="col-sm-2 col-form-label">Isi<span style="color:red">*</span></label>
				<div class="col-sm-10">
					<div id="editor"
						name="editor"
						style="height: 15rem; margin-bottom: 20px; resize: vertical; overflow: auto;"
						required>

						{!! old('content', $artikel->isi) !!}
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label for="judul" class="col-sm-2 col-form-label">Status Artikel</label>
				<div class="col-sm-10 d-flex align-items-center gap-2">
					<input class="form-check-input"
						type="checkbox"
						id="is_active"
						name="is_active"
						value="1"
						{{ $artikel->is_active == 1 ? 'checked' : '' }}>
					<label class="form-check-label" for="flexCheckDefault">
						Aktif
					</label>
				</div>
			</div>

			<input type="hidden" name="content" id="content">

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Ubah Artikel</button>
			</div>
		</form>
	</div>
</div>

@include('partials.commonScripts')

<script src="{{ asset('js/quill.min.js') }}"></script>
<script>
	var quill = new Quill('#editor', {
		theme: 'snow'
	});

	var content = $('input[name=content]');
	var oldContent = {!! json_encode(old('content', $artikel->isi)) !!};
	content.val(oldContent);

	$('form').submit(function() {
		content.val($('.ql-editor').html());
  });
</script>

@endsection