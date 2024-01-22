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
	
			<!-- Input Kepala Rumah Tangga -->
			{{-- <div class="form-group row">
                    <label for="helper_penduduk_rtm" class="col-sm-3 col-form-label">Kepala Rumah Tangga<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input" id="grup-input" name="id_helper_penduduk_rtm">
                            <option value="">-- Pilih Jenis Kelamin--</option>
                            @foreach ($helper_penduduk_rtm as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_helper_penduduk_rtm') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_helper_penduduk_rtm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

			<div class="form-group">
				<label for="kepala_rumah_tangga">Kepala Rumah Tangga</label>
				<select class="form-control" id="kepala_rumah_tangga" name="kepala_rumah_tangga" required>
					<!-- Isi opsi select dengan nama-nama dari tabel penduduk -->
					@foreach($id_helper_penduduk_rtm as $item)
						<option value="{{ $penduduk->id }}">{{ $penduduk->nama }}</option>
					@endforeach
				</select>
			</div>
	
			<!-- Input BDT (number only) -->
			<div class="form-group">
				<label for="bdt">BDT</label>
				<input type="number" class="form-control" id="bdt" name="bdt" required>
			</div> --}}
	
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