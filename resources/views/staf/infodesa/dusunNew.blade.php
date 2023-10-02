@extends('layouts/userFormMain')

@section('form')

<div class="row mt-3 container">
	<div class="col-lg">
		<form action="/staf/info-desa/dusun/new-dusun" method="POST">
			@csrf

			<div class="form-group row">
				<label for="nama" class="col-sm-3 col-form-label">Nama Dusun<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control form-control-sm" name="nama" placeholder="Dusun 1" required>
				</div>
			</div>

			<div class="form-group row">
				<label for="id_kepala_dusun" class="col-sm-3 col-form-label">Kepala Dusun<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select name="id_kepala_dusun" id="id_kepala_dusun" class="form-control form-control-sm">
						<option value="">-- Pilih --</option>
						@foreach ($kepala_dusun as $data)
						<option value="{{ $data->id }}">{{ $data->jabatan }} - {{ $data->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="no_telp_dusun" class="col-sm-3 col-form-label">No. Telp Dusun</label>
				<div class="col-sm-9">
					<input type="number" class="form-control form-control-sm" name="no_telp_dusun" placeholder="0210192307" required>
				</div>
			</div>

			<div class="form-group row">
				<label for="jumlah_rt" class="col-sm-3 col-form-label">Jumlah RT</label>
				<div class="col-sm-9">
					<input type="number" class="form-control form-control-sm" name="jumlah_rt" placeholder="5" required>
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Tambah Data Dusun</button>
			</div>
		</form>
	</div>
</div>

@endsection