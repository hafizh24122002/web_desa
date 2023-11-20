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
		<form action="/staf/kependudukan/penduduk/edit-penduduk/{{ $penduduk->nik }}" method="POST">
			@method('put')
			@csrf

			<div class="form-group row">
                <label for="judul" class="col-sm-3 col-form-label">DATA DIRI</label>
                <hr>
            </div>

			<div class="form-group row">
				<label for="nama" class="col-sm-3 col-form-label">Nama<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text" 
						class="form-control form-control-sm @error('nama') is-invalid @enderror"
						name="nama"
						placeholder="NAMA" 
						value="@if(null!==old('nama')){{old('nama')}}@else{{$penduduk->nama}}@endif"
						required>
					
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
					<input type="text"
						class="form-control form-control-sm @error('nik') is-invalid @enderror"
						name="nik"
						value="@if(null!==old('nik')){{old('nik')}}@else{{$penduduk->nik}}@endif"
						placeholder="1903051234567890"
						required>
					
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
					<input type="text"
						class="form-control form-control-sm @error('no_kk_sebelumnya') is-invalid @enderror"
						name="no_kk_sebelumnya"
						value="@if(null!==old('no_kk_sebelumnya')){{old('no_kk_sebelumnya')}}@else{{$penduduk->no_kk_sebelumnya}}@endif"
						placeholder="1903051234567890">
					
					@error('no_kk_sebelumnya')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="hubungan_kk" class="col-sm-3 col-form-label">Status hubungan dalam KK<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="id_hubungan_kk">
						<option value="">-- Pilih --</option>
						@foreach ($hubungan_kk as $item)
							<option value="{{ $loop->iteration }}" {{ old('id_hubungan_kk', $penduduk->id_hubungan_kk) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="id_jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="id_jenis_kelamin">
						<option value="">-- Pilih --</option>
						@foreach ($jenis_kelamin as $item)
							<option value="{{ $loop->iteration }}" {{ old('id_jenis_kelamin', $penduduk->id_jenis_kelamin) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="agama" class="col-sm-3 col-form-label">Agama<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="id_agama">
						<option value="">-- Pilih --</option>
						@foreach ($agama as $item)
							<option value="{{ $loop->iteration }}" {{ old('id_agama', $penduduk->id_agama) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="penduduk_tetap" class="col-sm-3 col-form-label">Status Penduduk<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm grup-input" id="grup-input" name="penduduk_tetap">
                        <option value="">-- Pilih Status Penduduk--</option>
						<option value="1" {{ old('penduduk_tetap', $penduduk->penduduk_tetap) == "1" ? "selected":"" }}>TETAP</option>
						<option value="0" {{ old('penduduk_tetap', $penduduk->penduduk_tetap) == "0" ? "selected":"" }}>TIDAK TETAP</option>
                    </select>
				</div>
			</div>

			<div class="form-group row">
                <label for="judul" class="col-sm-3 col-form-label">DATA KELAHIRAN</label>
                <hr>
            </div>

			<div class="form-group row">
				<label for="akta_lahir" class="col-sm-3 col-form-label">No. Akta Lahir</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm @error('akta_lahir') is-invalid @enderror"
						name="akta_lahir"
						value="@if(null!==old('akta_lahir')){{old('akta_lahir')}}@else{{$penduduk->akta_lahir}}@endif"
						placeholder="1903051234567890">
					
					@error('akta_lahir')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir<span
                            style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="tempat_lahir"
						value="@if(null!==old('tempat_lahir')){{old('tempat_lahir')}}@else{{$penduduk->tempat_lahir}}@endif"
						placeholder="BANGKA SELATAN">

						@error('tempat_lahir')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir<span
                            style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="date"
						class="form-control form-control-sm"
						name="tanggal_lahir"
						value="@if(null!==old('tanggal_lahir')){{old('tanggal_lahir')}}@else{{$penduduk->tanggal_lahir}}@endif"
						placeholder="BANGKA SELATAN">
				</div>
			</div>

			<div class="form-group row">
				<label for="waktu_lahir" class="col-sm-3 col-form-label">Waktu Lahir</label>
				<div class="col-sm-9">
					<input type="time"
						class="form-control form-control-sm"
						value="@if(null!==old('waktu_lahir')){{old('waktu_lahir')}}@else{{$penduduk->waktu_lahir}}@endif"
						name="waktu_lahir">
				</div>
			</div>

			<div class="form-group row">
				<label for="tempat_dilahirkan" class="col-sm-3 col-form-label">Tempat Dilahirkan</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="tempat_dilahirkan">
						<option value="">-- Pilih --</option>
						@foreach (\App\Models\Penduduk::TEMPAT_LAHIR as $key => $value)
						<option value="{{ $key }}" {{ old('tempat_dilahirkan', $penduduk->tempat_dilahirkan) == $key ? "selected" : "" }}>{{ $value }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="jenis_kelahiran" class="col-sm-3 col-form-label">Jenis Kelahiran</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="jenis_kelahiran">
						<option value="">-- Pilih --</option>
						@foreach (\App\Models\Penduduk::JENIS_KELAHIRAN as $key => $value)
						<option value="{{ $key }}" {{ old('jenis_kelahiran', $penduduk->jenis_kelahiran) == $key ? "selected" : "" }}>{{ $value }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="kelahiran_anak_ke" class="col-sm-3 col-form-label">Anak Ke</label>
				<div class="col-sm-9">
					<input type="number"
						class="form-control form-control-sm"
						value="@if(null!==old('kelahiran_anak_ke')){{old('kelahiran_anak_ke')}}@else{{$penduduk->kelahiran_anak_ke}}@endif"
						name="kelahiran_anak_ke"
						placeholder="Isi dengan angka">
				</div>
			</div>

			<div class="form-group row">
				<label for="penolong_kelahiran" class="col-sm-3 col-form-label">Penolong Kelahiran</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="penolong_kelahiran">
						<option value="">-- Pilih --</option>
						@foreach (\App\Models\Penduduk::PENOLONG_KELAHIRAN as $key => $value)
						<option value="{{ $key }}" {{ old('penolong_kelahiran', $penduduk->penolong_kelahiran) == $key ? "selected" : "" }}>{{ $value }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="berat_lahir" class="col-sm-3 col-form-label">Berat Lahir (gram)</label>
				<div class="col-sm-9">
					<input type="number"
						class="form-control form-control-sm"
						value="@if(null!==old('berat_lahir')){{old('berat_lahir')}}@else{{$penduduk->berat_lahir}}@endif"
						name="berat_lahir"
						placeholder="Isi dengan angka">
				</div>
			</div>

			<div class="form-group row">
				<label for="panjang_lahir" class="col-sm-3 col-form-label">Panjang Lahir (cm)</label>
				<div class="col-sm-9">
					<input type="number"
						class="form-control form-control-sm"
						value="@if(null!==old('panjang_lahir')){{old('panjang_lahir')}}@else{{$penduduk->panjang_lahir}}@endif"
						name="panjang_lahir"
						placeholder="Isi dengan angka">
				</div>
			</div>

			<div class="form-group row">
                <label for="judul" class="col-sm-3 col-form-label">PENDIDIKAN DAN PEKERJAAN</label>
                <hr>
            </div>

			<div class="form-group row">
				<label for="id_pendidikan_terakhir" class="col-sm-3 col-form-label">Pendidikan Dalam KK<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="id_pendidikan_terakhir">
						<option value="">-- Pilih --</option>
						@foreach ($pendidikan_terakhir as $item)
							<option value="{{ $loop->iteration }}" {{ old('id_pendidikan_terakhir', $penduduk->id_pendidikan_terakhir) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="id_pendidikan_saat_ini" class="col-sm-3 col-form-label">Pendidikan Sedang Ditempuh<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="id_pendidikan_saat_ini">
						<option value="">-- Pilih --</option>
						@foreach ($pendidikan_saat_ini as $item)
							<option value="{{ $loop->iteration }}" {{ old('id_pendidikan_saat_ini', $penduduk->id_pendidikan_saat_ini) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm pekerjaan_input" id="grup-input" name="id_pekerjaan">
						<option value="">-- Pilih --</option>
						@foreach ($pekerjaan as $item)
							<option value="{{ $loop->iteration }}"{{ old('id_pekerjaan', $penduduk->id_pekerjaan) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
                <label for="judul" class="col-sm-3 col-form-label">DATA KEWARGANEGARAAN</label>
                <hr>
            </div>

			<div class="form-group row">
				<label for="kewarganegaraan" class="col-sm-3 col-form-label">Kewarganegaraan<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm pekerjaan_input" id="grup-input" name="id_kewarganegaraan">
						<option value="">-- Pilih --</option>
						@foreach ($kewarganegaraan as $item)
							<option value="{{ $loop->iteration }}" {{ old('id_kewarganegaraan', $penduduk->id_kewarganegaraan) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="dokumen_pasport" class="col-sm-3 col-form-label">No. Paspor</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm @error('dokumen_pasport') is-invalid @enderror"
						name="dokumen_pasport"
						value="@if(null!==old('dokumen_pasport')){{old('dokumen_pasport')}}@else{{$penduduk->dokumen_pasport}}@endif"
						placeholder="Isi dengan nomor paspor">
					
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
					<input type="date"
						class="form-control form-control-sm"
						name="tanggal_akhir_paspor"
						value="@if(null!==old('tanggal_akhir_paspor')){{old('tanggal_akhir_paspor')}}@else{{$penduduk->tanggal_akhir_paspor}}@endif"
						placeholder="BANGKA SELATAN">
				</div>
			</div>

			<div class="form-group row">
				<label for="dokumen_kitas" class="col-sm-3 col-form-label">No. KITAS</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm @error('dokumen_kitas') is-invalid @enderror"
						name="dokumen_kitas"
						value="@if(null!==old('dokumen_kitas')){{old('dokumen_kitas')}}@else{{$penduduk->dokumen_kitas}}@endif"
						placeholder="Isi dengan nomor KITAS">
					
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
					<input type="text"
						class="form-control form-control-sm @error('negara_asal') is-invalid @enderror"
						name="negara_asal"
						value="@if(null!==old('negara_asal')){{old('negara_asal')}}@else{{$penduduk->negara_asal}}@endif"
						placeholder="Isi dengan negara asal">
					
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
					<input type="text"
						class="form-control form-control-sm @error('nik_ayah') is-invalid @enderror"
						name="nik_ayah"
						value="@if(null!==old('nik_ayah')){{old('nik_ayah')}}@else{{$penduduk->nik_ayah}}@endif"
						placeholder="Nomor NIK Ayah">

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
					<input type="text" 
						class="form-control form-control-sm @error('nama_ayah') is-invalid @enderror"
						name="nama_ayah"
						placeholder="Nama Ayah" 
						value="@if(null!==old('nama_ayah')){{old('nama_ayah')}}@else{{$penduduk->nama_ayah}}@endif"
						required>
					
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
					<input type="text"
						class="form-control form-control-sm @error('nik_ibu') is-invalid @enderror"
						name="nik_ibu"
						value="@if(null!==old('nik_ibu')){{old('nik_ibu')}}@else{{$penduduk->nik_ayah}}@endif"
						placeholder="Nomor NIK Ibu">

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
					<input type="text" 
						class="form-control form-control-sm @error('nama_ibu') is-invalid @enderror"
						name="nama_ibu"
						placeholder="Nama Ibu" 
						value="@if(null!==old('nama_ibu')){{old('nama_ibu')}}@else{{$penduduk->nama_ibu}}@endif"
						required>
					
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
				<label for="wilayah_dusun" class="col-sm-3 col-form-label">Dusun<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm wilayah_dusun_input" id="grup-input" name="id_dusun">
						<option value="">-- Pilih --</option>
						@foreach ($wilayah_dusun as $item)
							<option value="{{ $loop->iteration }}"{{ old('id_dusun', $penduduk->id_dusun) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="wilayah_rt" class="col-sm-3 col-form-label">RT<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm wilayah_rt_input" id="grup-input" name="id_rt">
						<option value="">-- Pilih RT--</option>
						@foreach ($wilayah_rt as $item)
							<option value="{{ $loop->iteration }}"{{ old('id_rt', $penduduk->id_rt) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="alamat_sebelumnya" class="col-sm-3 col-form-label">Alamat Sebelumnya<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm @error('alamat_sebelumnya') is-invalid @enderror"
						name="alamat_sebelumnya"
						value="@if(null!==old('alamat_sebelumnya')){{old('alamat_sebelumnya')}}@else{{$penduduk->alamat_sebelumnya}}@endif"
						placeholder="Alamat Sebelumnya">

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
					<input type="text"
						class="form-control form-control-sm @error('alamat_sekarang') is-invalid @enderror"
						name="alamat_sekarang"
						value="@if(null!==old('alamat_sekarang')){{old('alamat_sekarang')}}@else{{$penduduk->alamat_sekarang}}@endif"
						placeholder="Alamat Sebelumnya">

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
					<input type="tel"
						class="form-control form-control-sm @error('telepon') is-invalid @enderror"
						name="telepon"
						value="@if(null!==old('telepon')){{old('telepon')}}@else{{$penduduk->telepon}}@endif"
						placeholder="Nomor Telepon">

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
				<label for="status_perkawinan" class="col-sm-3 col-form-label">Status Perkawinan<span
                            style="color:red">*</span></label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm pekerjaan_input" id="grup-input" name="id_status_perkawinan">
						<option value="">-- Pilih --</option>
						@foreach ($status_perkawinan as $item)
							<option value="{{ $loop->iteration }}" {{ old('id_status_perkawinan', $penduduk->id_status_perkawinan) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="akta_perkawinan" class="col-sm-3 col-form-label">No. Akta/Buku Nikah</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm @error('akta_perkawinan') is-invalid @enderror"
						name="akta_perkawinan"
						value="@if(null!==old('akta_perkawinan')){{old('akta_perkawinan')}}@else{{$penduduk->akta_perkawinan}}@endif"
						placeholder="Nomor Akta/Buku Nikah">

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
					<input type="date"
						class="form-control form-control-sm @error('tanggal_perkawinan') is-invalid @enderror"
						name="tanggal_perkawinan"
						value="@if(null!==old('tanggal_perkawinan')){{old('tanggal_perkawinan')}}@else{{$penduduk->tanggal_perkawinan}}@endif"
						placeholder="Tanggal Perkawinan">

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
					<input type="text"
						class="form-control form-control-sm @error('akta_perceraian') is-invalid @enderror"
						name="akta_perceraian"
						value="@if(null!==old('akta_perceraian')){{old('akta_perceraian')}}@else{{$penduduk->akta_perceraian}}@endif"
						placeholder="Nomor Akta Perceraian">

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
					<input type="date"
						class="form-control form-control-sm @error('tanggal_perceraian') is-invalid @enderror"
						name="tanggal_perceraian"
						value="@if(null!==old('tanggal_perceraian')){{old('tanggal_perceraian')}}@else{{$penduduk->tanggal_perceraian}}@endif"
						placeholder="Tanggal Perceraian">

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
				<label for="golongan_darah" class="col-sm-3 col-form-label">Golongan Darah<span style="color:red">*</span></label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm golongan_darah_input" id="grup-input" name="id_golongan_darah">
						<option value="">-- Pilih RT--</option>
						@foreach ($golongan_darah as $item)
							<option value="{{ $loop->iteration }}"{{ old('id_golongan_darah', $penduduk->id_golongan_darah) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="cacat" class="col-sm-3 col-form-label">Cacat</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm cacat_input" id="grup-input" name="id_cacat">
						<option value="">-- Pilih Cacat--</option>
						@foreach ($cacat as $item)
							<option value="{{ $loop->iteration }}"{{ old('id_cacat', $penduduk->id_cacat) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="sakit_menahun" class="col-sm-3 col-form-label">Sakit Menahun</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm cacat_input" id="grup-input" name="id_sakit_menahun">
						<option value="">-- Pilih Sakit Menahun--</option>
						@foreach ($sakit_menahun as $item)
							<option value="{{ $loop->iteration }}"{{ old('id_sakit_menahun', $penduduk->id_sakit_menahun) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="form-group row">
				<label for="id_cara_kb" class="col-sm-3 col-form-label">Akseptor KB</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm cara_kb_input" id="grup-input" name="id_cara_kb">
						<option value="">-- Pilih Akseptor KB--</option>
						@foreach ($cara_kb as $item)
							<option value="{{ $loop->iteration }}"{{ old('id_cara_kb', $penduduk->id_cara_kb) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="asuransi" class="col-sm-3 col-form-label">Asuransi Kesehatan</label>
				<div class="col-sm-9">
					<select class="form-select form-select-sm asuransi_input" id="grup-input" name="id_asuransi">
						<option value="">-- Pilih Asuransi Kesehatan--</option>
						@foreach ($asuransi as $item)
							<option value="{{ $loop->iteration }}"{{ old('id_asuransi', $penduduk->id_asuransi) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="no_asuransi" class="col-sm-3 col-form-label">No. Asuransi Kesehatan</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm @error('no_asuransi') is-invalid @enderror"
						name="no_asuransi"
						value="@if(null!==old('no_asuransi')){{old('no_asuransi')}}@else{{$penduduk->no_asuransi}}@endif"
						placeholder="Nomor Asuransi">
					
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
					<input type="text"
						class="form-control form-control-sm @error('bpjs_ketenagakerjaan') is-invalid @enderror"
						name="bpjs_ketenagakerjaan"
						value="@if(null!==old('bpjs_ketenagakerjaan')){{old('bpjs_ketenagakerjaan')}}@else{{$penduduk->bpjs_ketenagakerjaan}}@endif"
						placeholder="Nomor BPJS Ketenagakerjaan">
					
					@error('bpjs_ketenagakerjaan')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Ubah Data Penduduk</button>
			</div>
		</form>
	</div>
</div>

@endsection