@extends('layouts/userFormMain')

@section('form')

<link rel="stylesheet" href="{{ asset('css/letterNameAutoComplete.css') }}">

<div class="row mt-3 container">
	<div class="col-lg">
		<form action="/staf/manajemen-staf/new-staf" method="POST" autocomplete="off">
			@csrf
			<div class="form-group row">
				<label for="nip" class="col-sm-3 col-form-label">NIP</label>
				<div class="col-sm-9">
					<input type="text" 
						class="form-control form-control-sm @error('nip') is-invalid @enderror"
						name="nip"
						placeholder="200212242020071001"
						value="{{ old('nip') }}"
						required>
					
					@error('nip')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="nama" class="col-sm-3 col-form-label">Nama</label>
				<div class="col-sm-9">
					<input type="text" 
						class="form-control form-control-sm @error('nama') is-invalid @enderror"
						name="nama"
						placeholder="ANDI" 
						value="{{ old('nama') }}"
						required>
					
					@error('nama')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
				<div class="col-sm-9" style="position: relative; display: inline-block">
					<input type="text"
						class="form-control form-control-sm autocomplete"
						id="jabatan"
						name="jabatan"
						placeholder="Kepala Desa"
						value="{{ old('jabatan') }}"
						required>
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Tambah Staf Baru</button>
			</div>
		</form>
	</div>
</div>

@include('partials.commonScripts')

<script src="{{ asset('js/autocompleteJabatan.js') }}"></script>
<script>
	var jabatan = [
		"Kepala Desa",
		"Sekretaris Desa",
		"Kasi Kesejahteraan",
		"Kasi Pelayanan",
		"Kasi Pemerintahan",
		"Kasi TU dan UMUM",
		"Kaur Perencanaan",
		"Kepala Dusun 1",
		"Kepala Dusun 2",
		"Staf Administrasi",
	];
	autocomplete(document.getElementById("jabatan"), jabatan);
</script>

@endsection