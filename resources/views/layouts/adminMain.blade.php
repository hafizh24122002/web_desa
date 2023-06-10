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

					@if (auth()->user()->id_grup === 1)
						<a href="/admin/user-manager" class="nav-link">
							<i class='bx bx-user nav-icon'></i>
							<span class="nav-name">Pengguna</span>
						</a>
					@endif

					<div id="Kependudukan"">
						<div class="accordion-item">
							<div class="accordion-header" id="pendudukTitle">
								<button class="accordion-button collapsed nav-link"
									style=""
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#penduduk"
									aria-expanded="false"
									aria-controls="penduduk"
									href="/staf/kependudukan">

									<i class='bx bx-id-card nav-icon'></i>
									<span class="nav-name">Kependudukan</span>
								</button>
							</div>

							<div class="accordion-collapse collapse"
								aria-labelledby="pendudukTitle"
								data-bs-parent="#Kependudukan"
								id="penduduk">
								
								<a href="/staf/kependudukan/penduduk" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bx-group nav-icon"></i>
									<span class="nav-name">Penduduk</span>
								</a>

								<a href="/staf/kependudukan/keluarga" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bx-male-female nav-icon"></i>
									<span class="nav-name">Keluarga</span>
								</a>
							</div>
						</div>
					</div>

					<div id="Statistik"">
						<div class="accordion-item">
							<div class="accordion-header" id="statistikTitle">
								<button class="accordion-button collapsed nav-link"
									style=""
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#statistik"
									aria-expanded="false"
									aria-controls="statistik"
									href="/staf/statistik">

									<i class='bi bi-clipboard-data nav-icon'></i>
									<span class="nav-name">Statistik</span>
								</button>
							</div>

							<div class="accordion-collapse collapse"
								aria-labelledby="statistikTitle"
								data-bs-parent="#Statistik"
								id="statistik">
								
								<a href="/staf/statistik/statistik-kependudukan" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bi bi-bar-chart-line-fill nav-icon"></i>
									<span class="nav-name">Statistik Kependudukan</span>
								</a>
							</div>
						</div>
					</div>

					<div id="ManajemenStaf"">
						<div class="accordion-item">
							<div class="accordion-header" id="stafTitle">
								<button class="accordion-button collapsed nav-link"
									style=""
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#staf"
									aria-expanded="false"
									aria-controls="staf"
									href="/staf/manajemen-staf">

									<i class='bx bx-book-content nav-icon'></i>
									<span class="nav-name">Manajemen Staf</span>
								</button>
							</div>

							<div class="accordion-collapse collapse"
								aria-labelledby="stafTitle"
								data-bs-parent="#ManajemenStaf"
								id="staf">
								
								<a href="/staf/manajemen-staf/" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bx-sitemap nav-icon"></i>
									<span class="nav-name">Struktur Organisasi</span>
								</a>

								<a href="/staf/manajemen-staf/daftar-staf" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bx-list-ul nav-icon"></i>
									<span class="nav-name">Daftar Staf</span>
								</a>
							</div>
						</div>
					</div>

					<div id="ManajemenWeb"">
						<div class="accordion-item">
							<div class="accordion-header" id="manajemenWebTitle">
								<button class="accordion-button collapsed nav-link"
									style=""
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#manajemenWeb"
									aria-expanded="false"
									aria-controls="manajemenWeb"
									href="/staf/manajemen-web">

									<i class='bx bx-briefcase nav-icon'></i>
									<span class="nav-name">Manajemen Web</span>
								</button>
							</div>

							<div class="accordion-collapse collapse"
								aria-labelledby="manajemenWebTitle"
								data-bs-parent="#ManajemenWeb"
								id="manajemenWeb">
								
								<a href="/staf/manajemen-web/dashboard" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bxs-pie-chart-alt-2 nav-icon"></i>
									<span class="nav-name">Dashboard</span>
								</a>

								<a href="/staf/manajemen-web/artikel" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bxs-news nav-icon"></i>
									<span class="nav-name">Artikel</span>
								</a>
							</div>
						</div>
					</div>

					<div id="LayananSurat">
						<div class="accordion-item">
							<div class="accordion-header" id="layananSuratTitle">
								<button class="accordion-button collapsed nav-link"
									style=""
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#layananSurat"
									aria-expanded="false"
									aria-controls="layananSurat"
									href="/staf/layanan-surat">

									<i class='bx bx-envelope nav-icon'></i>
									<span class="nav-name">Layanan Surat</span>
								</button>
							</div>

							<div class="accordion-collapse collapse"
								aria-labelledby="layananSuratTitle"
								data-bs-parent="#layananSurat"
								id="layananSurat">
								
								<a href="/staf/layanan-surat/buat-surat" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bxs-file-plus nav-icon"></i>
									<span class="nav-name">Buat Surat</span>
								</a>

								<a href="/staf/layanan-surat/arsip-surat" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bxs-archive nav-icon"></i>
									<span class="nav-name">Arsip</span>
								</a>
							</div>
						</div>
					</div>
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

	<script src="{{ asset('js/collapsingSidebar.js') }}"></script>
</body>
</html>