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
            <form id="pendudukForm" action="/staf/kependudukan/penduduk/new-penduduk" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('nama') is-invalid @enderror"
                            name="nama" placeholder="NAMA" value="{{ old('nama') }}" required-field>

                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nik" class="col-sm-3 col-form-label">NIK<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('nik') is-invalid @enderror"
                            name="nik" value="{{ old('nik') }}" placeholder="1903051234567890" required-field>

                        @error('nik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- <div class="form-group row">
                    <label for="no_kk" class="col-sm-3 col-form-label">NO. KK<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('no_kk') is-invalid @enderror"
                            name="no_kk" placeholder="NO. KK" value="{{ old('no_kk') }}" required-field>

                        @error('no_kk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div> --}}

                {{--  --}}

                <div class="form-group row">
                    <label for="id_hubungan_kk" class="col-sm-3 col-form-label">Status hubungan dalam KK<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input" id="grup-input" name="id_hubungan_kk">
                            <option value="">-- Pilih --</option>
                            @foreach ($hubungan_kk as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_hubungan_kk') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_hubungan_kk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- <div class="form-group row">
                    <label for="rt" class="col-sm-3 col-form-label">No. Rumah Tangga</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input" id="grup-input" name="id_rt">
                            <option value="1">TODO</option> 
                        </select>
                    </div>
                </div> --}}

                <div class="form-group row">
                    <label for="id_jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input" id="grup-input" name="id_jenis_kelamin">
                            <option value="">-- Pilih --</option>
                            @foreach ($jenis_kelamin as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_jenis_kelamin') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_jenis_kelamin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input" id="grup-input" name="jenis_kelamin">
                            <option value="">-- Pilih --</option>
                            <option value="L">LAKI-LAKI</option>
                            <option value="P">PEREMPUAN</option>
                        </select>
                    </div>
                </div> --}}

                <div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="tempat_lahir" required-field
                            placeholder="BANGKA SELATAN">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control form-control-sm" name="tanggal_lahir" required-field>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input" id="grup-input" name="id_agama">
                            <option value="">-- Pilih --</option>
                            @foreach ($agama as $item)
                                <option value="{{ $loop->iteration }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pendidikan_terakhir" class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input" id="grup-input" name="id_pendidikan_terakhir">
                            <option value="">-- Pilih --</option>
                            @foreach ($pendidikan_terakhir as $item)
                                <option value="{{ $loop->iteration }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pendidikan_saat_ini" class="col-sm-3 col-form-label">Pendidikan Saat Ini</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input" id="grup-input" name="id_pendidikan_saat_ini">
                            <option value="">-- Pilih --</option>
                            @foreach ($pendidikan_saat_ini as $item)
                                <option value="{{ $loop->iteration }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input pekerjaan_input" id="grup-input"
                            name="id_pekerjaan">
                            <option value="">-- Pilih --</option>
                            @foreach ($pekerjaan as $item)
                                <option value="{{ $loop->iteration }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status_perkawinan" class="col-sm-3 col-form-label">Status Perkawinan</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input pekerjaan_input" id="grup-input"
                            name="id_status_perkawinan">
                            <option value="">-- Pilih --</option>
                            @foreach ($status_perkawinan as $item)
                                <option value="{{ $loop->iteration }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kewarganegaraan" class="col-sm-3 col-form-label">Kewarganegaraan</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input pekerjaan_input" id="grup-input"
                            name="id_kewarganegaraan">
                            <option value="">-- Pilih --</option>
                            @foreach ($kewarganegaraan as $item)
                                <option value="{{ $loop->iteration }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- <div class="form-group row">
                    <label for="nik_ayah" class="col-sm-3 col-form-label">NIK Ayah<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="nik_ayah"
                            placeholder="1903051234567890" value="{{ old('nik_ayah') }}" required-field>
                        @error('nik_ayah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="form-group row">
                    <label for="nik_ibu" class="col-sm-3 col-form-label">NIK Ibu<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="nik_ibu"
                            placeholder="1903051234567890" value="{{ old('nik_ibu') }}" required-field>
                        @error('nik_ibu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div> --}}

                <div class="form-group row">
                    <label for="nama_ayah" class="col-sm-3 col-form-label">Nama Ayah<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('nama') is-invalid @enderror"
                            name="nama_ayah" placeholder="NAMA AYAH" value="{{ old('nama_ayah') }}" required-field>

                        @error('nama_ayah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_ibu" class="col-sm-3 col-form-label">Nama Ibu<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('nama') is-invalid @enderror"
                            name="nama_ibu" placeholder="NAMA IBU" value="{{ old('nama_ibu') }}" required-field>

                        @error('nama_ibu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="penduduk_status" class="col-sm-3 col-form-label">Status Penduduk</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input pekerjaan_input" id="grup-input"
                            name="id_penduduk_status">
                            <option value="">-- Pilih --</option>
                            @foreach ($penduduk_status as $item)
                                <option value="{{ $loop->iteration }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- <div class="form-group row">
                    <label for="penduduk_tetap" class="col-sm-3 col-form-label">Penduduk Tetap</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input" id="grup-input" name="penduduk_tetap">
                            <option value="">-- Pilih --</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                </div> --}}

                {{-- <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="alamat"
                            placeholder="JL. MERPATI NO. 51 RT.03/RW.02">
                    </div>
                </div> --}}

                <div class="form-group row">
                    <label for="telepon" class="col-sm-3 col-form-label">Telepon</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="telepon"
                            placeholder="081234567890">
                    </div>
                </div>

                {{-- <div class="form-group row">
                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input" id="grup-input" name="status">
                            <option value="">-- Pilih --</option>
                            <option value="1">HIDUP</option>
                            <option value="0">MATI</option>
                        </select>
                    </div>
                </div> --}}

                <div class="d-sm-flex justify-content-md-end">
                    <button class="btn btn-primary mt-2 mb-4 px-3 py-1">Tambah Data Penduduk</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Menggunakan jQuery untuk mendeteksi saat form disubmit
            $('#pendudukForm').on('submit', function(event) {
                // Reset semua field yang memiliki class "is-invalid" menjadi normal
                $('.grup-input').removeClass('is-invalid');
                $('.required-field').removeClass('is-invalid');

                // Validasi semua elemen select dengan class grup-input
                var selectElements = $('.grup-input');
                selectElements.each(function() {
                    if ($(this).val() === '') {
                        $(this).addClass('is-invalid');
                    }
                });

                // Validasi semua elemen input dengan class required-field
                var inputElements = $('.required-field');
                inputElements.each(function() {
                    if ($(this).val() === '') {
                        $(this).addClass('is-invalid');
                    }
                });

                // Cek apakah ada field yang kosong
                if ($('.is-invalid').length > 0) {
                    // Jika ada, batalkan submit form
                    event.preventDefault();
                }
            });

            // Menggunakan jQuery untuk mendeteksi perubahan pada elemen select
            $('.grup-input').on('change', function() {
                if ($(this).val() === '') {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Menggunakan jQuery untuk mendeteksi perubahan pada elemen input teks
            $('.required-field').on('input', function() {
                if ($(this).val() === '') {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
