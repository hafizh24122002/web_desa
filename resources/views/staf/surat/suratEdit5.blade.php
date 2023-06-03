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
	$data['tanggal_kegiatan'] = strtr($data['tanggal_kegiatan'], $translatedMonths);
	$data['tanggal_ttd'] = strtr($data['tanggal_ttd'], $translatedMonths);
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
				<label for="nik" class="col-sm-3 col-form-label">NIK</label>
				<div class="col-sm-9 autocomplete" style="position: relative; display: inline-block">
					<input type="text" 
						class="form-control form-control-sm"
						name="nik"
						id="nik"
						placeholder="1903051234567890"
						value="{{ old('nik') ?? $data['nik'] }}"
						required>
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
				<label for="kewarganegaraan" class="col-sm-3 col-form-label">Kewarganegaraan</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm pekerjaan_input" id="kewarganegaraan" name="id_kewarganegaraan">
						<option value="">-- Pilih --</option>
						@foreach ($kewarganegaraan as $item)
							<option value="{{ $loop->iteration }}"
								{{ old('id_kewarganegaraan') == $loop->iteration ||
								(old('id_kewarganegaraan') == null && $data['kewarganegaraan'] == $item->nama) ? 'selected' : '' }}>
								
								{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<br>

			<div class="form-group row">
				<label for="kegiatan" class="col-sm-3 col-form-label">Nama Kegiatan</label>
				<div class="col-sm-9 autocomplete" style="position: relative; display: inline-block">
					<input type="text" 
						class="form-control form-control-sm"
						name="kegiatan"
						id="kegiatan"
						placeholder="Acara Resepsi Pernikahan"
						value="{{ old('kegiatan') ?? $data['kegiatan'] }}"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="tanggal_kegiatan" class="col-sm-3 col-form-label">Tanggal Kegiatan</label>
				<div class="col-sm-9">
					<input type="date"
						class="form-control form-control-sm"
						name="tanggal_kegiatan"
						id="tanggal_kegiatan"
						value="{{ old('tanggal_kegiatan') ?? \Carbon\Carbon::createFromFormat('jS F Y', $data['tanggal_kegiatan'])->format('Y-m-d') }}"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="waktu" class="col-sm-3 col-form-label">Waktu Kegiatan</label>
				<div class="col-sm-9 d-inline-flex align-items-top gap-4">
					<div style="width: 5.5rem">
						<input type="time"
							class="form-control form-control-sm"
							name="start_time"
							value="{{ old('start_time') ?? $data['start_time'] }}"
							required>
					</div>

					<div>s/d</div>

					<div style="width: 5.5rem">
						<input type="time"
							class="form-control form-control-sm"
							name="finish_time"
							id="finish_time"
							value="{{ old('finish_time') ?? $data['finish_time'] }}"
							required>
					</div>
			</div>

			<div class="form-group row">
				<label for="tempat_kegiatan" class="col-sm-3 col-form-label">Tempat Kegiatan</label>
				<div class="col-sm-9 autocomplete" style="position: relative; display: inline-block">
					<input type="text" 
						class="form-control form-control-sm"
						name="tempat_kegiatan"
						id="tempat_kegiatan"
						placeholder="Jl. Merpati no. 51 RT. 03 RW. 02"
						value="{{ old('tempat_kegiatan') ?? $data['tempat_kegiatan'] }}"
						required>
				</div>
			</div>

			<br>

			<div class="form-group row">
				<label for="tanggal_ttd" class="col-sm-3 col-form-label">Tanggal Ditandatangani</label>
				<div class="col-sm-9 autocomplete" style="position: relative; display: inline-block">
					<input type="date" 
						class="form-control form-control-sm"
						name="tanggal_ttd"
						id="tanggal_ttd"
						value="{{ old('tanggal_ttd') ?? now()->toDateString('Y-m-d') }}"
						required>
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

	$('#finish_time_unspecified').click(function() {
		console.log("Checkbox clicked!");
      if ($(this).is(':checked')) {
        $('#finish_time').prop('readonly', true);
        $('#finish_time').prop('required', false);
      } else {
        $('#finish_time').prop('readonly', false);
        $('#finish_time').prop('required', true);
      }
    });
</script>

@endsection