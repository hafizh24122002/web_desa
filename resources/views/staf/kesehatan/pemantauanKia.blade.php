@extends('layouts/adminMain')

@section('main-content')

<link rel="stylesheet" href="{{ asset('css/tabStyle.css') }}">

<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="container">
				{{-- menu yang di atas --}}
				@include('partials.adminTopMenu', [
					'title' => 'Pemantauan Kesehatan Ibu dan Anak (KIA)',
					'parent_page' => 'Kesehatan',
					'parent_link' => '/staf/kesehatan',
					'current_page' => 'Pemantauan KIA', ])
					
				{{-- content --}}
				<div class="row mt-3 container">
					@if (session()->has('success'))
						<div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif

					<div class="tabs">
						
						<hr>
						<input type="radio" id="tab1" name="tab-control" {{ session('currentRoute', 'tab1') === 'tab1' ? 'checked' : '' }}>
						<input type="radio" id="tab2" name="tab-control" {{ session('currentRoute', 'tab1') === 'tab2' ? 'checked' : '' }}>
						<input type="radio" id="tab3" name="tab-control" {{ session('currentRoute', 'tab1') === 'tab3' ? 'checked' : '' }}>
						
						<ul>
							<li title="Ibu Hamil per Bulan">
								<label for="tab1" role="button">
									<span>Ibu Hamil per Bulan</span>
								</label>
							</li>

							<li title="Anak 0-2 Tahun per Bulan">
								<label for="tab2" role="button">
									<span>Anak 0-2 Tahun per Bulan</span>
								</label>
							</li>

							<li title="Sasaran PAUD anak 2-6 tahun">
								<label for="tab3" role="button">
									<span>Sasaran PAUD anak 2-6 tahun</span>
								</label>
							</li>
						</ul>

						<div class="slider">
							<div class="indicator"></div>
						</div>
						<hr>

						<div class="content">
							<section>
								@include('staf/kesehatan/pemantauanKiaViews/pemantauanKiaIbu')
							</section>

							<section>
								@include('staf/kesehatan/pemantauanKiaViews/pemantauanKiaAnak')
							</section>

							<section>
								@include('staf/kesehatan/pemantauanKiaViews/pemantauanKiaPaud')
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('partials.commonScripts')

@endsection