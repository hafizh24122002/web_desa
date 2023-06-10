@extends('layouts/userFormMain')

@section('form')

<link rel="stylesheet" href="{{ asset('css/letterNameAutoComplete.css') }}">

<div class="row mt-3 container">
	<div class="col-lg">
		<form action="/staf/kesehatan/kia/new-kia" method="POST">
			@csrf

			<div class="form-group row">
				<label for="no_kia" class="col-sm-3 col-form-label">Nomor KIA<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="no_kia"
						placeholder="12345"
						value="{{ old('no_kia') }}"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="nama_ibu" class="col-sm-3 col-form-label">Nama Ibu<span style="color:red">*</span></label>
				<div class="col-sm-9" style="position: relative; display: inline-block">
					<input type="text" 
						class="form-control form-control-sm @error('nama_ibu') is-invalid @enderror"
						name="nama_ibu"
						id="nama_ibu"
						placeholder="Nama Ibu"
						value="{{ old('nama_ibu') }}"
						autocomplete="off"
						required>

					@error('nama_ibu')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="nama_anak" class="col-sm-3 col-form-label">Nama Anak</label>
				<div class="col-sm-9" style="position: relative; display: inline-block">
					<input type="text" 
						class="form-control form-control-sm @error('nama_anak') is-invalid @enderror"
						name="nama_anak"
						id="nama_anak"
						placeholder="Nama Anak"
						value="{{ old('nama_anak') }}"
						autocomplete="off"
						>

					@error('nama_anak')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="perkiraan_kelahiran" class="col-sm-3 col-form-label">Perkiraan Kelahiran</label>
				<div class="col-sm-9">
					<input type="date"
						class="form-control form-control-sm"
						name="perkiraan_kelahiran"
						value="{{ old('perkiraan_kelahiran') }}">
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Tambah Data KIA</button>
			</div>
		</form>
	</div>
</div>

@include('partials.commonScripts')
<script src="{{ asset('js/autocompleteNamaNik.js') }}"></script>
<script>
	dataIbu = @json($dataIbu);
	pendudukList = @json($penduduk);

	autocomplete(document.getElementById("nama_ibu"), dataIbu);
	autocomplete(document.getElementById("nama_anak"), pendudukList);
</script>

@endsection