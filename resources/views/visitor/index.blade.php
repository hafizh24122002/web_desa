@extends('layouts/visitorMain')

@section('header')
<div class="main-content-header">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/login-bg.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
@endsection

@section('main-content')
{{-- carousel --}}
<div class="main-content">
    <div class="main-content-body">
        <div class="row mt-5">
            {{-- article-list --}}
            <div class="col">
                @if ($artikel->count() > 0)
                    @foreach ($artikel as $item)
                    <a href="/artikel/{{ $item->judul }}" class="text-reset text-decoration-none">
                        <div class="card mb-3" style="width: 100%">
                            <div class="card-body flex-fill">
                                <h5 class="card-title"><strong>{{ $item->judul }}</strong></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><em>{{ $item->name }}</em> - {{ $item->updated_at->translatedFormat('l, jS F Y') }}</h6>
                                <div class="card-text">
                                    <p>{!! $item->isi !!}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                @else
                <div class="card mb-3 shadow" style="width: 100%">
                    <div class="card-body">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-2 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    width="100"
                                    height="100"
                                    viewBox="0 0 24 24"
                                    style="fill: rgb(183, 233, 255);transform: ;msFilter:;">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
                                    <path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path>
                                </svg>
                            </div>
                            <div class="col-md-10 d-flex align-items-center">
                                <div>
                                    <h5 class="card-title">Artikel tidak tersedia</h5>
                                    <p class="card-text" style="height: fit-content">Tidak ada artikel yang tersedia saat ini, mohon coba lagi nanti.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                

                <div class="mt-3 d-flex justify-content-end">
                    {{ $artikel->links() }}
                </div>
            </div>

            {{-- sidebar --}}
        </div>
    </div>
</div>
@endsection