@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                {{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
                'title' => 'Ubah Peta Wilayah',
                'current_page' => 'Ubah Peta Wilayah',
                ])

                {{-- content --}}

				<div class="box box-info">
					<div class="box-header with-border">
						<a href="{{ route('desa.petaWilayah') }}"
							class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
							title="Ubah Peta Wilayah"><i class="fa fa-arrow-left"></i>
							Kembali ke Peta Wilayah</a>
					</div>

					<div class="box-body">
						<div class="row mt-3 container">
							<form action="/staf/info-desa/identitas-desa/wilayah/update" method="POST" enctype="multipart/form-data">
								@method('put')
								@csrf

								<div>
									<div class="form-group row mb-2 mt-2">
										<label class="col-lg-4 fw-bold">GeoJSON koordinat poligon wilayah<span style="color:red">*</span></label>
										<input type="file" class="form-control form-control-sm col-lg @error('geojson') is-invalid @enderror" id="geojson" name="geojson" aria-label="Upload" accept=".geojson" required>
						
										@error('geojson')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>

									<br>

									<div class="form-group row mb-2">
										<label for="koordinat" class="col-lg-4 fw-bold">Koordinat tengah wilayah</label>
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
													placeholder="13.4">
						
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