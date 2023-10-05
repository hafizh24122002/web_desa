@extends('layouts/adminMain')

@section('main-content')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
	integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
	crossorigin=""/>

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                {{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
                'title' => 'Peta Wilayah',
                'current_page' => 'Peta Wilayah',
                ])

                {{-- content --}}
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                {{-- <a href="/staf/info-desa/wilayah-administratif/new-dusun" style="width: auto" class="btn btn-primary my-2">
                    <i class="bx bx-user-plus align-middle"></i> Tambah Data Dusun
                </a> --}}

				<div class="box box-info">
					<div class="box-header with-border">
						<a href="{{ route('desa.data') }}"
							class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
							title="kembali"><i class="fa fa-arrow-left"></i>
							Kembali ke Data Identitas Desa</a>
					</div>
					<div class="box-body">
						<div class="row mt-3 container">
							<div id="map" style="height: 500px"></div>

							<div class="mt-3 gap-2 d-flex justify-content-end p-0">
								<a href="/staf/info-desa/identitas-desa/wilayah/edit" class="btn btn-primary">Ubah Peta Wilayah</a>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</section>

@include('partials.commonScripts')

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
	integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
	crossorigin=""></script>
<script>
	var map = L.map('map').setView([{{ $lat }}, {{ $lng }}], {{ $zoom }});

	// Add OpenStreetMap as a base layer
	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);

	var cityBoundary;
    
    fetch('/get-coordinates')
        .then(function(response) {
            // Check if the response status is OK (status code 200)
           if (!response.ok) {
               throw new Error('Gagal mendapatkan koordinat wilayah!');
           }
           return response.json();
        })
        .then(function(data) {
            cityBoundary = L.geoJSON(data, {
                style: {
                    color: 'blue',
                    weight: 2,
                    opacity: 0.5,
                    fillOpacity: 0.1
                }
            }).addTo(map);
        });

	// var officeMarker = L.marker([OFFICE_LATITUDE, OFFICE_LONGITUDE]).addTo(map);
	// officeMarker.bindPopup('Office Location').openPopup();
</script>


@endsection