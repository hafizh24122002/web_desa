@extends('layouts/adminMain')

@section('main-content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="row mt-3 container">
				<div class="col-lg">
					<form action="/staf/kesehatan/pemantauan/edit-pemantauan-anak/{{ $kia_anak->id }}" method="POST">
						@method('put')
						@csrf
			
						<div class="form-group row">
							<label for="id_kia" class="col-sm-3 col-form-label">Nomor KIA<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<select class="form-select form-select-sm @error('id_kia') is-invalid @enderror" id="id_kia" name="id_kia" onchange="updateUmurField()">
									<option value="">-- Pilih --</option>
									@foreach ($kia as $item)
										<option value="{{ $item->id }}" {{ (old('id_kia') ?? $kia_anak->id_kia) == $item->id ? 'selected' : '' }} nik="{{ $item->anak->nik }}">{{ $item->no_kia.' - '.$item->anak->nama }}</option>
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
									value="{{ old('tanggal_periksa') ?? $kia_anak->tanggal_periksa->format('Y-m-d') }}">

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
										<option value="{{ $loop->iteration }}" {{ (old('id_posyandu') ?? $kia_anak->id_posyandu) == $loop->iteration ? 'selected' : '' }}>{{ $item->nama }}</option>
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
							<label for="status_gizi_anak" class="col-sm-3 col-form-label">Status Gizi Anak<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<select class="form-select form-select-sm @error('status_gizi_anak') is-invalid @enderror" id="status_gizi_anak" name="status_gizi_anak">
									<option value="">-- Pilih --</option>
									<option value="Sehat / Normal (N)" {{ (old('status_gizi_anak') ?? $kia_anak->status_gizi_anak) == 'Sehat / Normal (N)' ? 'selected' : '' }}>Sehat / Normal (N)</option>
									<option value="Gizi Kurang (GK)" {{ (old('status_gizi_anak') ?? $kia_anak->status_gizi_anak) == 'Gizi Kurang (GK)' ? 'selected' : '' }}>Gizi Kurang (GK)</option>
									<option value="Gizi Buruk(GB)" {{ (old('status_gizi_anak') ?? $kia_anak->status_gizi_anak) == 'Gizi Buruk(GB)' ? 'selected' : '' }}>Gizi Buruk(GB)</option>
									<option value="Stunting (S)" {{ (old('status_gizi_anak') ?? $kia_anak->status_gizi_anak) == 'Stunting (S)' ? 'selected' : '' }}>Stunting (S)</option>
								</select>

								@error('status_gizi_anak')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="umur" class="col-sm-3 col-form-label">Umur dalam Bulan<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="number"
									class="form-control form-control-sm @error('umur') is-invalid @enderror"
									name="umur"
									id="umur"
									placeholder="Umur dalam Bulan"
									value="{{ old('umur') ?? $kia_anak->umur }}" readonly>

								@error('umur')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="hasil_status_tikar" class="col-sm-3 col-form-label">Hasil Status Tikar<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<select class="form-select form-select-sm @error('hasil_status_tikar') is-invalid @enderror" id="hasil_status_tikar" name="hasil_status_tikar">
									<option value="">-- Pilih --</option>
									<option value="Tidak Diukur (D)" {{ (old('hasil_status_tikar') ?? $kia_anak->hasil_status_tikar) == 'Tidak Diukur (D)' ? 'selected' : '' }}>Tidak Diukur (D)</option>
									<option value="Merah (M)" {{ (old('hasil_status_tikar') ?? $kia_anak->hasil_status_tikar) == 'Merah (M)' ? 'selected' : '' }}>Merah (M)</option>
									<option value="Kuning (K)" {{ (old('hasil_status_tikar') ?? $kia_anak->hasil_status_tikar) == 'Kuning (K)' ? 'selected' : '' }}>Kuning (K)</option>
									<option value="Hijau (H)" {{ (old('hasil_status_tikar') ?? $kia_anak->hasil_status_tikar) == 'Hijau (H)' ? 'selected' : '' }}>Hijau (H)</option>
								</select>

								@error('hasil_status_tikar')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="imunisasi_campak" class="col-sm-3 col-form-label">Imunisasi Campak<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<select class="form-select form-select-sm @error('imunisasi_campak') is-invalid @enderror" id="imunisasi_campak" name="imunisasi_campak">
									<option value="">-- Pilih --</option>
									<option value="0" {{ (old('imunisasi_campak') ?? $kia_anak->imunisasi_campak) == '0' ? 'selected' : '' }}>Belum</option>
									<option value="1" {{ (old('imunisasi_campak') ?? $kia_anak->imunisasi_campak) == '1' ? 'selected' : '' }}>Sudah</option>
								</select>

								@error('imunisasi_campak')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<div class="form-group row" id="berat_badan">
							<label for="berat_badan" class="col-sm-3 col-form-label">Berat Badan<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="number"
									class="form-control form-control-sm @error('berat_badan') is-invalid @enderror"
									name="berat_badan"
									placeholder="Berat Badan (kg)"
									value="{{ old('berat_badan') ?? $kia_anak->berat_badan }}">

								@error('berat_badan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<div class="form-group row" id="tinggi_badan">
							<label for="tinggi_badan" class="col-sm-3 col-form-label">Tinggi Badan<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="number"
									class="form-control form-control-sm @error('tinggi_badan') is-invalid @enderror"
									name="tinggi_badan"
									placeholder="Tinggi Badan (cm)"
									value="{{ old('tinggi_badan') ?? $kia_anak->tinggi_badan }}">

								@error('tinggi_badan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<br>

						<strong>Indikator Layanan:</strong>

						<div class="form-group row mt-2">
							<div class="col-sm d-flex gap-2">
								<input type="checkbox" name="imunisasi_dasar" id="imunisasi_dasar" {{ (old('imunisasi_dasar') ?? $kia_anak->imunisasi_dasar) ? 'checked' : '' }}>
								<label for="imunisasi_dasar">Imunisasi Dasar</label>
							</div>

							<div class="col-sm d-flex gap-2">
								<input type="checkbox" name="pengukuran_berat_badan" id="pengukuran_berat_badan" {{ (old('pengukuran_berat_badan') ?? $kia_anak->pengukuran_berat_badan) ? 'checked' : '' }}>
								<label for="pengukuran_berat_badan">Pengukuran Berat Badan</label>
							</div>

							<div class="col-sm d-flex gap-2">
								<input type="checkbox" name="pengukuran_tinggi_badan" id="pengukuran_tinggi_badan" {{ (old('pengukuran_tinggi_badan') ?? $kia_anak->pengukuran_tinggi_badan) ? 'checked' : '' }}>
								<label for="pengukuran_tinggi_badan">Pengukuran Tinggi Badan</label>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm d-flex gap-2">
								<input type="checkbox" name="konseling_gizi_ayah" id="konseling_gizi_ayah" {{ (old('konseling_gizi_ayah') ?? $kia_anak->konseling_gizi_ayah) ? 'checked' : '' }}>
								<label for="konseling_gizi_ayah">Konseling Gizi Ayah</label>
							</div>

							<div class="col-sm d-flex gap-2">
								<input type="checkbox" name="konseling_gizi_ibu" id="konseling_gizi_ibu" {{ (old('konseling_gizi_ibu') ?? $kia_anak->konseling_gizi_ibu) ? 'checked' : '' }}>
								<label for="konseling_gizi_ibu">Konseling Gizi Ayah</label>
							</div>

							<div class="col-sm d-flex gap-2">
								<input type="checkbox" name="kunjungan_rumah" id="kunjungan_rumah" {{ (old('kunjungan_rumah') ?? $kia_anak->kunjungan_rumah) ? 'checked' : '' }}>
								<label for="kunjungan_rumah">Kunjungan Rumah</label>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm d-flex gap-2">
								<input type="checkbox" name="akses_air_bersih" id="akses_air_bersih" {{ (old('akses_air_bersih') ?? $kia_anak->akses_air_bersih) ? 'checked' : '' }}>
								<label for="akses_air_bersih">Kepemilikan Akses Air Bersih</label>
							</div>

							<div class="col-sm d-flex gap-2">
								<input type="checkbox" name="kepemilikan_jamban" id="kepemilikan_jamban" {{ (old('kepemilikan_jamban') ?? $kia_anak->kepemilikan_jamban) ? 'checked' : '' }}>
								<label for="kepemilikan_jamban">Kepemilikan Jamban Sehat</label>
							</div>

							<div class="col-sm d-flex gap-2">
								<input type="checkbox" name="akta_lahir" id="akta_lahir" {{ (old('akta_lahir') ?? $kia_anak->akta_lahir) ? 'checked' : '' }}>
								<label for="akta_lahir">Akta Lahir</label>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-4 d-flex gap-2">
								<input type="checkbox" name="jaminan_kesehatan" id="jaminan_kesehatan" {{ (old('jaminan_kesehatan') ?? $kia_anak->jaminan_kesehatan) ? 'checked' : '' }}>
								<label for="jaminan_kesehatan">Jaminan Kesehatan</label>
							</div>

							<div class="col-sm-4 d-flex gap-2">
								<input type="checkbox" name="pengasuhan_paud" id="pengasuhan_paud" {{ (old('pengasuhan_paud') ?? $kia_anak->pengasuhan_paud) ? 'checked' : '' }}>
								<label for="pengasuhan_paud">Pengasuhan (PAUD)</label>
							</div>
						</div>

						<br>
			
						<div class="d-sm-flex justify-content-md-end">
							<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Ubah Data Pemantauan Anak</button>
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
	function fetchTanggalLahir(nik) {
		return fetch(`/staf/kependudukan/penduduk/get-data/tanggal-lahir/${nik}`)
			.then(function (response) {
				if (!response.ok) {
					throw new Error('Gagal mendapatkan tanggal lahir!');
				}
				return response.json();
			})
			.then(function (data) {
				return data.tanggal_lahir;
			});
	}

	function updateUmurField() {
		var selectedKia = document.getElementById('id_kia');
		var umurInput = document.getElementById('umur');

		// Get the selected KIA object
		var selectedOption = selectedKia.options[selectedKia.selectedIndex];
		var selectedNik = selectedOption.getAttribute('nik');

		// Fetch the birthdate from the Penduduk model
		fetchTanggalLahir(selectedNik)
			.then(function (data) {
				// Calculate and set the age in months
				var tanggal_lahir = new Date(data);
				var now = new Date();
				var ageInMonths = (now.getFullYear() - tanggal_lahir.getFullYear()) * 12 + (now.getMonth() - tanggal_lahir.getMonth());
				umurInput.value = ageInMonths;
		});
	}

	if ($('#pengukuran_berat_badan').is(':checked')) {
		$('#berat_badan').show();
	} else {
		$('#berat_badan').hide();
	}

	if ($('#pengukuran_tinggi_badan').is(':checked')) {
		$('#tinggi_badan').show();
	} else {
		$('#tinggi_badan').hide();
	}

	$(document).ready(function() {
		$('#id_kia').select2({theme: "bootstrap-5"});
		$('#id_posyandu').select2({theme: "bootstrap-5"});

		$('#pengukuran_berat_badan').on('change', function() {
			if ($(this).is(':checked')) {
				$('#berat_badan').slideDown();
			} else {
				$('#berat_badan').slideUp();
			}
		});

		$('#pengukuran_tinggi_badan').on('change', function() {
			if ($(this).is(':checked')) {
				$('#tinggi_badan').slideDown();
			} else {
				$('#tinggi_badan').slideUp();
			}
		});
	});
</script>

@endsection