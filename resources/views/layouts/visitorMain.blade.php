<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	@include('partials.commonStyles')
	<link rel="stylesheet" href="{{ asset('css/visitorStyle.css') }}">

	<title>{{ $title }} - Web Desa</title>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="/">
				<!-- <img src="" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> -->
				<div class="fw-bold text-uppercase">Desa Malik</div>
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse py-2" id="navbarTogglerDemo02">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Profil Desa
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="/tentang-desa">Tentang Kami</a></li>
							<li><a class="dropdown-item" href="/geografis-desa">Geografis Desa</a></li>
							<li><a class="dropdown-item" href="/demografi-desa">Demografi Desa</a></li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Pemerintahan
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
							<li><a class="dropdown-item" href="#">Perangkat Desa</a></li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Informasi Publik
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="#">Agenda Kegiatan</a></li>
							<li><a class="dropdown-item" href="#">Galeri</a></li>
							<li><a class="dropdown-item" href="#">Berita Desa</a></li>
						</ul>
					</li>
				</ul>
				<form class="d-flex" role="search">
					<div class="input-group">
						<input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
						<button type="button" class="btn btn-secondary rounded" id="searchbtn">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</form>
				@auth
				<a href="/admin/dashboard">
					<button type="button" class="btn btn-secondary rounded-pill ms-2">Dashboard</button>
				</a>
				@else
				<a href="/login">
					<button type="button" class="btn btn-secondary rounded-pill ms-2">Login</button>
				</a>
				@endauth
			</div>
		</div>
	</nav>

	<div class="body-wrapper">
		@yield('main-content')
		@include('partials.commonScripts')
		@include('partials.sideContent')
	</div>

	<script src="{{ asset('js/scriptVisitor.js') }}"></script>

</body>
	@include('partials.sideContent')
	@include('partials.visitorFooter')
</html>