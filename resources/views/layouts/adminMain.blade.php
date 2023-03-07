<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	@include('partials.commonStyles')
	<link rel="stylesheet" href="{{ asset('css/adminStyle.css') }}">
	<link rel="stylesheet" href="{{ asset('css/adminHomeStyle.css') }}">
	<title>{{ $title }}</title>
</head>
<body id="body-pd" class="body-pd">
	<header class="header bg-dark text-light body-pd" id="header">
		<div class="header-toggle">
			<i class='bx bx-menu' id="header-toggle"></i>
		</div>

		<a href="/" class="nav-top ms-3">
			<span>Kembali ke halaman utama</span>
		</a>
	</header>

	<div class="l-navbar bg-dark show" id="nav-bar">
		<nav class="nav">
			<div>
				<a href="/admin/dashboard" class="nav-logo">
					<i class='bx bx-layer nav-logo-icon'></i>
					<span class="nav-logo-name">Sistem Informasi Desa</span>
				</a>
				
				<div class="nav-list">
					<a href="/admin/dashboard" class="nav-link">
						<i class='bx bx-grid-alt nav-icon'></i>
						<span class="nav-name">Dashboard</span>
					</a>

					<a href="/admin/user-manager" class="nav-link">
						<i class='bx bx-user nav-icon'></i>
						<span class="nav-name">Pengguna</span>
					</a>

					<a href="admin/test" class="nav-link">
						<i class='bx bx-message-square-detail nav-icon'></i>
						<span class="nav-name">Opsi 1</span>
					</a>

					<a href="admin/a" class="nav-link">
						<i class='bx bx-bookmark nav-icon'></i>
						<span class="nav-name">Opsi 2</span>
					</a>

					<a href="admin/b" class="nav-link">
						<i class='bx bx-folder nav-icon'></i>
						<span class="nav-name">Opsi 3</span>
					</a>

					<a href="admin/c" class="nav-link">
						<i class='bx bx-bar-chart-alt-2 nav-icon'></i>
						<span class="nav-name">Opsi 4</span>
					</a>
				</div>
			</div> 
			
			<form action="/logout" method="post">
				@csrf

				<button type="submit" class="nav-link" style="background: none; border: none">
					<i class='bx bx-log-out nav-icon'></i>
					<span class="nav-name">Keluar</span>
				</button>
			</form>
		</nav>
	</div>
	<!--Container Main end-->

	@yield('main-content')

	@include('partials.commonScripts')
	<script src="{{ asset('js/collapsingSidebar.js') }}"></script>
</body>
</html>