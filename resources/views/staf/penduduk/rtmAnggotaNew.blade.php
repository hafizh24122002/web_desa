@extends('layouts/userFormMain')

@section('form')
<div class="row mt-3 container">
	<div class="col-lg">
		<form id="rtmForm" action="/staf/kependudukan/rtm/new-rtm" method="POST">
			@csrf <!-- Token CSRF untuk keamanan -->
	
			<!-- Input Nomor Rumah Tangga (no_rt) -->
			<div class="form-group row">
                <label for="no_rtm" class="col-sm-3 col-form-label">Nomor Rumah Tangga<span style="color:red">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm 	@error('no_rtm') is-invalid @enderror"
                        name="no_rtm" placeholder="no_rtm" value="{{ old('no_rtm') }}" required>

                    @error('no_rtm')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

			<div class="form-group row">
                <label for="nik_kepala" class="col-sm-3 col-form-label">Kepala Rumah Tangga</label>
				<div class="col-sm-9">
					<select class="form-control @error('nik_kepala') is-invalid @enderror"
						id="nik_kepala" name="nik_kepala" required>
						<option value="">Pilih NIK Kepala</option>
						@foreach($nik_kepala as $penduduk)
							<option value="{{ $penduduk->nik }}">{{ $penduduk->nama }} - {{ $penduduk->nik }}</option>
						@endforeach
					</select>
					@error('nik_kepala')
						<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
            </div>

			<div class="form-group row">
                <label for="alamat" class="col-sm-3 col-form-label">Alamat<span style="color:red">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm 	@error('alamat') is-invalid @enderror"
                        name="alamat" placeholder="alamat" value="{{ old('alamat') }}" required>

                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
			
			<div class="form-group row">
                <label for="bdt" class="col-sm-3 col-form-label">BDT<span style="color:red">*</span></label>
                <div class="col-sm-9">
                    <input type="number" class="form-control form-control-sm 	@error('bdt') is-invalid @enderror"
                        name="bdt" placeholder="bdt" value="{{ old('bdt') }}" required>

                    @error('bdt')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
	
			<!-- Checkbox DTKS -->
			<div class="form-check">
				<input type="checkbox" 
				(change)="isCheckModel = $event.target.checked ? 1: 0"
				name="isCheckModel"
				[(ngModel)]="isCheckModel" class="form-check-input" id="dtks" name="dtks">
				<label class="form-check-label" for="dtks">DTKS</label>
			</div>
	
			<!-- Tombol Submit -->
			<button type="submit" class="btn btn-primary">Simpan</button>
		</form>
	</div>

@endsection