@extends('layouts/userFormMain')

@section('form')

<div class="row mt-3 container">
	<div class="col-lg">
		<form action="/staf/info-desa/wilayah-administratif/new-dusun" method="POST">
			@csrf

			<div class="form-group row">
				<label for="nama" class="col-sm-3 col-form-label">Nama Dusun</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="nama"
						placeholder="Dusun 1"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="alamat" class="col-sm-3 col-form-label">Nama Kepala Desa</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="alamat"
						placeholder="Kepala Dusun 1"
						required>
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Tambah Data Dusun</button>
			</div>
		</form>
	</div>
</div>

@endsection