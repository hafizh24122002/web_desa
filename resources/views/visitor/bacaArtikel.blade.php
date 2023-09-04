@extends('layouts/visitorMain')

@section('main-content')

<div class="row mt-5" style="margin-inline: 7em">
    {{-- article-list --}}
    <div class="col">
        <h1>{{ $artikel->judul }}</h1>
        <p><em>{{ $artikel->name }}</em> - {{ $artikel->updated_at->translatedFormat('l, jS F Y') }} - {{ $artikel->click_count }} pembaca</p>
		<hr>

		<p>{!! $artikel->isi !!}</p>
    </div>

    {{-- sidebar --}}
    <div class="col">

    </div>

    
</div>
@endsection