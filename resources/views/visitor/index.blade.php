@extends('layouts/visitorMain')

@section('header')
    <div class="main-content-header">
        <!-- Carousel wrapper -->
        <div id="visitorCarousel" class="carousel slide shadow" data-mdb-interval="6000" data-mdb-ride="carousel" data-mdb-carousel-init>
            <!-- Indicators -->
            <div class="carousel-indicators">
                @foreach ($banner as $item)
                    <button
                        type="button"
                        data-mdb-target="#visitorCarousel"
                        data-mdb-slide-to="{{ $item->no_urut - 1 }}"
                        class="active"
                        aria-current="true"
                        aria-label="Slide {{ $item->no_urut }}"
                    ></button>
                @endforeach
            </div>
            
            <!-- Inner -->
            <div class="carousel-inner">
                <!-- Single item -->
                @foreach ($banner as $item)
                    <div class="carousel-item @if($item->no_urut === 1) active @endif">
                        <img src="{{ asset('storage/'.$item->image->path) }}" class="d-block w-100" style="height: 100%; width: 100%; object-fit: cover"/>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $item->judul }}</h5>
                            <p>{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Inner -->
            
            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-mdb-target="#visitorCarousel" data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-mdb-target="#visitorCarousel" data-mdb-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- Carousel wrapper -->
    </div>
@endsection

@section('main-content')

<div class="container mt-5">
    {{-- ARTIKEL --}}
    <div class="d-flex align-items-center justify-content-between" data-aos="fade-up">
        <h1 class="float-start">Artikel Terbaru</h1>

        @if ($artikel_count > 4)
            <a href="#" class="text-reset">
                <h4 class="text-muted">Lihat artikel lainnya <i class="fas fa-angle-right ms-2"></i></h4>
            </a>
        @endif
    </div>

    <div class="row mb-5">
        @if ($artikel->count() > 0)
            @foreach ($artikel as $index => $item)
                <div class="col-lg-3 mt-2">
                    <a href="/artikel/{{ $item->judul }}" class="card shadow artikel-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <img src="{{ asset('storage/'.$item->cover->path) }}" class="card-img-top" style="max-height: 220px; object-fit: cover"/>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $item->judul }}</h5>
                            <p class="card-subtitle mb-2 text-muted"><em>{{ $item->staf->nama }}</em> - {{ $item->updated_at->translatedFormat('jS F Y') }}</p>
                            <p class="card-text artikel-text" data-content="{!! htmlspecialchars($item->isi) !!}"></p>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <div class="mt-2">
                <div class="card shadow" data-aos="fade-up">
                    <div class="card-body">
                        <div class="row g-0 align-items-center">
                            <div class="col-lg-3 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    width="220"
                                    height="220"
                                    viewBox="0 0 24 24"
                                    style="fill: rgb(183, 233, 255);transform: ;msFilter:;">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
                                    <path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path>
                                </svg>
                            </div>
                            <div class="col-lg-9 align-items-center">
                                <h5 class="card-title fw-bold">Artikel tidak tersedia</h5>
                                <p class="card-text">Tidak ada artikel yang tersedia saat ini, mohon coba lagi nanti.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- ARTIKEL END --}}

    {{-- DOKUMEN --}}
    <div class="d-flex align-items-center justify-content-between" style="margin-top: 100px" data-aos="fade-up">
        <h1 class="float-start">Dokumen Publik Terbaru</h1>

        <a href="/dokumen" class="text-reset">
            <h4 class="text-muted">Lihat semua dokumen <i class="fas fa-angle-right ms-2"></i></h4>
        </a>

    </div>

    <div class="row mb-5">
        @if ($dokumen->count() > 0)
            @foreach ($dokumen as $index => $item)
                <div class="col-md-6 mt-2">
                    <div class="card shadow" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $item->judul }}</h5>
                            <p class="card-subtitle mb-2 text-muted"><em>{{ $item->staf->nama }}</em> - {{ $item->updated_at->translatedFormat('jS F Y') }}</p>
                            <p class="card-text">{{ $item->keterangan }}</p>
                            <a href="/dokumen/download/{{ $item->judul }}" class="btn btn-primary rounded-pill float-end" data-mdb-ripple-init>Download</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="mt-2">
                <div class="card shadow" data-aos="fade-up">
                    <div class="card-body">
                        <div class="row g-0 align-items-center">
                            <div class="col-lg-3 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    width="220"
                                    height="220"
                                    viewBox="0 0 24 24"
                                    style="fill: rgb(183, 233, 255);transform: ;msFilter:;">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
                                    <path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path>
                                </svg>
                            </div>
                            <div class="col-lg-9 align-items-center">
                                <h5 class="card-title fw-bold">Dokumen tidak tersedia</h5>
                                <p class="card-text">Tidak ada dokumen publik yang tersedia saat ini, mohon coba lagi nanti.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- DOKUMEN END --}}

    {{-- AGENDA --}}
    <div class="d-flex align-items-center justify-content-between" style="margin-top: 100px" data-aos="fade-up">
        <h1 class="float-start">Agenda Desa</h1>
    </div>

    <div class="mb-5">
        <!-- Tabs navs -->
        <ul class="nav nav-pills mb-3" id="agendaTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link rounded-pill active" id="upcoming-tab" data-bs-toggle="tab" href="#upcoming" role="tab" aria-controls="upcoming" aria-selected="true" data-aos="fade-up">Yang akan datang</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link rounded-pill" id="past-tab" data-bs-toggle="tab" href="#past" role="tab" aria-controls="past" aria-selected="false" data-aos="fade-up" data-aos-delay="50">Sudah lewat</a>
            </li>
        </ul>

        <div class="tab-content" id="agendaTabContent" data-aos="fade-up" data-aos-delay="100">
            <div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                <table class="table table-hover">
                    <thead>
                        <tr class="bg-dark text-center align-middle">
                            <th>Judul</th>
                            <th>Waktu</th>
                            <th>Lokasi</th>
                            <th>Koordinator</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($upcomingAgenda->count() > 0)
                            @foreach ($upcomingAgenda as $agenda)
                                <tr>
                                    <td>{{ $agenda->judul }}</td>
                                    <td>{{ $agenda->tgl_agenda }}</td>
                                    <td>{{ $agenda->lokasi }}</td>
                                    <td>{{ $agenda->koordinator }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center fst-italic">Tidak ada agenda</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="past" role="tabpanel" aria-labelledby="past-tab">
                <table class="table table-hover">
                    <thead>
                        <tr class="bg-dark text-light text-center align-middle">
                            <th>Judul</th>
                            <th>Waktu</th>
                            <th>Lokasi</th>
                            <th>Koordinator</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pastAgenda->count() > 0)
                            @foreach ($pastAgenda as $agenda)
                                <tr>
                                    <td>{{ $agenda->judul }}</td>
                                    <td>{{ $agenda->tgl_agenda }}</td>
                                    <td>{{ $agenda->lokasi }}</td>
                                    <td>{{ $agenda->koordinator }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center fst-italic">Tidak ada agenda</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Tabs content -->
    </div>
    {{-- AGENDA END --}}
</div>

@endsection

@section('peta')
<div class="container-fluid bg-dark text-light" style="margin-top: 100px" data-aos="fade-up">
    <div class="container">
        <div class="col-lg-12">
            <div class="d-flex align-items-center justify-content-between mt-5" data-aos="fade-up">
                <h1 class="float-start">Peta Wilayah Desa</h1>
            </div>
    
            <div id="map" style="height: 500px;" class="mb-5 rounded-3" data-aos="fade-up"></div>
        </div>
        
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
		integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
		crossorigin=""></script>
<script>
	var map = L.map('map').setView([{{ $lat }}, {{ $lng }}], {{ $zoom }});

	// Add OpenStreetMap as a base layer
	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);

    var legend = L.control({position: 'topright'});

    legend.onAdd = function (map) {
        var div = L.DomUtil.create('div', 'info legend');

        div.innerHTML = '<h6>Desa {{ $identitas_desa->nama_desa }}</h6><a href="https://maps.app.goo.gl/pEPptYT6SfezWyCf9" class="btn btn-primary rounded-pill text-light">Buka di Google Maps</a>';

        return div;
    };

    legend.addTo(map);

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
	</script>

@endsection

@section('aparatur')

{{-- APARATUR DESA --}}
<div class="container">
    <div class="d-flex align-items-center justify-content-between mt-5" style="margin-top: 100px" data-aos="fade-up">
        <h1 class="float-start">Aparatur Desa</h1>
    </div>

    <div class="mb-5">
        <div class="aparatur-carousel">
            @foreach ($staf as $index => $item)
                <div class="mx-3 mb-5">
                    <div class="card shadow" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <img src="{{ asset('storage/images/artikel/artikel_placeholder.png') }}" class="card-img-top" style="max-height: 220px; object-fit: cover"/>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $item->nama }}</h5>
                            <p class="card-subtitle mb-2 text-muted"><em>{{ $item->jabatan }}</em></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
{{-- APARATUR DESA END --}}

@endsection