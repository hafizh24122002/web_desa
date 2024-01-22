@extends('layouts/visitorMain')

@section('main-content')

<div>
    <img src="{{ asset('storage/'.$artikel->cover->path) }}" id="cover" class="d-block w-100 shadow" style="height: 400px; width: 100%; object-fit: cover; filter:brightness(50%)">
</div>

<div class="main-content">
    <div class="main-content-body container">

        <a href="/" class="btn btn-info rounded-pill mb-4 mt-5">
            <i class="fa fa-arrow-left"></i> Kembali ke Halaman Utama
        </a>
            
        <div class="row">
            <div class="col mt-2">
                <h1>{{ $artikel->judul }}</h1>
                <p><em>{{ $artikel->name }}</em> - {{ $artikel->updated_at->translatedFormat('l, jS F Y') }}</p>
                <hr>

                <p>{!! $artikel->isi !!}</p>
            </div>
        </div>
    </div>
</div>

<script>
    $('img').not($('#cover')).removeAttr('height').css({
        "max-width":"100%",
        "max-height":"400px"
    });
</script>

@endsection