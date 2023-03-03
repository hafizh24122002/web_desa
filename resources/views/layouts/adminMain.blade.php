<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="css/adminStyle.css">
	<link rel="stylesheet" href="css/adminHomeStyle.css">
	<title>{{ $title }}</title>
</head>
<body id="body-pd" class="body-pd">
	<header class="header bg-dark text-light body-pd" id="header">
		<div class="header-toggle">
			<i class='bx bx-menu' id="header-toggle"></i>
		</div>

		<a href="#" class="nav-top ms-3">
			<span>Kembali ke halaman utama</span>
		</a>
	</header>

	<div class="l-navbar bg-dark show" id="nav-bar">
		<nav class="nav">
			<div>
				<a href="#" class="nav-logo">
					<i class='bx bx-layer nav-logo-icon'></i>
					<span class="nav-logo-name">Sistem Informasi Desa</span>
				</a>
				
				<div class="nav-list">
					<a href="#" class="nav-link active">
						<i class='bx bx-grid-alt nav-icon'></i>
						<span class="nav-name">Dashboard</span>
					</a>

					<a href="#" class="nav-link">
						<i class='bx bx-user nav-icon'></i>
						<span class="nav-name">Pengguna</span>
					</a>

					<a href="#" class="nav-link">
						<i class='bx bx-message-square-detail nav-icon'></i>
						<span class="nav-name">Opsi 1</span>
					</a>

					<a href="#" class="nav-link">
						<i class='bx bx-bookmark nav-icon'></i>
						<span class="nav-name">Opsi 2</span>
					</a>

					<a href="#" class="nav-link">
						<i class='bx bx-folder nav-icon'></i>
						<span class="nav-name">Opsi 3</span>
					</a>

					<a href="#" class="nav-link">
						<i class='bx bx-bar-chart-alt-2 nav-icon'></i>
						<span class="nav-name">Opsi 4</span>
					</a>
				</div>
			</div> <a href="#" class="nav-link"> <i class='bx bx-log-out nav-icon'></i> <span class="nav-name">Keluar</span> </a>
		</nav>
	</div>
	<!--Container Main end-->

	@yield('main-content')

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
	<script src="js/collapsingSidebar.js"></script>
</body>
</html>