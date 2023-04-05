@extends('layouts/userFormMain')

@section('form')

<div class="row mt-3 container">
	{{-- <div class="col-lg-4">
		<img id="frame" src="" class="img-fluid" />
		<div class="input-group">
			<input type="file" class="form-control form-control-sm" id="formFile" onchange="preview()" aria-label="Upload">
			<button class="btn btn-outline-secondary btn-sm" type="button" id="inputGroupFileAddon04">Upload</button>
		</div>
	</div> --}}

	<div class="col-lg">
		<form action="/staf/kependudukan/penduduk/edit-penduduk/{{ $penduduk->nik }}" method="POST">
			@method('put')
			@csrf
			<div class="form-group row">
				<label for="nama" class="col-sm-3 col-form-label">Nama<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text" 
						class="form-control form-control-sm @error('nama') is-invalid @enderror"
						name="nama"
						placeholder="NAMA" 
						value="@if(null!==old('nama')){{old('nama')}}@else{{$penduduk->nama}}@endif"
						required>
					
					@error('nama')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="nik" class="col-sm-3 col-form-label">NIK<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm @error('nik') is-invalid @enderror"
						name="nik"
						value="@if(null!==old('nik')){{old('nik')}}@else{{$penduduk->nik}}@endif"
						placeholder="190305xxxxxxxxxx"
						required>
					
					@error('nik')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="kk" class="col-sm-3 col-form-label">No. Kartu Keluarga</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="no_kk"
						value="@if(null!==old('no_kk')){{old('no_kk')}}@else{{$penduduk->no_kk}}@endif"
						placeholder="190305xxxxxxxxxx">
				</div>
			</div>

			<div class="form-group row">
				<label for="hubungan_kk" class="col-sm-3 col-form-label">Status hubungan dalam KK</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="id_hubungan_kk">
						<option value="">-- Pilih --</option>
						@foreach ($hubungan_kk as $item)
							<option value="{{ $loop->iteration }}" {{ old('id_hubungan_kk', $penduduk->id_hubungan_kk) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="rt" class="col-sm-3 col-form-label">No. Rumah Tangga</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="id_rt">
						<option value="1">TODO</option>    {{-- TODO --}}
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="jenis_kelamin">
						<option value="">-- Pilih --</option>
						<option value="L" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == "L" ? "selected":"" }}>LAKI-LAKI</option>
						<option value="P" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == "P" ? "selected":"" }}>PEREMPUAN</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="tempat_lahir"
						value="@if(null!==old('tempat_lahir')){{old('tempat_lahir')}}@else{{$penduduk->tempat_lahir}}@endif"
						placeholder="BANGKA SELATAN">
				</div>
			</div>

			<div class="form-group row">
				<label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
				<div class="col-sm-9">
					<input type="date"
						class="form-control form-control-sm"
						value="@if(null!==old('tanggal_lahir')){{old('tanggal_lahir')}}@else{{$penduduk->tanggal_lahir}}@endif"
						name="tanggal_lahir">
				</div>
			</div>

			<div class="form-group row">
				<label for="agama" class="col-sm-3 col-form-label">Agama</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="id_agama">
						<option value="">-- Pilih --</option>
						@foreach ($agama as $item)
							<option value="{{ $loop->iteration }}" {{ old('id_agama', $penduduk->id_agama) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="pendidikan_terakhir" class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="id_pendidikan_terakhir">
						<option value="">-- Pilih --</option>
						@foreach ($pendidikan_terakhir as $item)
							<option value="{{ $loop->iteration }}" {{ old('id_pendidikan terakhir', $penduduk->id_pendidikan_terakhir) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm pekerjaan_input" id="grup-input" name="id_pekerjaan">
						<option value="">-- Pilih --</option>
						@foreach ($pekerjaan as $item)
							<option value="{{ $loop->iteration }}"{{ old('id_pekerjaan', $penduduk->id_pekerjaan) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="status_perkawinan" class="col-sm-3 col-form-label">Status Perkawinan</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm pekerjaan_input" id="grup-input" name="id_status_perkawinan">
						<option value="">-- Pilih --</option>
						@foreach ($status_perkawinan as $item)
							<option value="{{ $loop->iteration }}" {{ old('id_status_perkawinan', $penduduk->id_status_perkawinan) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="kewarganegaraan" class="col-sm-3 col-form-label">Kewarganegaraan</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm pekerjaan_input" id="grup-input" name="id_kewarganegaraan">
						<option value="">-- Pilih --</option>
						@foreach ($kewarganegaraan as $item)
							<option value="{{ $loop->iteration }}" {{ old('id_kewarganegaraan', $penduduk->id_kewarganegaraan) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="nik_ayah" class="col-sm-3 col-form-label">NIK Ayah</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="nik_ayah"
						value="@if(null!==old('nik_ayah')){{old('nik_ayah')}}@else{{$penduduk->nik_ayah}}@endif"
						placeholder="190305xxxxxxxxxx">
				</div>
			</div>

			<div class="form-group row">
				<label for="nik_ibu" class="col-sm-3 col-form-label">NIK Ibu</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="nik_ibu"
						value="@if(null!==old('nik_ibu')){{old('nik_ibu')}}@else{{$penduduk->nik_ibu}}@endif"
						placeholder="190305xxxxxxxxxx">
				</div>
			</div>

			<div class="form-group row">
				<label for="penduduk_tetap" class="col-sm-3 col-form-label">Penduduk Tetap</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="penduduk_tetap">
						<option value="">-- Pilih --</option>
						<option value="1" {{ old('penduduk_tetap', $penduduk->penduduk_tetap) == "1" ? "selected":"" }}>Ya</option>
						<option value="0" {{ old('penduduk_tetap', $penduduk->penduduk_tetap) == "0" ? "selected":"" }}>Tidak</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="alamat"
						value="@if(null!==old('alamat')){{old('alamat')}}@else{{$penduduk->alamat}}@endif"
						placeholder="JL. MERPATI NO. 51 RT.03/RW.02">
				</div>
			</div>

			<div class="form-group row">
				<label for="telepon" class="col-sm-3 col-form-label">Telepon</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="telepon"
						value="@if(null!==old('telepon')){{old('telepon')}}@else{{$penduduk->telepon}}@endif"
						placeholder="08xxxxxxxxxx">
				</div>
			</div>

			<div class="form-group row">
				<label for="status" class="col-sm-3 col-form-label">Status</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="status">
						<option value="">-- Pilih --</option>
						<option value="1" {{ old('status', $penduduk->status) == "1" ? "selected":"" }}>HIDUP</option>
						<option value="0" {{ old('status', $penduduk->status) == "0" ? "selected":"" }}>MATI</option>
					</select>
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Ubah Data Penduduk</button>
			</div>
		</form>
	</div>
</div>

@endsection