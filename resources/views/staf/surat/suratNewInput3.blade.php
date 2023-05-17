@extends('layouts/userFormMain')

@section('form')

<link rel="stylesheet" href="{{ asset('css/letterNameAutoComplete.css') }}">

<div class="row mt-3 container">
	<div class="col-lg">
		<form action="/staf/layanan-surat/buat-surat/submit" autocomplete="off" method="POST" id="form">
			@csrf
			<div class="form-group row">
				<label for="no" class="col-sm-3 col-form-label">Nomor Surat</label>
				<div class="col-sm-7 autocomplete" style="position: relative; display: inline-block">
					<input type="number" 
						class="form-control form-control-sm @error('no_surat') is-invalid @enderror"
						name="no_surat"
						id="no"
						placeholder="1"
						value="{{ old('no_surat') ?? $nomorTerakhir }}"
						required
						readonly>

					@error('no_surat')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="col-sm-2">
					<div class="btn btn-warning btn-sm w-100 d-inline-flex align-items-center justify-content-center gap-2 overflow-hidden"
						id="edit_no_surat">
						<i class='bx bx-edit'></i> Ubah
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label for="tanggal_surat" class="col-sm-3 col-form-label">Tanggal Surat</label>
				<div class="col-sm-9">
					<input type="date"
						class="form-control form-control-sm"
						name="tanggal_surat"
						id="tanggal_surat"
						value="{{ now()->toDateString('Y-m-d') }}"
						required>
				</div>
			</div>

			<br>

			<div class="form-group row">
				<label for="nama" class="col-sm-3 col-form-label">Nama</label>
				<div class="col-sm-9 autocomplete" style="position: relative; display: inline-block">
					<input type="text" 
						class="form-control form-control-sm"
						name="nama"
						id="nama"
						placeholder="Andi"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="jenis_kelamin" name="jenis_kelamin" required>
						<option value="">-- Pilih --</option>
						<option value="L">Laki-Laki</option>
						<option value="P">Perempuan</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="tempat_lahir"
						id="tempat_lahir"
						placeholder="Bangka Selatan"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
				<div class="col-sm-9">
					<input type="date"
						class="form-control form-control-sm"
						name="tanggal_lahir"
						id="tanggal_lahir"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="agama" class="col-sm-3 col-form-label">Agama</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="agama" name="id_agama" required>
						<option value="">-- Pilih --</option>
						@foreach ($agama as $item)
							<option value="{{ $loop->iteration }}">{{ ucwords(strtolower($item->nama)) }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm pekerjaan_input" id="pekerjaan" name="id_pekerjaan" required>
						<option value="">-- Pilih --</option>
						@foreach ($pekerjaan as $item)
							<option value="{{ $loop->iteration }}">{{ ucwords(strtolower($item->nama)) }}</option>
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
						id="alamat"
						placeholder="Jl. Merpati no. 51"
						required>
				</div>
			</div>

			<br>

			<div class="form-group row">
				<label for="nama" class="col-sm-3 col-form-label">Nama Orang Tua</label>
				<div class="col-sm-9 autocomplete" style="position: relative; display: inline-block">
					<input type="text" 
						class="form-control form-control-sm"
						name="nama_ortu"
						id="nama_ortu"
						placeholder="Andi"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="jenis_kelamin_ortu" class="col-sm-3 col-form-label">Jenis Kelamin Orang Tua</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="jenis_kelamin_ortu" name="jenis_kelamin_ortu" required>
						<option value="">-- Pilih --</option>
						<option value="L">Laki-Laki</option>
						<option value="P">Perempuan</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="tempat_lahir_ortu" class="col-sm-3 col-form-label">Tempat Lahir Orang Tua</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="tempat_lahir_ortu"
						id="tempat_lahir_ortu"
						placeholder="Bangka Selatan"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="tanggal_lahir_ortu" class="col-sm-3 col-form-label">Tanggal Lahir Orang Tua</label>
				<div class="col-sm-9">
					<input type="date"
						class="form-control form-control-sm"
						name="tanggal_lahir_ortu"
						id="tanggal_lahir_ortu"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="agama_ortu" class="col-sm-3 col-form-label">Agama Orang Tua</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="agama_ortu" name="id_agama_ortu" required>
						<option value="">-- Pilih --</option>
						@foreach ($agama as $item)
							<option value="{{ $loop->iteration }}">{{ ucwords(strtolower($item->nama)) }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="pekerjaan_ortu" class="col-sm-3 col-form-label">Pekerjaan Orang Tua</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm pekerjaan_input" id="pekerjaan_ortu" name="id_pekerjaan_ortu" required>
						<option value="">-- Pilih --</option>
						@foreach ($pekerjaan as $item)
							<option value="{{ $loop->iteration }}">{{ ucwords(strtolower($item->nama)) }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="alamat_ortu" class="col-sm-3 col-form-label">Alamat Orang Tua</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="alamat_ortu"
						id="alamat_ortu"
						placeholder="Jl. Merpati no. 51"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="penghasilan_ortu" class="col-sm-3 col-form-label">Penghasilan Orang Tua</label>
				<div class="col-sm-9">
					<div class="input-group input-group-sm">
						<span class="input-group-text">Rp</span>
						<input type="text"
							class="form-control"
							name="penghasilan_ortu"
							id="penghasilan_ortu"
							placeholder="3500000"
							required>
					</div>
				</div>
			</div>

			<input type="text" name="id_tipe" value="{{ $id_tipe }}" hidden>
			<input type="text" name="tipe" value="{{ $tipe }}" hidden>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Buat Surat</button>
			</div>
		</form>
	</div>
</div>

@include('partials.commonScripts')
<script src="{{ asset('js/autocomplete.js') }}"></script>

<script>
	pendudukList = @json($penduduk);
	autocomplete(document.getElementById("nama"), pendudukList);

	var $input = $("#no");
	var $button = $("#edit_no_surat");

	$button.on("click", function() {
		if ($input.prop("readonly")) {
			$input.prop("readonly", false);
			$button.prop("readonly", true).text("Simpan");
		} else {
			$input.prop("readonly", true);
			$button.prop("readonly", false).empty().append("<i class='bx bx-edit'></i> Ubah");
		}
	});
</script>

@endsection