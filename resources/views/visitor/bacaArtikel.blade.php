@extends('layouts/visitorMain')

@section('main-content')

<div class="main-content">
    <div class="main-content-body">
        <div class="row mt-5">
            {{-- article-list --}}
            <div class="col">
                <h1>{{ $artikel->judul }}</h1>
                <p><em>{{ $artikel->name }}</em> - {{ $artikel->updated_at->translatedFormat('l, jS F Y') }}</p>
                <hr>

                <p>{!! $artikel->isi !!}</p>
            </div>
        </div>
    </div>
</div>

@endsection