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
							<option value="{{ $item->id }}" {{ old('id_status_dasar') == $item->id ? 'selected' : '' }}>
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

			<div class="form-group row" id="mati" style="display: none">
				<label for="meninggal_di" class="col-sm-3 col-form-label">Tempat Meninggal<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text" 
						class="form-control form-control-sm mati @error('meninggal_di') is-invalid @enderror"
						name="meninggal_di" 
						placeholder="Tempat Meninggal"
						value="{{ old('meninggal_di') }}">

					@error('meninggal_di')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<label for="jam_mati" class="col-sm-3 col-form-label">Jam Mati<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="time" class="form-control form-control-sm mati @error('jam_mati') is-invalid @enderror"
						name="jam_mati" value="{{ old('jam_mati') }}">

					@error('jam_mati')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<label for="id_penyebab_kematian" class="col-sm-3 col-form-label @error('id_penyebab_kematian') is-invalid @enderror">Penyebab Kematian<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select name="id_penyebab_kematian" id="penyebab_kematian" class="form-select form-select-sm mati">
						<option value="">-- Pilih --</option>
						@foreach ($penyebab_kematian as $item)
							<option value="{{ $item->id }}"{{ old('id_penyebab_kematian') == $item->id ? 'selected' : '' }}>
								{{ $item->nama }}
							</option>
						@endforeach
					</select>
					
					@error('id_penyebab_kematian')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<label for="id_penolong_kematian" class="col-sm-3 col-form-label">Yang Menerangkan Kematian<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select name="id_penolong_kematian" 
						id="penyebab_kematian"
						class="form-select form-select-sm mati @error('id_penolong_kematian') is-invalid @enderror">

						<option value="">-- Pilih --</option>
						@foreach ($penolong_kematian as $item)
							<option value="{{ $item->id }}" {{ old('id_penolong_kematian') == $item->id ? 'selected' : '' }}>
								{{ $item->nama }}
							</option>
						@endforeach
					</select>
					
					@error('id_penolong_kematian')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<label for="jam_mati" class="col-sm-3 col-form-label">Jam Kematian<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="time" class="form-control form-control-sm mati @error('jam_mati') is-invalid @enderror"
						name="jam_mati" value="{{ old('jam_mati') }}">

					@error('jam_mati')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<label for="no_akta_mati" class="col-sm-3 col-form-label">Nomor Akta Kematian<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text" 
						class="form-control form-control-sm mati @error('no_akta_mati') is-invalid @enderror"
						name="no_akta_mati" 
						placeholder="Nomor Akta Kematian"
						value="{{ old('no_akta_mati') }}">

					@error('no_akta_mati')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row" id="pindah" style="display: none">
				<label for="id_pindah" class="col-sm-3 col-form-label">Tujuan Pindah<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select name="id_pindah" id="pindah" class="form-select form-select-sm pindah @error('id_pindah') is-invalid @enderror">
						<option value="">-- Pilih --</option>
						@foreach ($pindah as $item)
							<option value="{{ $item->id }}" {{ old('id_pindah') == $item->id ? 'selected' : '' }}>
								{{ $item->nama }}
							</option>
						@endforeach
					</select>
					
					@error('id_pindah')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<label for="alamat_tujuan" class="col-sm-3 col-form-label">Alamat Tujuan<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text" 
						class="form-control form-control-sm pindah @error('alamat_tujuan') is-invalid @enderror"
						name="alamat_tujuan" 
						placeholder="Alamat Tujuan"
						value="{{ old('alamat_tujuan') }}">

					@error('alamat_tujuan')
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
						name="tanggal_peristiwa" value="{{ old('tanggal_peristiwa') ?? \Carbon\Carbon::now()->toDateString() }}">

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
						name="tanggal_lapor" value="{{ old('tanggal_lapor') ?? \Carbon\Carbon::now()->toDateString() }}">

					@error('tanggal_lapor')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="catatan" class="col-sm-3 col-form-label">Catatan Peristiwa</label>
				<div class="col-sm-9">
					<textarea type="text" 
						class="form-control form-control-sm @error('catatan') is-invalid @enderror"
						name="catatan"
						placeholder="Catatan"
						value="{{ old('catatan') }}"
						rows="4"></textarea>

					<div class="form-helper text-muted fst-italic" style="font-size: small">
						*Jika penduduk mati/hilang berikan keterangan penyebabnya dan jika penduduk pindah maka tuliskan alamat pindahnya
					</div>

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

@include('partials.commonScripts')
<script>
	$(document).ready(function () {
		switch ($('#status_dasar').find(":selected").val()) {
			case '2':	// MATI
				$('#pindah').hide();
				$('#mati').show();
				$('.pindah').prop('disabled', true);
				$('.mati').prop('disabled', false);
				break;
			
			case '3':	// PINDAH
				$('#pindah').show();
				$('#mati').hide();
				$('.pindah').prop('disabled', false);
				$('.mati').prop('disabled', true);
				break;

			default:
				$('#mati').hide();
				$('#pindah').hide();
				$('.mati').prop('disabled', true);
				$('.pindah').prop('disabled', true);
				break;
		}
		
		$('#status_dasar').on('change', function () {
			switch ($(this).find(":selected").val()) {
				case '2':	// MATI
					if ($('#pindah').is(':visible')) {
						$('#pindah').slideUp();
						$('.pindah').prop('disabled', true);
					}
					if ($('#mati').is(':hidden')) {
						$('#mati').slideDown();
						$('.mati').prop('disabled', false);
					}
					break;

				case '3':	// PINDAH
					if ($('#pindah').is(':hidden')) {
						$('#pindah').slideDown();
						$('.pindah').prop('disabled', false);
					}
					if ($('#mati').is(':visible')) {
						$('#mati').slideUp();
						$('.mati').prop('disabled', true);
					}
					break;

				default:
					if ($('#pindah').is(':visible')) {
						$('#pindah').slideUp();
						$('.pindah').prop('disabled', true);
					}
					if ($('#mati').is(':visible')) {
						$('#mati').slideUp();
						$('.mati').prop('disabled', true);
					}
					break;
			}
		});
	});
</script>

@endsection