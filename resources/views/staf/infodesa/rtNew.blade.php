@extends('layouts/userFormMain')

@section('form')

<div class="row mt-3 container">
	<div class="col-lg">
		<form action="/staf/info-desa/rt/new-rt/{{$id_dusun}}" method="POST">
			@csrf

			<input type="hidden" name="id_wilayah_dusun" value="{{$id_dusun}}">

			<div class="form-group row">
				<label for="nama" class="col-sm-3 col-form-label">Nama RT<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control form-control-sm" name="nama" placeholder="001" required>
				</div>
			</div>

			<div class="form-group row">
				<label for="nik_kepala" class="col-sm-3 col-form-label">Ketua RT<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select name="nik_kepala" id="nik_kepala" class="form-control form-control-sm">
						<option value="">-- Pilih --</option>
						@foreach ($penduduk as $data)
							@if(!collect($helper_rt)->contains('nik_kepala', $data->nik) && (!collect($helper_dusun)->contains('nik_kepala', $data->nik) || $data->id_wilayah_dusun == $id_dusun))
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