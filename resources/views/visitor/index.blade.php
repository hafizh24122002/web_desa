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

                <div class="mt-3 d-flex justify-content-end">
                    {{ $artikel->links() }}
                </div>
            </div>

            {{-- sidebar --}}
        </div>
    </div>
</div>
@endsection