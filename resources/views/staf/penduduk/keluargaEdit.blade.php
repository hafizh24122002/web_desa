@extends('layouts/userFormMain')

@section('form')

<div class="row mt-3 container">
	<div class="col-lg">
		<form action="/staf/kependudukan/keluarga/edit-keluarga/{{ $keluarga->no_kk }}" method="POST">
			@method('put')
			@csrf
			<div class="form-group row">
				<label for="no_kk" class="col-sm-3 col-form-label">No. KK<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text" 
						class="form-control form-control-sm @error('no_kk') is-invalid @enderror"
						name="no_kk"
						placeholder="1903051234567890" 
						value="@if(null!==old('no_kk')){{old('no_kk')}}@else{{$keluarga->no_kk}}@endif"
						required>
					
					@error('no_kk')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="nik_kepala" class="col-sm-3 col-form-label">NIK Kepala Keluarga</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="nik_kepala"
						value="@if(null!==old('nik_kepala')){{old('nik_kepala')}}@else{{$keluarga->nik_kepala}}@endif"
						placeholder="1903051234567890">
				</div>
			</div>

			<div class="form-group row">
				<label for="id_kelas_sosial" class="col-sm-3 col-form-label">Kelas Sosial</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="id_kelas_sosial">
						<option value="">-- Pilih --</option>
						@foreach ($kelas_sosial as $item)
							<option value="{{ $loop->iteration }}" {{ old('id_kelas_sosial', $keluarga->id_kelas_sosial) == $loop->iteration ? "selected":""}}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="alamat"
						value="@if(null!==old('alamat')){{old('alamat')}}@else{{$keluarga->alamat}}@endif"
						placeholder="JL. MERPATI NO.51 RT.03/RW.02">
				</div>
			</div>

			<div class="form-group row">
				<label for="tgl_dikeluarkan" class="col-sm-3 col-form-label">Tanggal KK Dikeluarkan</label>
				<div class="col-sm-9">
					<input type="date"
						class="form-control form-control-sm"
						name="tgl_dikeluarkan"
						value="@if(null!==old('tgl_dikeluarkan')){{old('tgl_dikeluarkan')}}@else{{$keluarga->tgl_dikeluarkan}}@endif">
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Ubah Data Keluarga</button>
			</div>
		</form>
	</div>
</div>

@endsection