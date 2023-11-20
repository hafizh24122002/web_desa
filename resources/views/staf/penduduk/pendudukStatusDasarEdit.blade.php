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
		<form action="/staf/kependudukan/penduduk/edit-penduduk/status-dasar/{{ $nik }}" method="POST">
			@method('put')
			@csrf

			<div class="form-group row">
                <label for="judul" class="col-sm-3 col-form-label">UBAH STATUS DASAR</label>
                <hr>
            </div>

			<div class="form-group row">
				<label for="id_status_dasar" class="col-sm-3 col-form-label @error('id_status_dasar') is-invalid @enderror">Status Dasar Baru<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select name="id_status_dasar" id="status_dasar" class="form-select form-select-sm">
						<option value="">-- Pilih --</option>
						@foreach ($status_dasar as $item)
							<option value="{{ $item->id }}">
								{{ $item->nama }}
							</option>
						@endforeach
					</select>
					
					@error('id_status_dasar')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="tanggal_peristiwa" class="col-sm-3 col-form-label">Tanggal Peristiwa<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="date" class="form-control form-control-sm @error('tanggal_peristiwa') is-invalid @enderror"
						name="tanggal_peristiwa" value="{{ old('tanggal_peristiwa') }}">

					@error('tanggal_peristiwa')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="tanggal_lapor" class="col-sm-3 col-form-label">Tanggal Lapor<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="date" class="form-control form-control-sm @error('tanggal_lapor') is-invalid @enderror"
						name="tanggal_lapor" value="{{ old('tanggal_lapor') }}">

					@error('tanggal_lapor')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="catatan" class="col-sm-3 col-form-label">Catatan Peristiwa<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<textarea type="text" 
						class="form-control form-control-sm @error('catatan') is-invalid @enderror"
						name="catatan"
						placeholder="Catatan"
						value="{{ old('catatan') }}"
						rows="4"></textarea>

					<div class="form-helper text-muted fst-italic" style="font-size: small">*Jika penduduk mati/hilang berikan keterangan penyebabnya dan jika penduduk pindah maka tuliskan alamat pindah</div>

					@error('catatan')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Ubah Status Dasar Penduduk</button>
			</div>
		</form>
	</div>
</div>

@endsection