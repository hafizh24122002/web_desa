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
						value="{{ old('tanggal_surat') ?? now()->toDateString('Y-m-d') }}"
						required>
				</div>
			</div>

			<br>

			<div class="form-group row">
				<label for="nama" class="col-sm-3 col-form-label">Nama Pemilik Usaha</label>
				<div class="col-sm-9 autocomplete" style="position: relative; display: inline-block">
					<input type="text"
						class="form-control form-control-sm"
						name="nama"
						id="nama"
						placeholder="Andi"
						value="{{ old('nama') }}"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="jenis_kelamin" name="jenis_kelamin" required>
						<option value="">-- Pilih --</option>
						<option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
						<option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
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
						value="{{ old('tempat_lahir') }}"
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
						value="{{ old('tanggal_lahir') }}"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="kebangsaan" class="col-sm-3 col-form-label">Kebangsaan</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="kebangsaan"
						id="kebangsaan"
						placeholder="Indonesia"
						value="{{ old('kebangsaan') }}"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="agama" class="col-sm-3 col-form-label">Agama</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="agama" name="id_agama" required>
						<option value="">-- Pilih --</option>
						@foreach ($agama as $item)
							<option value="{{ $item->id }}" {{ old('id_agama') == $loop->iteration ? 'selected' : '' }}>{{ ucwords(strtolower($item->nama)) }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="status_perkawinan" class="col-sm-3 col-form-label">Status</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="status_perkawinan" name="id_status_perkawinan" required>
						<option value="">-- Pilih --</option>
						@foreach ($status_perkawinan as $item)
							<option value="{{ $item->id }}" {{ old('id_status_perkawinan') == $loop->iteration ? 'selected' : '' }}>{{ ucwords(strtolower($item->nama)) }}</option>
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
							<option value="{{ $item->id }}" {{ old('id_pekerjaan') == $loop->iteration ? 'selected' : '' }}>{{ ucwords(strtolower($item->nama)) }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="alamat" class="col-sm-3 col-form-label">Alamat Usaha</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="alamat"
						placeholder="Jl. Merpati no. 51"
						value="{{ old('alamat') }}"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="dusun/rt" class="col-sm-3 col-form-label">Dusun/Rt</label>
				<div class="col-sm d-inline-flex gap-4">
					<div style="width: 7rem">
						<select class="form-select form-select-sm"
							name="dusun"
							id="dusun"
							required>

							<option value="">-- Pilih --</option>
							@foreach ($dusun as $item)
								<option value="{{ $item->id }}" {{ old('dusun') == $loop->iteration ? 'selected' : '' }}>{{ ucwords(strtolower($item->nama)) }}</option>
							@endforeach
						</select>
					</div>

					<div>/</div>

					<div style="width: 7rem">
						<select class="form-select form-select-sm"
							name="rt"
							id="rt"
							required>

							<option value="">-- Pilih --</option>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label for="usaha" class="col-sm-3 col-form-label">Nama Usaha</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="usaha"
						placeholder="Kebun Kelapa Sawit"
						value="{{ old('usaha') }}"
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
							<option value="{{ $loop->iteration }}" {{ old('id_staf') == $loop->iteration ? 'selected' : '' }}>{{ $item->jabatan.' - '.$item->nama }}</option>
						@endforeach
					</select>
				</div>

				<div class="col-sm-2 form-check">
					<input class="form-check-input" type="checkbox" id="diwakilkan" name="diwakilkan">
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
							<option value="{{ $loop->iteration }}" {{ old('id_staf_an') == $loop->iteration ? 'selected' : '' }}>{{ $item->jabatan.' - '.$item->nama }}</option>
						@endforeach
					</select>
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

<script src="{{ asset('js/autocomplete.js') }}"></script>

<script>
	$('#divAtasNama').hide();
	$('#rt').prop('disabled', true);

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

	$('#dusun').change(function() {
		if ($(this).val() !== '') {
			$('#rt').prop('disabled', false);

			var dusunId = $(this).val();
			$.ajax({
                url: '/staf/info-desa/rt/get-data/' + dusunId,
                type: 'GET',
                success: function (data) {
                    // Clear existing options in the rt dropdown
                    $('#rt').empty();
					$('#rt').append('<option value="">-- Pilih --</option>');

                    // Populate the rt dropdown with new options
                    $.each(data, function (index, rt) {
                        var option = $('<option>', {
                            value: rt.id,
                            text: rt.nama,
                            selected: rt.id == "{{ old('rt') }}"
                        });

                        $('#rt').append(option);
                    });
                }
            });
		} else {
			$('#rt').prop('disabled', true);
		}
	});

	$('#diwakilkan').change(function() {
		if (this.checked) {
			$('#divAtasNama').slideDown();
		} else {
			$('#divAtasNama').slideUp();
		}
	});
</script>

@endsection