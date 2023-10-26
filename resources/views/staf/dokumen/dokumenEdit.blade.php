@extends('layouts/userFormMain')

@section('form')

<div class="row mt-3 container">
	<div class="col-lg">
		<form action="/staf/manajemen-web/dokumen/edit-dokumen/{{ $dokumen->id }}" method="POST" enctype="multipart/form-data">
		@method('put')	
		@csrf
			<div class="form-group row">
				<label for="judul" class="col-sm-2 col-form-label">Judul<span style="color:red">*</span></label>
				<div class="col-sm-10">
					<input type="text"
						class="form-control form-control-sm  @error('judul') is-invalid @enderror"
						id="judul"
						name="judul"
						placeholder="Judul Dokumen"
						value="@if(null!==old('judul')){{old('judul')}}@else{{$dokumen->judul}}@endif"
                        required>

						@error('judul')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="keterangan" class="col-sm-2 col-form-label">Keterangan<span style="color:red">*</span></label>
				<div class="col-sm-10">
					<input type="text"
						class="form-control form-control-sm  @error('keterangan') is-invalid @enderror"
						id="keterangan"
						name="keterangan"
						placeholder="Isi Keterangan Dokumen"
						value="@if(null!==old('keterangan')){{old('keterangan')}}@else{{$dokumen->keterangan}}@endif"
                        required>

						@error('keterangan')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="filename" class="col-sm-2 col-form-label">Unggah File<span style="color:red">*</span></label>
				<div class="col-sm-10">
					<input type="file" 
						class="form-control form-control-sm @error('filename') is-invalid @enderror"
						name="filename"
						placeholder="filename" 
						value="@if(null!==old('filename')){{old('filename')}}@else{{$dokumen->filename}}@endif"
						accept=".doc,.docx,.pdf"
						required>
					
					@error('filename')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="is_active" class="col-sm-2 col-form-label">Status Dokumen</label>
				<div class="col-sm-10 d-flex align-items-center gap-2">
					<input class="form-check-input"
						type="checkbox"
						id="is_active"
						name="is_active"
						value="1"
						{{ $dokumen->is_active == 1 ? 'checked' : '' }}>
					<label class="form-check-label" for="flexCheckDefault">
						Aktif
					</label>
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Ubah Dokumen</button>
			</div>
			<input type="hidden" name="form_reached_controller" value="1">
		</form>
	</div>
</div>

@endsection