@extends('layouts/userFormMain')

@section('form')

<link rel="stylesheet" href="{{ asset('css/letterNameAutoComplete.css') }}">

<div class="row mt-3 container">
	<div class="col-lg">
		<form action="/staf/manajemen-staf/new-staf" method="POST" autocomplete="off">
			@csrf
			<div class="form-group row">
				<label for="nama" class="col-sm-3 col-form-label">Nama<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text" 
						class="form-control form-control-sm @error('nama') is-invalid @enderror"
						name="nama"
						placeholder="ANDI" 
						value="{{ old('nama') }}">
					
					@error('nama')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="jabatan" class="col-sm-3 col-form-label">Jabatan<span style="color:red">*</span></label>
				<div class="col-sm-9" style="position: relative; display: inline-block">
					<input type="text"
						class="form-control form-control-sm @error('jabatan') is-invalid @enderror"
						id="jabatan"
						name="jabatan"
						placeholder="Kepala Desa"
						value="{{ old('jabatan') }}">

						@error('jabatan')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
				<div class="col-sm-9">
					<input type="date" 
						class="form-control form-control-sm"
						name="tgl_mulai"
						value="{{ old('tgl_mulai') ?? \Carbon\Carbon::now()->format('Y-m-d') }}">
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Tambah Staf Baru</button>
			</div>
		</form>
	</div>
</div>

@endsection