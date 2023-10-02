@extends('layouts/visitorMain')

@section('main-content')

<div class="main-content">
	<div class="main-content-body">
		<div class="h2 mt-5">
			Perangkat Desa
		</div>
		<hr>
		<div class="row">
        @foreach($staf as $data)
        <div class="col-md-4 d-flex align-items-stretch my-3">
            <div class="card">
                <img src="img/kuser.png" class="pt-4 w-50 mx-auto" alt="{{ $data->nama }}">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $data->nama }}</h5>
                    <p class="card-title text-center">{{ $data->jabatan }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
	</div>
</div>

@endsection