@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="container">
				{{-- menu yang di atas --}}
				@include('partials.adminTopMenu', [
					'title' => 'Pohon Staf',
					'current_page' => 'Manajemen Staf'
				])
	
				{{-- content --}}
				<div class="row mt-3 container">
					<div id="pohonStaf" style="width: 100%; height: 600px;"></div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection