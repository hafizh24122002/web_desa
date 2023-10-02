@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                {{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
                'title' => 'Ubah Lokasi Kantor Desa',
                'current_page' => 'Ubah Lokasi Kantor Desa',
                ])

                {{-- content --}}

				<div class="box box-info">
					<div class="box-header with-border">
						<a href="{{ route('desa.kantorDesa') }}"
							class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
							title="kembali"><i class="fa fa-arrow-left"></i>
							Kembali ke Lokasi Kantor Desa</a>
					</div>

					<div class="box-body">
						<div class="row mt-3 container">
							<form action="/staf/info-desa/identitas-desa/kantor/update" method="POST" enctype="multipart/form-data">
								@method('put')
								@csrf

								<div>
									<div class="form-group row mb-2 mt-2">
										<label for="koordinat" class="col-lg-4 fw-bold">Koordinat kantor desa</label>
										<div class="col-lg-8 d-inline-flex align-items-center gap-4 p-0">
											<div style="col-auto">
												<label for="koordinat">Latitude</label>
												<input class="form-control @error('lat') is-invalid @enderror"
													name="lat"
													value="{{ old('lat') }}"
													placeholder="-2.5143220643393005">
						
												@error('lat')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
											</div>
						
											<div style="col-auto">
												<label for="koordinat">Longitude</label>
												<input class="form-control @error('lng') is-invalid @enderror"
													name="lng"
													value="{{ old('lng') }}"
													placeholder="106.11670285770147">
						
												@error('lng')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
											</div>

											<div style="col-auto">
												<label for="koordinat">Zoom</label>
												<input class="form-control @error('zoom') is-invalid @enderror"
													name="zoom"
													value="{{ old('zoom') }}"
													placeholder="17">
						
												@error('zoom')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
											</div>
										</div>
									</div>
								</div>

								<div class="mt-3 gap-2 d-flex justify-content-end p-0">
									<a href="{{ route('desa.data') }}" class="btn btn-secondary">Batal</a>
									<button type="submit" class="btn btn-primary">Ubah</button>
								</div>
							</form>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</section>

@include('partials.commonScripts')

@endsection