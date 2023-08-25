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
    $data['tanggal_kegiatan'] = strtr($data['tanggal_kegiatan'], $translatedMonths);

	$dateTime = \DateTime::createFromFormat('H:i T', $data['finish_time']);
	$finish_time = $dateTime->format('H:i');
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
				<label for="nama" class="col-sm-3 col-form-label">Kepada Yth.</label>
				<div class="col-sm-9 autocomplete" style="position: relative; display: inline-block">
					<input type="text" 
						class="form-control form-control-sm"
						name="nama"
						id="nama"
						placeholder="Andi"
						value="{{ old('nama') ?? $data['nama'] }}">
				</div>
			</div>

			<div class="form-group row">
				<label for="no" class="col-sm-3 col-form-label">Hari Jadi Ke</label>
				<div class="col-sm-7" style="position: relative; display: inline-block">
					<input type="number" 
						class="form-control form-control-sm"
						name="hari_jadi_num"
						id="hari_jadi_num"
						placeholder="20"
						value="{{ old('hari_jadi_num') ?? $data['hari_jadi_num'] }}"
						required
						readonly>
				</div>

				<div class="col-sm-2">
					<div class="btn btn-warning btn-sm w-100 d-inline-flex align-items-center justify-content-center gap-2 overflow-hidden"
						id="edit_hari_jadi">
						<i class='bx bx-edit'></i> Ubah
					</div>
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
				<div class="col-sm d-inline-flex align-items-top gap-4">
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
							value="{{ old('finish_time') ?? $finish_time }}"
							required>
					</div>

					{{-- <div style="width: 5.5rem d-flex-inline">
						<input type="checkbox"
							class="form-check-input"
							name="finish_time_unspecified"
							id="finish_time_unspecified">
						<label class="form-check-label ms-2" for="finish_time_unspecified">
							Sampai Selesai
						</label>
					</div> --}}
				</div>
			</div>
			
			<div class="form-group row">
				<label for="tempat_kegiatan" class="col-sm-3 col-form-label">Tempat</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="tempat_kegiatan"
						id="tempat_kegiatan"
						placeholder="Balai Desa Malik"
						value="{{ old('tempat_kegiatan') ?? $data['tempat_kegiatan'] }}"
						required>
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

	var $input = $("#hari_jadi_num");
	var $button = $("#edit_hari_jadi");

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