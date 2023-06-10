@extends('layouts/adminMain')

@section('main-content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
			<div class="row mt-3 container">
				<div class="col-lg">
					<form action="/staf/kesehatan/pemantauan/new-pemantauan-ibu" method="POST">
						@csrf
			
						<div class="form-group row">
							<label for="id_kia" class="col-sm-3 col-form-label">Nomor KIA<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<select class="form-select form-select-sm @error('id_kia') is-invalid @enderror" id="id_kia" name="id_kia">
									<option value="">-- Pilih --</option>
									@foreach ($kia as $item)
										<option value="{{ $item->id }}" {{ old('id_kia') == $item->id ? 'selected' : '' }}>{{ $item->no_kia.' - '.$item->ibu->nama }}</option>
									@endforeach
								</select>

								@error('id_kia')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
			
						<div class="form-group row">
							<label for="tanggal_periksa" class="col-sm-3 col-form-label">Tanggal Periksa<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="date"
									class="form-control form-control-sm @error('tanggal_periksa') is-invalid @enderror"
									name="tanggal_periksa"
									value="{{ old('tanggal_periksa') }}">

								@error('tanggal_periksa')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="id_posyandu" class="col-sm-3 col-form-label">Posyandu<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<select class="form-select form-select-sm @error('id_posyandu') is-invalid @enderror" id="id_posyandu" name="id_posyandu">
									<option value="">-- Pilih --</option>
									@foreach ($posyandu as $item)
										<option value="{{ $loop->iteration }}" {{ old('id_posyandu') == $loop->iteration ? 'selected' : '' }}>{{ $item->nama }}</option>
									@endforeach
								</select>

								@error('id_posyandu')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="status_kehamilan" class="col-sm-3 col-form-label">Status Kehamilan<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<select class="form-select form-select-sm @error('status_kehamilan') is-invalid @enderror" id="status_kehamilan" name="status_kehamilan">
									<option value="">-- Pilih --</option>
									<option value="Normal (N)" {{ old('status_kehamilan') == 'Normal (N)' ? 'selected' : '' }}>Normal (N)</option>
									<option value="Risiko Tinggi (Risti)" {{ old('status_kehamilan') == 'Risiko Tinggi (Risti)' ? 'selected' : '' }}>Risiko Tinggi (Risti)</option>
									<option value="Kekurangan Energi Kronis (KEK)" {{ old('status_kehamilan') == 'Kekurangan Energi Kronis (KEK)' ? 'selected' : '' }}>Kekurangan Energi Kronis (KEK)</option>
								</select>

								@error('status_kehamilan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="usia_kehamilan" class="col-sm-3 col-form-label">Usia Kehamilan (Bulan)<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="number"
									class="form-control form-control-sm @error('usia_kehamilan') is-invalid @enderror"
									name="usia_kehamilan"
									placeholder="Usia Kehamilan dalam Bulan"
									value="{{ old('usia_kehamilan') }}">

								@error('usia_kehamilan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="tanggal_melahirkan" class="col-sm-3 col-form-label">Tanggal Melahirkan</label>
							<div class="col-sm-9">
								<input type="date"
									class="form-control form-control-sm"
									name="tanggal_melahirkan"
									value="{{ old('tanggal_melahirkan') }}" readonly>
							</div>
						</div>

						<div class="form-group row" id="butir_pil_fe">
							<label for="butir_pil_fe" class="col-sm-3 col-form-label">Butir Pil Fe<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="number"
									class="form-control form-control-sm @error('butir_pil_fe') is-invalid @enderror"
									name="butir_pil_fe"
									placeholder="Butir Pil Fe yang di Konsumsi"
									value="{{ old('butir_pil_fe') }}">

								@error('butir_pil_fe')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<br>

						<strong>Status Penerimaan Indikator:</strong>

						<div class="form-group row mt-2">
							<div class="col-sm-6 d-flex gap-2">
								<input type="checkbox" name="pemeriksaan_kehamilan" id="pemeriksaan_kehamilan" {{ old('pemeriksaan_kehamilan') ? 'checked' : '' }}>
								<label for="pemeriksaan_kehamilan">Pemeriksaan Kehamilan</label>
							</div>

							<div class="col-sm-6 d-flex gap-2">
								<input type="checkbox" name="konsumsi_pil_fe" id="konsumsi_pil_fe" {{ old('konsumsi_pil_fe') ? 'checked' : '' }}>
								<label for="konsumsi_pil_fe">Dapat & Konsumsi Pil Fe</label>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-6 d-flex gap-2">
								<input type="checkbox" name="pemeriksaan_nifas" id="pemeriksaan_nifas" {{ old('pemeriksaan_nifas') ? 'checked' : '' }}>
								<label for="pemeriksaan_nifas">Pemeriksaan Nifas</label>
							</div>

							<div class="col-sm-6 d-flex gap-2">
								<input type="checkbox" name="konseling_gizi" id="konseling_gizi" {{ old('konseling_gizi') ? 'checked' : '' }}>
								<label for="konseling_gizi">Konseling Gizi (Kelas IH)</label>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-6 d-flex gap-2">
								<input type="checkbox" name="kunjungan_rumah" id="kunjungan_rumah" {{ old('kunjungan_rumah') ? 'checked' : '' }}>
								<label for="kunjungan_rumah">Kunjungan Rumah</label>
							</div>

							<div class="col-sm-6 d-flex gap-2">
								<input type="checkbox" name="akses_air_bersih" id="akses_air_bersih" {{ old('akses_air_bersih') ? 'checked' : '' }}>
								<label for="akses_air_bersih">Akses Air Bersih</label>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-6 d-flex gap-2">
								<input type="checkbox" name="kepemilikan_jamban" id="kepemilikan_jamban" {{ old('kepemilikan_jamban') ? 'checked' : '' }}>
								<label for="kepemilikan_jamban">Kepemilikan Jamban</label>
							</div>

							<div class="col-sm-6 d-flex gap-2">
								<input type="checkbox" name="jaminan_kesehatan" id="jaminan_kesehatan" {{ old('jaminan_kesehatan') ? 'checked' : '' }}>
								<label for="jaminan_kesehatan">Jaminan Kesehatan</label>
							</div>
						</div>

						<br>
			
						<div class="d-sm-flex justify-content-md-end">
							<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Tambah Data Pemantauan Ibu</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>


@include('partials.commonScripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
	if ($('#konsumsi_pil_fe').is(':checked')) {
		$('#butir_pil_fe').show();
	} else {
		$('#butir_pil_fe').hide();
	}

	$(document).ready(function() {
		$('#id_kia').select2({theme: "bootstrap-5"});
		$('#id_posyandu').select2({theme: "bootstrap-5"});

		$('#konsumsi_pil_fe').on('change', function() {
            if ($(this).is(':checked')) {
                $('#butir_pil_fe').slideDown();
            } else {
                $('#butir_pil_fe').slideUp();
            }
        });
	});
</script>

@endsection