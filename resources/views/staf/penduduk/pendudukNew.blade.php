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
            <form id="pendudukForm" action="/staf/kependudukan/penduduk/new-penduduk/{{ $type }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="tanggal_lapor" class="col-sm-3 col-form-label">Tanggal Lapor<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control form-control-sm 	@error('tanggal_lapor') is-invalid @enderror"
                            name="tanggal_lapor" placeholder="Tanggal Lapor" value="{{ old('tanggal_lapor') ?? \Carbon\Carbon::now()->toDateString() }}">

                        @error('tanggal_lapor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                @if ($type === 'masuk')
                    <div class="form-group row mb-4">
                        <label for="tanggal_peristiwa" class="col-sm-3 col-form-label">Tanggal Pindah Masuk<span style="color:red">*</span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm 	@error('tanggal_peristiwa') is-invalid @enderror"
                                name="tanggal_peristiwa" placeholder="Tanggal Pindah Masuk" value="{{ old('tanggal_peristiwa') ?? \Carbon\Carbon::now()->toDateString() }}">

                            @error('tanggal_peristiwa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                @endif

                <div class="form-group row mt-4">
                    <label for="judul" class="col-sm-3 col-form-label">DATA DIRI</label>
                    <hr>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('nama') is-invalid @enderror"
                            name="nama" placeholder="Nama" value="{{ old('nama') }}">

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
                            name="nik" value="{{ old('nik') }}" placeholder="NIK">

                        @error('nik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="no_kk_sebelumnya" class="col-sm-3 col-form-label">No. Kartu Keluarga</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('no_kk_sebelumnya') is-invalid @enderror"
                            name="no_kk_sebelumnya" placeholder="Nomor KK" value="{{ old('no_kk_sebelumnya') }}">

                        @error('no_kk_sebelumnya')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_hubungan_kk" class="col-sm-3 col-form-label">Status hubungan dalam KK<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('id_hubungan_kk') is-invalid @enderror" name="id_hubungan_kk">
                            <option value="" selected>-- Pilih Status hubungan dalam KK--</option>
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
                        <select class="form-select form-select-sm grup-input" name="id_wilayah_rt">
                            <option value="1">TODO</option> 
                        </select>
                    </div>
                </div> --}}

                <div class="form-group row">
                    <label for="id_jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('id_jenis_kelamin') is-invalid @enderror" name="id_jenis_kelamin">
                            <option value="" selected>-- Pilih Jenis Kelamin--</option>
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

                <div class="form-group row">
                    <label for="id_agama" class="col-sm-3 col-form-label">Agama<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('id_agama') is-invalid @enderror" name="id_agama">
                            <option value="" selected>-- Pilih Agama--</option>
                            @foreach ($agama as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_agama') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_agama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="penduduk_tetap" class="col-sm-3 col-form-label">Status Penduduk<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('penduduk_tetap') is-invalid @enderror" name="penduduk_tetap">
                            <option value="" selected>-- Pilih Status Penduduk--</option>
                            <option value="1">TETAP</option>
                            <option value="0">TIDAK TETAP</option>
                        </select>
                        @error('penduduk_tetap')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="judul" class="col-sm-3 col-form-label">DATA KELAHIRAN</label>
                    <hr>
                </div>

                <div class="form-group row">
                    <label for="akta_lahir" class="col-sm-3 col-form-label">No. Akta Lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('akta_lahir') is-invalid @enderror"
                            name="akta_lahir" placeholder="Nomor Akta Lahir" value="{{ old('akta_lahir') }}">

                        @error('akta_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('tempat_lahir') is-invalid @enderror"
                            name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">

                        @error('tempat_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control form-control-sm 	@error('tanggal_lahir') is-invalid @enderror"
                            name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">

                        @error('tanggal_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="waktu_lahir" class="col-sm-3 col-form-label">Waktu Lahir</label>
                    <div class="col-sm-9">
                        <input type="time" class="form-control form-control-sm 	@error('tanggal_lahir') is-invalid @enderror"
                            name="waktu_lahir" placeholder="Isi Waktu Lahir" value="{{ old('waktu_lahir') }}"-field>

                        @error('waktu_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tempat_dilahirkan" class="col-sm-3 col-form-label">Tempat Dilahirkan</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input" name="tempat_dilahirkan">
                            <option value="" selected>-- Pilih Tempat Dilahirkan--</option>
                            @foreach (\App\Models\Penduduk::TEMPAT_LAHIR as $key => $value)
                                <option value="{{ $key }}"
                                    {{ old('tempat_dilahirkan') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jenis_kelahiran" class="col-sm-3 col-form-label">Jenis Kelahiran</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input" name="jenis_kelahiran">
                            <option value="" selected>-- Pilih Jenis Kelahiran--</option>
                            @foreach (\App\Models\Penduduk::JENIS_KELAHIRAN as $key => $value)
                                <option value="{{ $key }}"
                                    {{ old('jenis_kelahiran') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="kelahiran_anak_ke" class="col-sm-3 col-form-label">Anak Ke</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control form-control-sm 	@error('kelahiran_anak_ke') is-invalid @enderror"
                            name="kelahiran_anak_ke" placeholder="Isi dengan angka" value="{{ old('kelahiran_anak_ke') }}">

                        @error('kelahiran_anak_ke')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="penolong_kelahiran" class="col-sm-3 col-form-label">Penolong Kelahiran</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input" name="penolong_kelahiran">
                            <option value="" selected>-- Pilih Penolong Kelahiran--</option>
                            @foreach (\App\Models\Penduduk::PENOLONG_KELAHIRAN as $key => $value)
                                <option value="{{ $key }}"
                                    {{ old('penolong_kelahiran') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="berat_lahir" class="col-sm-3 col-form-label">Berat Lahir (gram)</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control form-control-sm 	@error('berat_lahir') is-invalid @enderror"
                            name="berat_lahir" placeholder="Isi dengan angka" value="{{ old('berat_lahir') }}">

                        @error('berat_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="panjang_lahir" class="col-sm-3 col-form-label">Panjang Lahir (cm)</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control form-control-sm 	@error('panjang_lahir') is-invalid @enderror"
                            name="panjang_lahir" placeholder="Isi dengan angka" value="{{ old('panjang_lahir') }}">

                        @error('panjang_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="judul" class="col-sm-3 col-form-label">PENDIDIKAN DAN PEKERJAAN</label>
                    <hr>
                </div>
                
                <div class="form-group row">
                    <label for="id_pendidikan_terakhir" class="col-sm-3 col-form-label">Pendidikan Dalam KK<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('id_pendidikan_terakhir') is-invalid @enderror" name="id_pendidikan_terakhir">
                            <option value="" selected>-- Pilih Pendidikan Dalam KK--</option>
                            @foreach ($pendidikan_terakhir as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_pendidikan_terakhir') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_pendidikan_terakhir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pendidikan_saat_ini" class="col-sm-3 col-form-label">Pendidikan Sedang Ditempuh<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('id_pendidikan_saat_ini') is-invalid @enderror" name="id_pendidikan_saat_ini">
                            <option value="" selected>-- Pilih Pendidikan Sedang Ditempuh--</option>
                            @foreach ($pendidikan_saat_ini as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_pendidikan_saat_ini') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_pendidikan_saat_ini')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input pekerjaan_input @error('id_pekerjaan') is-invalid @enderror" name="id_pekerjaan">
                            <option value="" selected>-- Pilih Pekerjaan--</option>
                            @foreach ($pekerjaan as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_pekerjaan') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_pekerjaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="judul" class="col-sm-3 col-form-label">DATA KEWARGANEGARAAN</label>
                    <hr>
                </div>

                <div class="form-group row">
                    <label for="id_kewarganegaraan" class="col-sm-3 col-form-label">Kewarganegaraan<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('id_kewarganegaraan') is-invalid @enderror" name="id_kewarganegaraan">
                            <option value="" selected>-- Pilih Kewarganegaraan--</option>
                            @foreach ($kewarganegaraan as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_kewarganegaraan') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kewarganegaraan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dokumen_pasport" class="col-sm-3 col-form-label">No. Paspor</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('dokumen_pasport') is-invalid @enderror"
                            name="dokumen_pasport" placeholder="Nomor Paspor" value="{{ old('dokumen_pasport') }}">

                        @error('dokumen_pasport')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal_akhir_paspor" class="col-sm-3 col-form-label">Tanggal Berakhir Paspor</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control form-control-sm 	@error('tanggal_akhir_paspor') is-invalid @enderror"
                            name="tanggal_akhir_paspor" placeholder="Isi dengan nomor paspor" value="{{ old('tanggal_akhir_paspor') }}">

                        @error('tanggal_akhir_paspor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dokumen_kitas" class="col-sm-3 col-form-label">No. KITAS</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('dokumen_kitas') is-invalid @enderror"
                            name="dokumen_kitas" placeholder="Nomor KITAS" value="{{ old('dokumen_kitas') }}">

                        @error('dokumen_kitas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="negara_asal" class="col-sm-3 col-form-label">Negara Asal</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('negara_asal') is-invalid @enderror"
                            name="negara_asal" placeholder="Negara Asal" value="{{ old('negara_asal') }}">

                        @error('negara_asal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="judul" class="col-sm-3 col-form-label">DATA ORANG TUA</label>
                    <hr>
                </div>

                <div class="form-group row">
                    <label for="nik_ayah" class="col-sm-3 col-form-label">NIK Ayah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('nik_ayah') is-invalid @enderror"
                            name="nik_ayah" value="{{ old('nik_ayah') }}" placeholder="NIK Ayah">

                        @error('nik_ayah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_ayah" class="col-sm-3 col-form-label">Nama Ayah<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('nama_ayah') is-invalid @enderror"
                            name="nama_ayah" placeholder="Nama Ayah" value="{{ old('nama_ayah') }}">

                        @error('nama_ayah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nik_ibu" class="col-sm-3 col-form-label">NIK Ibu</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('nik_ibu') is-invalid @enderror"
                            name="nik_ibu" value="{{ old('nik_ibu') }}" placeholder="NIK Ibu">

                        @error('nik_ibu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_ibu" class="col-sm-3 col-form-label">Nama Ibu<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('nama_ibu') is-invalid @enderror"
                            name="nama_ibu" placeholder="Nama Ibu" value="{{ old('nama_ibu') }}">

                        @error('nama_ibu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="judul" class="col-sm-3 col-form-label">ALAMAT</label>
                    <hr>
                </div>

                <div class="form-group row">
                    <label for="id_wilayah_dusun" class="col-sm-3 col-form-label">Dusun<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('id_wilayah_dusun') is-invalid @enderror" name="id_wilayah_dusun"-field>
                            <option value="" selected>-- Pilih Dusun--</option>
                            @foreach ($wilayah_dusun as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_wilayah_dusun') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_wilayah_dusun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_wilayah_rt" class="col-sm-3 col-form-label">RT<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('id_wilayah_rt') is-invalid @enderror" name="id_wilayah_rt"-field>
                            <option value="" selected>-- Pilih RT--</option>
                            @foreach ($wilayah_rt as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_wilayah_rt') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_wilayah_rt')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat_sebelumnya" class="col-sm-3 col-form-label">Alamat Sebelumnya<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('alamat_sebelumnya') is-invalid @enderror"
                            name="alamat_sebelumnya" placeholder="Alamat Sebelumnya" value="{{ old('alamat_sebelumnya') }}"-field>

                        @error('alamat_sebelumnya')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat_sekarang" class="col-sm-3 col-form-label">Alamat Sekarang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('alamat_sekarang') is-invalid @enderror"
                            name="alamat_sekarang" placeholder="Alamat Sekarang" value="{{ old('alamat_sekarang') }}">

                        @error('alamat_sekarang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="telepon" class="col-sm-3 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-9">
                        <input type="tel" class="form-control form-control-sm 	@error('telepon') is-invalid @enderror"
                            name="telepon" placeholder="Nomor Telepon" value="{{ old('telepon') }}">

                        @error('telepon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="judul" class="col-sm-3 col-form-label">STATUS PERKAWINAN</label>
                    <hr>
                </div>
                
                <div class="form-group row">
                    <label for="id_status_perkawinan" class="col-sm-3 col-form-label">Status Perkawinan<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('id_status_perkawinan') is-invalid @enderror" name="id_status_perkawinan"-field>
                            <option value="" selected>-- Pilih Status Perkawinan--</option>
                            @foreach ($status_perkawinan as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_status_perkawinan') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_status_perkawinan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="akta_perkawinan" class="col-sm-3 col-form-label">No. Akta/Buku Nikah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('akta_perkawinan') is-invalid @enderror"
                            name="akta_perkawinan" placeholder="Isi dengan nomor akta nikah" value="{{ old('akta_perkawinan') }}">

                        @error('akta_perkawinan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal_perkawinan" class="col-sm-3 col-form-label">Tanggal Perkawinan</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control form-control-sm 	@error('tanggal_perkawinan') is-invalid @enderror"
                            name="tanggal_perkawinan" placeholder="Isi dengan nomor paspor" value="{{ old('tanggal_perkawinan') }}">

                        @error('tanggal_perkawinan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="akta_perceraian" class="col-sm-3 col-form-label">No. Akta Perceraian</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('akta_perceraian') is-invalid @enderror"
                            name="akta_perceraian" placeholder="Isi dengan nomor akta perceraian" value="{{ old('akta_perceraian') }}">

                        @error('akta_perceraian')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal_perceraian" class="col-sm-3 col-form-label">Tanggal Perceraian</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control form-control-sm 	@error('tanggal_perceraian') is-invalid @enderror"
                            name="tanggal_perceraian" placeholder="Isi dengan tanggal perceraian" value="{{ old('tanggal_perceraian') }}">

                        @error('tanggal_perceraian')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="judul" class="col-sm-3 col-form-label">DATA KESEHATAN</label>
                    <hr>
                </div>

                <div class="form-group row">
                    <label for="id_golongan_darah" class="col-sm-3 col-form-label">Golongan Darah<span
                            style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('id_golongan_darah') is-invalid @enderror" name="id_golongan_darah"-field>
                            <option value="" selected>-- Pilih --</option>
                            @foreach ($golongan_darah as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_golongan_darah') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_golongan_darah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_cacat" class="col-sm-3 col-form-label">Cacat</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('id_cacat') is-invalid @enderror" name="id_cacat">
                            <option value="" selected>-- Pilih --</option>
                            @foreach ($cacat as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_cacat') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_cacat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_sakit_menahun" class="col-sm-3 col-form-label">Sakit Menahun</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('id_sakit_menahun') is-invalid @enderror" name="id_sakit_menahun">
                            <option value="" selected>-- Pilih --</option>
                            @foreach ($sakit_menahun as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_sakit_menahun') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_sakit_menahun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_cara_kb" class="col-sm-3 col-form-label">Akseptor KB</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('id_cara_kb') is-invalid @enderror" name="id_cara_kb">
                            <option value="" selected>-- Pilih --</option>
                            @foreach ($cara_kb as $item)
                                <option value="{{ $loop->iteration }}"
                                    {{ old('id_cara_kb') == $loop->iteration ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_cara_kb')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_asuransi" class="col-sm-3 col-form-label">Asuransi Kesehatan</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input @error('id_asuransi') is-invalid @enderror" name="id_asuransi">
                            <option value="" selected>-- Pilih --</option>
                            @foreach ($asuransi as $item)
                                <option value="{{ $loop->iteration }}">
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_asuransi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="no_asuransi" class="col-sm-3 col-form-label">No. Asuransi Kesehatan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('no_asuransi') is-invalid @enderror"
                            name="no_asuransi" placeholder="No. Asuransi Kesehatan" value="{{ old('no_asuransi') }}">

                        @error('no_asuransi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bpjs_ketenagakerjaan" class="col-sm-3 col-form-label">No. BPJS Ketenagakerjaan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm 	@error('bpjs_ketenagakerjaan') is-invalid @enderror"
                            name="bpjs_ketenagakerjaan" placeholder="No. BPJS Ketenagakerjaan" value="{{ old('bpjs_ketenagakerjaan') }}">

                        @error('bpjs_ketenagakerjaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="alamat"
                            placeholder="JL. MERPATI NO. 51 RT.03/RW.02">
                    </div>
                </div> --}}

                {{-- <div class="form-group row">
                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm grup-input" name="status">
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
        // $(document).ready(function() {
        //     // Menggunakan jQuery untuk mendeteksi saat form disubmit
        //     $('#pendudukForm').on('submit', function(event) {
        //         // Reset semua field yang memiliki class "is-invalid" menjadi normal
        //         $('.grup-input').removeClass('is-invalid');
        //         $('.required-field').removeClass('is-invalid');

        //         // Validasi semua elemen select dengan class grup-input
        //         var selectElements = $('.grup-input');
        //         selectElements.each(function() {
        //             if ($(this).val() === '') {
        //                 $(this).addClass('is-invalid');
        //             }
        //         });

        //         // Validasi semua elemen input dengan class-field
        //         var inputElements = $('.required-field');
        //         inputElements.each(function() {
        //             if ($(this).val() === '') {
        //                 $(this).addClass('is-invalid');
        //             }
        //         });

        //         // Cek apakah ada field yang kosong
        //         if ($('.is-invalid').length > 0) {
        //             // Jika ada, batalkan submit form
        //             event.preventDefault();
        //         }
        //     });

        //     // Menggunakan jQuery untuk mendeteksi perubahan pada elemen select
        //     $('.grup-input').on('change', function() {
        //         if ($(this).val() === '') {
        //             $(this).addClass('is-invalid');
        //         } else {
        //             $(this).removeClass('is-invalid');
        //         }
        //     });

        //     // Menggunakan jQuery untuk mendeteksi perubahan pada elemen input teks
        //     $('.required-field').each('input', function() {
        //         if ($(this).val() === '') {
        //             $(this).addClass('is-invalid');
        //         } else {
        //             $(this).removeClass('is-invalid');
        //         }
        //     });
        // });
    </script>
@endsection
