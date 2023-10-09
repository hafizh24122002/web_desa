@extends('layouts/adminMain')

@section('main-content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="row mt-3 container">
				<div class="col-lg">
					<form action="/staf/kesehatan/pemantauan/edit-sasaran-paud/{{ $sasaran_paud->id }}" method="POST">
						@method('put')
						@csrf
			
						<div class="form-group row">
							<label for="id_kia" class="col-sm-3 col-form-label">Nomor KIA<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<select class="form-select form-select-sm @error('id_kia') is-invalid @enderror" id="id_kia" name="id_kia" onchange="updateUmurField()">
									<option value="">-- Pilih --</option>
									@foreach ($kia as $item)
										<option value="{{ $item->id }}" {{ old('id_kia') ?? $sasaran_paud->id_kia == $item->id ? 'selected' : '' }} nik="{{ $item->anak->nik }}">{{ $item->no_kia.' - '.$item->anak->nama }}</option>
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
									value="{{ old('tanggal_periksa') ?? $sasaran_paud->tanggal_periksa->format('Y-m-d') }}">

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
										<option value="{{ $loop->iteration }}" {{ old('id_posyandu') ?? $sasaran_paud->id_posyandu == $loop->iteration ? 'selected' : '' }}>{{ $item->nama }}</option>
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
							<label for="kategori_usia" class="col-sm-3 col-form-label">Kategori Usia<span style="color:red">*</span></label>
							<div class="col-sm-9">
								<select class="form-select form-select-sm @error('kategori_usia') is-invalid @enderror" id="kategori_usia" name="kategori_usia">
									<option value="">-- Pilih --</option>
									<option value="1" {{ (old('kategori_usia') ?? $sasaran_paud->kategori_usia) == '1' ? 'selected' : '' }}>Usia 2 - &lt;3 Tahun</option>
									<option value="2" {{ (old('kategori_usia') ?? $sasaran_paud->kategori_usia) == '2' ? 'selected' : '' }}>Usia 3 - 6 Tahun</option>
								</select>

								@error('kategori_usia')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<br>

						<div class="form-group row mt-2">
							<div class="col-sm gap-2">
								<label for="januari" class="fw-bold">Januari<span style="color:red">*</span></label>
							</div>

							<div class="col-sm gap-2">
								<label for="februari" class="fw-bold">Februari<span style="color:red">*</span></label>
							</div>

							<div class="col-sm gap-2">
								<label for="maret" class="fw-bold">Maret<span style="color:red">*</span></label>
							</div>

							<div class="col-sm gap-2">
								<label for="april" class="fw-bold">April<span style="color:red">*</span></label>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm gap-2">
								<select class="form-select form-select-sm @error('januari') is-invalid @enderror" id="januari" name="januari">
									<option value="">-- Pilih --</option>
									<option value="belum" {{ (old('januari') ?? $sasaran_paud->januari) == 'belum' ? 'selected' : '' }}>Belum</option>
									<option value="mengikuti" {{ (old('januari') ?? $sasaran_paud->januari) == 'mengikuti' ? 'selected' : '' }}>Mengikuti</option>
									<option value="tidak mengikuti" {{ (old('januari') ?? $sasaran_paud->januari)== 'tidak mengikuti' ? 'selected' : '' }}>Tidak Mengikuti</option>
								</select>

								@error('januari')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>

							<div class="col-sm gap-2">
								<select class="form-select form-select-sm @error('februari') is-invalid @enderror" id="februari" name="februari">
									<option value="">-- Pilih --</option>
									<option value="belum" {{ (old('februari') ?? $sasaran_paud->februari) == 'belum' ? 'selected' : '' }}>Belum</option>
									<option value="mengikuti" {{ (old('februari') ?? $sasaran_paud->februari) == 'mengikuti' ? 'selected' : '' }}>Mengikuti</option>
									<option value="tidak mengikuti" {{ (old('februari') ?? $sasaran_paud->februari) == 'tidak mengikuti' ? 'selected' : '' }}>Tidak Mengikuti</option>
								</select>

								@error('februari')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>

							<div class="col-sm gap-2">
								<select class="form-select form-select-sm @error('maret') is-invalid @enderror" id="maret" name="maret">
									<option value="">-- Pilih --</option>
									<option value="belum" {{ (old('maret') ?? $sasaran_paud->maret) == 'belum' ? 'selected' : '' }}>Belum</option>
									<option value="mengikuti" {{ (old('maret') ?? $sasaran_paud->maret) == 'mengikuti' ? 'selected' : '' }}>Mengikuti</option>
									<option value="tidak mengikuti" {{ (old('maret') ?? $sasaran_paud->maret) == 'tidak mengikuti' ? 'selected' : '' }}>Tidak Mengikuti</option>
								</select>

								@error('maret')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>

							<div class="col-sm gap-2">
								<select class="form-select form-select-sm @error('april') is-invalid @enderror" id="april" name="april">
									<option value="">-- Pilih --</option>
									<option value="belum" {{ (old('april') ?? $sasaran_paud->april) == 'belum' ? 'selected' : '' }}>Belum</option>
									<option value="mengikuti" {{ (old('april') ?? $sasaran_paud->april) == 'mengikuti' ? 'selected' : '' }}>Mengikuti</option>
									<option value="tidak mengikuti" {{ (old('april') ?? $sasaran_paud->april) == 'tidak mengikuti' ? 'selected' : '' }}>Tidak Mengikuti</option>
								</select>

								@error('april')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<div class="form-group row mt-2">
							<div class="col-sm gap-2">
								<label for="mei" class="fw-bold">Mei<span style="color:red">*</span></label>
							</div>

							<div class="col-sm gap-2">
								<label for="juni" class="fw-bold">Juni<span style="color:red">*</span></label>
							</div>

							<div class="col-sm gap-2">
								<label for="juli" class="fw-bold">Juli<span style="color:red">*</span></label>
							</div>

							<div class="col-sm gap-2">
								<label for="agustus" class="fw-bold">Agustus<span style="color:red">*</span></label>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm gap-2">
								<select class="form-select form-select-sm @error('mei') is-invalid @enderror" id="mei" name="mei">
									<option value="">-- Pilih --</option>
									<option value="belum" {{ (old('mei') ?? $sasaran_paud->mei) == 'belum' ? 'selected' : '' }}>Belum</option>
									<option value="mengikuti" {{ (old('mei') ?? $sasaran_paud->mei) == 'mengikuti' ? 'selected' : '' }}>Mengikuti</option>
									<option value="tidak mengikuti" {{ (old('mei') ?? $sasaran_paud->mei) == 'tidak mengikuti' ? 'selected' : '' }}>Tidak Mengikuti</option>
								</select>

								@error('mei')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>

							<div class="col-sm gap-2">
								<select class="form-select form-select-sm @error('juni') is-invalid @enderror" id="juni" name="juni">
									<option value="">-- Pilih --</option>
									<option value="belum" {{ (old('juni') ?? $sasaran_paud->juni) == 'belum' ? 'selected' : '' }}>Belum</option>
									<option value="mengikuti" {{ (old('juni') ?? $sasaran_paud->juni) == 'mengikuti' ? 'selected' : '' }}>Mengikuti</option>
									<option value="tidak mengikuti" {{ (old('juni') ?? $sasaran_paud->juni) == 'tidak mengikuti' ? 'selected' : '' }}>Tidak Mengikuti</option>
								</select>

								@error('juni')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>

							<div class="col-sm gap-2">
								<select class="form-select form-select-sm @error('juli') is-invalid @enderror" id="juli" name="juli">
									<option value="">-- Pilih --</option>
									<option value="belum" {{ (old('juli') ?? $sasaran_paud->juli) == 'belum' ? 'selected' : '' }}>Belum</option>
									<option value="mengikuti" {{ (old('juli') ?? $sasaran_paud->juli) == 'mengikuti' ? 'selected' : '' }}>Mengikuti</option>
									<option value="tidak mengikuti" {{ (old('juli') ?? $sasaran_paud->juli) == 'tidak mengikuti' ? 'selected' : '' }}>Tidak Mengikuti</option>
								</select>

								@error('juli')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>

							<div class="col-sm gap-2">
								<select class="form-select form-select-sm @error('agustus') is-invalid @enderror" id="agustus" name="agustus">
									<option value="">-- Pilih --</option>
									<option value="belum" {{ (old('agustus') ?? $sasaran_paud->agustus) == 'belum' ? 'selected' : '' }}>Belum</option>
									<option value="mengikuti" {{ (old('agustus') ?? $sasaran_paud->agustus) == 'mengikuti' ? 'selected' : '' }}>Mengikuti</option>
									<option value="tidak mengikuti" {{ (old('agustus') ?? $sasaran_paud->agustus) == 'tidak mengikuti' ? 'selected' : '' }}>Tidak Mengikuti</option>
								</select>

								@error('agustus')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<div class="form-group row mt-2">
							<div class="col-sm gap-2">
								<label for="september" class="fw-bold">September<span style="color:red">*</span></label>
							</div>

							<div class="col-sm gap-2">
								<label for="oktober" class="fw-bold">Oktober<span style="color:red">*</span></label>
							</div>

							<div class="col-sm gap-2">
								<label for="november" class="fw-bold">November<span style="color:red">*</span></label>
							</div>

							<div class="col-sm gap-2">
								<label for="desember" class="fw-bold">Desember<span style="color:red">*</span></label>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm gap-2">
								<select class="form-select form-select-sm @error('september') is-invalid @enderror" id="september" name="september">
									<option value="">-- Pilih --</option>
									<option value="belum" {{ (old('september') ?? $sasaran_paud->september) == 'belum' ? 'selected' : '' }}>Belum</option>
									<option value="mengikuti" {{ (old('september') ?? $sasaran_paud->september) == 'mengikuti' ? 'selected' : '' }}>Mengikuti</option>
									<option value="tidak mengikuti" {{ (old('september') ?? $sasaran_paud->september) == 'tidak mengikuti' ? 'selected' : '' }}>Tidak Mengikuti</option>
								</select>

								@error('september')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>

							<div class="col-sm gap-2">
								<select class="form-select form-select-sm @error('oktober') is-invalid @enderror" id="oktober" name="oktober">
									<option value="">-- Pilih --</option>oktober
									<option value="belum" {{ (old('oktober') ?? $sasaran_paud->oktober) == 'belum' ? 'selected' : '' }}>Belum</option>
									<option value="mengikuti" {{ (old('oktober') ?? $sasaran_paud->oktober) == 'mengikuti' ? 'selected' : '' }}>Mengikuti</option>
									<option value="tidak mengikuti" {{ (old('oktober') ?? $sasaran_paud->oktober) == 'tidak mengikuti' ? 'selected' : '' }}>Tidak Mengikuti</option>
								</select>

								@error('oktober')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>

							<div class="col-sm gap-2">
								<select class="form-select form-select-sm @error('november') is-invalid @enderror" id="november" name="november">
									<option value="">-- Pilih --</option>
									<option value="belum" {{ (old('november') ?? $sasaran_paud->november) == 'belum' ? 'selected' : '' }}>Belum</option>
									<option value="mengikuti" {{ (old('november') ?? $sasaran_paud->november) == 'mengikuti' ? 'selected' : '' }}>Mengikuti</option>
									<option value="tidak mengikuti" {{ (old('november') ?? $sasaran_paud->november) == 'tidak mengikuti' ? 'selected' : '' }}>Tidak Mengikuti</option>
								</select>

								@error('november')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>

							<div class="col-sm gap-2">
								<select class="form-select form-select-sm @error('desember') is-invalid @enderror" id="desember" name="desember">
									<option value="">-- Pilih --</option>
									<option value="belum" {{ (old('desember') ?? $sasaran_paud->desember) == 'belum' ? 'selected' : '' }}>Belum</option>
									<option value="mengikuti" {{ (old('desember') ?? $sasaran_paud->desember) == 'mengikuti' ? 'selected' : '' }}>Mengikuti</option>
									<option value="tidak mengikuti" {{ (old('desember') ?? $sasaran_paud->desember) == 'tidak mengikuti' ? 'selected' : '' }}>Tidak Mengikuti</option>
								</select>

								@error('desember')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<br>
			
						<div class="d-sm-flex justify-content-md-end">
							<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Ubah Data Sasaran PAUD Anak</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>


@include('partials.commonScripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endsection