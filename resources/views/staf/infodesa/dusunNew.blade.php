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
				<label for="nik_kepala" class="col-sm-3 col-form-label">Kepala Dusun<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select name="nik_kepala" id="nik_kepala" class="form-control form-control-sm">
						<option value="">-- Pilih --</option>
						@foreach ($penduduk as $data)
							@if(!collect($helper_dusun)->contains('nik_kepala', $data->nik))
								<option value="{{ $data->nik }}">{{ $data->nik }} - {{ $data->nama }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Tambah Data Dusun</button>
			</div>
		</form>
	</div>
</div>

@endsection