@extends('layouts/userFormMain')

@section('form')

@php
    $translatedMonths = [
        'Januari' => 'January',
        'Februari' => 'February',
        'Maret' => 'March',
        'April' => 'April',
        'Mei' => 'May',
        'Juni' => 'June',
        'Juli' => 'July',
        'Agustus' => 'August',
        'September' => 'September',
        'Oktober' => 'October',
        'November' => 'November',
        'Desember' => 'December',
    ];
    
    $data['tanggal_surat'] = strtr($data['tanggal_surat'], $translatedMonths);
	$data['tanggal_lahir'] = strtr($data['tanggal_lahir'], $translatedMonths);
	$data['tanggal_lahir_ortu'] = strtr($data['tanggal_lahir_ortu'], $translatedMonths);

	$penghasilan_ortu = preg_replace('/[^0-9]/', '', $data['penghasilan_ortu_num']);
	$penghasilan_ortu = (float) $penghasilan_ortu;
@endphp

<link rel="stylesheet" href="{{ asset('css/letterNameAutoComplete.css') }}">

<div class="row mt-3 container">
	<div class="col-lg">
		<form action="/staf/layanan-surat/arsip-surat/edit-surat/{{ $surat->id }}/{{ $surat->filename }}" autocomplete="off" method="POST" id="form">
			@method('put')
			@csrf
			<div class="form-group row">
				<label for="no" class="col-sm-3 col-form-label">Nomor Surat</label>
				<div class="col-sm-7 autocomplete" style="position: relative; display: inline-block">
					<input type="number" 
						class="form-control form-control-sm @error('no_surat') is-invalid @enderror"
						name="no_surat"
						id="no"
						placeholder="1"
						value="{{ old('no_surat') ?? $data['no_surat'] }}"
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
						value="{{ old('tanggal_surat') ?? \Carbon\Carbon::createFromFormat('jS F Y', $data['tanggal_surat'])->format('Y-m-d') }}"
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
						value="{{ old('nama') ?? $data['nama'] }}"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="jenis_kelamin" name="jenis_kelamin" required>
						<option value="">-- Pilih --</option>
						<option value="L" {{ (old('jenis_kelamin') ?? $data['jenis_kelamin']) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
						<option value="P" {{ (old('jenis_kelamin') ?? $data['jenis_kelamin']) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
						value="{{ old('tempat_lahir') ?? $data['tempat_lahir'] }}"
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
						value="{{ old('tanggal_lahir') ?? \Carbon\Carbon::createFromFormat('jS F Y', $data['tanggal_lahir'])->format('Y-m-d') }}"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="agama" class="col-sm-3 col-form-label">Agama</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="agama" name="id_agama" required>
						<option value="">-- Pilih --</option>
						@foreach ($agama as $item)
						<option value="{{ $loop->iteration }}"
							{{ (old('id_agama') == $loop->iteration ||
							(old('id_agama') == null && $data['agama'] == ucwords(strtolower($item->nama)))) ?
							'selected' : '' }}>

							{{ ucwords(strtolower($item->nama)) }}
						</option>
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
							<option value="{{ $loop->iteration }}"
								{{ (old('id_pekerjaan') == $loop->iteration ||
								(old('id_pekerjaan') == null && $data['pekerjaan'] == ucwords(strtolower($item->nama)))) ?
								'selected' : '' }}>
								
								{{ ucwords(strtolower($item->nama)) }}
							</option>
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
						value="{{ old('alamat') ?? $data['alamat'] }}"
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
						value="{{ old('nama_ortu') ?? $data['nama_ortu'] }}"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="jenis_kelamin_ortu" class="col-sm-3 col-form-label">Jenis Kelamin Orang Tua</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="jenis_kelamin_ortu" name="jenis_kelamin_ortu" required>
						<option value="">-- Pilih --</option>
						<option value="L" {{ (old('jenis_kelamin_ortu') ?? $data['jenis_kelamin_ortu']) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
						<option value="P" {{ (old('jenis_kelamin_ortu') ?? $data['jenis_kelamin_ortu']) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
						value="{{ old('tempat_lahir_ortu') ?? $data['tempat_lahir_ortu'] }}"
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
						value="{{ old('tanggal_lahir_ortu') ?? \Carbon\Carbon::createFromFormat('jS F Y', $data['tanggal_lahir_ortu'])->format('Y-m-d') }}"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="agama_ortu" class="col-sm-3 col-form-label">Agama Orang Tua</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="agama_ortu" name="id_agama" required>
						<option value="">-- Pilih --</option>
						@foreach ($agama as $item)
						<option value="{{ $loop->iteration }}"
							{{ (old('id_agama_ortu') == $loop->iteration ||
							(old('id_agama_ortu') == null && $data['agama_ortu'] == ucwords(strtolower($item->nama)))) ?
							'selected' : '' }}>

							{{ ucwords(strtolower($item->nama)) }}
						</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="pekerjaan_ortu" class="col-sm-3 col-form-label">Pekerjaan Orang Tua</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm pekerjaan_input" id="pekerjaan_ortu" name="id_pekerjaan" required>
						<option value="">-- Pilih --</option>
						@foreach ($pekerjaan as $item)
							<option value="{{ $loop->iteration }}"
								{{ (old('id_pekerjaan_ortu') == $loop->iteration ||
								(old('id_pekerjaan_ortu') == null && $data['pekerjaan_ortu'] == ucwords(strtolower($item->nama)))) ?
								'selected' : '' }}>
								
								{{ ucwords(strtolower($item->nama)) }}
							</option>
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
						value="{{ old('alamat_ortu') ?? $data['alamat_ortu'] }}"
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
							value="{{ old('penghasilan_ortu') ?? $penghasilan_ortu }}"
							required>
					</div>
				</div>
			</div>

			<br>

			<div class="form-group row">
				<label for="staf" class="col-sm-3 col-form-label">Ditandatangani Oleh</label>
				<div class="col-sm-7">
					<select class="form-select form-select-sm" id="staf" name="id_staf" required>
						<option value="">-- Pilih --</option>
						@foreach ($staf as $item)
							<option value="{{ $loop->iteration }}"
								{{ old('id_staf') == $loop->iteration ||
								(old('id_staf') == null && $data['id_staf'] == $item->id) ? 
								'selected' : '' }}>
								{{ $item->jabatan.' - '.$item->nama }}
							</option>
						@endforeach
					</select>
				</div>

				<div class="col-sm-2 form-check">
					<input class="form-check-input"
						type="checkbox"
						id="diwakilkan"
						name="diwakilkan"
						{{ isset($data['id_staf_an']) ? 'checked' : '' }}>
					<label class="form-check-label" for="flexCheckDefault">
						Diwakilkan
					</label>
				</div>
			</div>

			<div class="form-group row" id="divAtasNama">
				<label for="staf_an" class="col-sm-3 col-form-label">Atas Nama</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="staf_an" name="id_staf_an">
						<option value="">-- Pilih --</option>
						@foreach ($staf as $item)
							<option value="{{ $loop->iteration }}"
								{{ old('id_staf_an') == $loop->iteration || 
								(old('id_staf_an') == null && ($data['id_staf_an'] ?? null) == $item->id) ?
								'selected' : '' }}>
								{{ $item->jabatan.' - '.$item->nama }}
							</option>
						@endforeach
					</select>
				</div>
			</div>

			<input type="text" name="id_tipe" value="{{ $id_tipe }}" hidden>
			<input type="text" name="tipe" value="{{ $tipe }}" hidden>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Ubah Surat</button>
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

	if (!$('#diwakilkan').is(':checked')) {
        $('#divAtasNama').hide();
    }

	$('#diwakilkan').change(function() {
		if (this.checked) {
			$('#divAtasNama').slideDown();
			$('#staf_an').prop('disabled', false);
		} else {
			$('#divAtasNama').slideUp();
			$('#staf_an').prop('disabled', true);
		}
	});
</script>

@endsection