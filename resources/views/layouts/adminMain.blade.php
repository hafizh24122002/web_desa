<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-mdb-theme="light">
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

		<div class="d-inline-flex w-100 justify-content-between">
			<a href="/" class="nav-top ms-3 d-flex align-items-center">
				<span>Kembali ke halaman pengunjung</span>
			</a>

			<div class="d-flex align-items-center">
				<a href="/staf/buat-qr" 
					class="nav-top me-2 d-flex align-items-center"
					data-mdb-toggle="tooltip"
					data-mdb-placement="bottom"
					title="Buat Kode QR">

					<i class='bx bx-qr' style="font-size: 1.5rem"></i>
				</a>

				<span class="text-muted fs-3">|</span>

				{{-- TODO: Profile akun yang login saat ini? --}}
				<a href="#" class="nav-top ms-2 d-flex align-items-center">
					{{ strtoupper(auth()->user()->name) }}
				</a>
			</div>
		</div>

	</header>

	<div class="l-navbar bg-dark show" id="nav-bar">
		<nav class="nav">
			<a href="/admin/dashboard" class="nav-logo">
				<i class='bx bx-layer nav-logo-icon'></i>
				<span class="nav-logo-name nav-name" id="nav-name">Sistem Informasi Desa</span>
			</a>

			<div class="overflow-auto" id="scrollable-sidebar" style="height: calc(100% - 116px)">
				<div class="nav-list">
					<a href="/admin/dashboard" class="nav-link">
						<i class='bx bx-grid-alt nav-icon'></i>
						<span class="nav-name" id="nav-name">Dashboard</span>
					</a>

					@if (auth()->user()->id_grup === 1)
						<a href="/admin/user-manager" class="nav-link">
							<i class='bx bx-user nav-icon'></i>
							<span class="nav-name" id="nav-name">Pengguna</span>
						</a>
					@endif
					
					<div id="InfoDesa">
						<div class="accordion-item bg-dark">
							<div class="accordion-header" id="infoDesaTitle">
								<button class="accordion-button collapsed nav-link bg-dark d-flex"
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#infoDesa"
									aria-expanded="false"
									aria-controls="infoDesa"
									href="/staf/info-desa">

									<i class='bx bx-building-house nav-icon'></i>
									<span class="nav-name" id="nav-name">Info Desa</span>
								</button>
							</div>

							<div class="accordion-collapse collapse"
								aria-labelledby="infoDesaTitle"
								data-bs-parent="#InfoDesa"
								id="infoDesa">
								
								<a href="/staf/info-desa/identitas-desa" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bx-group nav-icon"></i>
									<span class="nav-name" id="nav-name">Identitas Desa</span>
								</a>

								<a href="/staf/info-desa/dusun" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bi bi-map-fill"></i>
									<span class="nav-name" id="nav-name">Dusun</span>
								</a>
							</div>
						</div>
					</div>
					<div id="Kependudukan">
						<div class="accordion-item bg-dark">
							<div class="accordion-header" id="pendudukTitle">
								<button class="accordion-button collapsed nav-link bg-dark d-flex"
									style=""
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#penduduk"
									aria-expanded="false"
									aria-controls="penduduk"
									href="/staf/kependudukan">

									<i class='bx bx-id-card nav-icon'></i>
									<span class="nav-name" id="nav-name">Kependudukan</span>
								</button>
							</div>

							<div class="accordion-collapse collapse"
								aria-labelledby="pendudukTitle"
								data-bs-parent="#Kependudukan"
								id="penduduk">
								
								<a href="/staf/kependudukan/penduduk" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bx-group nav-icon"></i>
									<span class="nav-name" id="nav-name">Penduduk</span>
								</a>

								<a href="/staf/kependudukan/keluarga" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bx-male-female nav-icon"></i>
									<span class="nav-name" id="nav-name">Keluarga</span>
								</a>

								<a href="/staf/kependudukan/rtm" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bx-home nav-icon"></i>
									<span class="nav-name" id="nav-name">Rumah Tangga</span>
								</a>
							</div>
						</div>
					</div>

					<div id="Kesehatan">
						<div class="accordion-item bg-dark">
							<div class="accordion-header" id="kesehatanTitle">
								<button class="accordion-button collapsed nav-link bg-dark d-flex"
									style=""
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#kesehatan"
									aria-expanded="false"
									aria-controls="kesehatan"
									href="/staf/kesehatan">

									<i class='bx bx-health nav-icon'></i>
									<span class="nav-name" id="nav-name">Kesehatan</span>
								</button>
							</div>

							<div class="accordion-collapse collapse"
								aria-labelledby="kesehatanTitle"
								data-bs-parent="#Kesehatan"
								id="kesehatan">
								
								<a href="/staf/kesehatan/posyandu" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bx-plus-medical nav-icon"></i>
									<span class="nav-name" id="nav-name">Posyandu</span>
								</a>

								<a href="/staf/kesehatan/kia" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bxs-id-card nav-icon"></i>
									<span class="nav-name" id="nav-name">KIA</span>
								</a>

								<a href="/staf/kesehatan/pemantauan" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bxs-calendar-check nav-icon"></i>
									<span class="nav-name" id="nav-name">Pemantauan</span>
								</a>
							</div>
						</div>
					</div>

					<div id="Statistik">
						<div class="accordion-item bg-dark">
							<div class="accordion-header" id="statistikTitle">
								<button class="accordion-button collapsed nav-link bg-dark d-flex"
									style=""
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#statistik"
									aria-expanded="false"
									aria-controls="statistik"
									href="/staf/statistik">

									<i class='bi bi-clipboard-data nav-icon'></i>
									<span class="nav-name" id="nav-name">Statistik</span>
								</button>
							</div>

							<div class="accordion-collapse collapse"
								aria-labelledby="statistikTitle"
								data-bs-parent="#Statistik"
								id="statistik">
								
								<a href="/staf/statistik/statistik-kependudukan" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bi bi-layout-text-sidebar-reverse nav-icon"></i>
									<span class="nav-name" id="nav-name">Statistik Kependudukan</span>
								</a>
							</div>
						</div>
					</div>

					<div id="ManajemenStaf">
						<div class="accordion-item bg-dark">
							<div class="accordion-header" id="stafTitle">
								<button class="accordion-button collapsed nav-link bg-dark d-flex"
									style=""
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#staf"
									aria-expanded="false"
									aria-controls="staf"
									href="/staf/manajemen-staf">

									<i class='bx bx-book-content nav-icon'></i>
									<span class="nav-name" id="nav-name">Manajemen Staf</span>
								</button>
							</div>

							<div class="accordion-collapse collapse"
								aria-labelledby="stafTitle"
								data-bs-parent="#ManajemenStaf"
								id="staf">
								
								<a href="/staf/manajemen-staf/" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bx-sitemap nav-icon"></i>
									<span class="nav-name" id="nav-name">Struktur Organisasi</span>
								</a>

								<a href="/staf/manajemen-staf/daftar-staf" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bx-list-ul nav-icon"></i>
									<span class="nav-name" id="nav-name">Daftar Staf</span>
								</a>
							</div>
						</div>
					</div>

					<div id="ManajemenWeb">
						<div class="accordion-item bg-dark">
							<div class="accordion-header" id="manajemenWebTitle">
								<button class="accordion-button collapsed nav-link bg-dark d-flex"
									style=""
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#manajemenWeb"
									aria-expanded="false"
									aria-controls="manajemenWeb"
									href="/staf/manajemen-web">

									<i class='bx bx-briefcase nav-icon'></i>
									<span class="nav-name" id="nav-name">Manajemen Web</span>
								</button>
							</div>

							<div class="accordion-collapse collapse"
								aria-labelledby="manajemenWebTitle"
								data-bs-parent="#ManajemenWeb"
								id="manajemenWeb">
								
								<a href="/staf/manajemen-web/dashboard" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bxs-pie-chart-alt-2 nav-icon"></i>
									<span class="nav-name" id="nav-name">Dashboard</span>
								</a>

								<a href="/staf/manajemen-web/artikel" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bxs-news nav-icon"></i>
									<span class="nav-name" id="nav-name">Artikel</span>
								</a>

								<a href="/staf/manajemen-web/banner" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class='bx bxs-carousel nav-icon'></i>
									<span class="nav-name" id="nav-name">Banner</span>
								</a>

								<a href="/staf/manajemen-web/agenda" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bxs-calendar-event nav-icon"></i>
									<span class="nav-name" id="nav-name">Agenda</span>
								</a>

								<a href="/staf/manajemen-web/dokumen" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bxs-file nav-icon"></i>
									<span class="nav-name">Dokumen</span>
								</a>
							</div>
						</div>
					</div>

					<div id="LayananSurat">
						<div class="accordion-item bg-dark">
							<div class="accordion-header" id="layananSuratTitle">
								<button class="accordion-button collapsed nav-link bg-dark d-flex"
									style=""
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#layananSurat"
									aria-expanded="false"
									aria-controls="layananSurat"
									href="/staf/layanan-surat">

									<i class='bx bx-envelope nav-icon'></i>
									<span class="nav-name" id="nav-name">Layanan Surat</span>
								</button>
							</div>

							<div class="accordion-collapse collapse"
								aria-labelledby="layananSuratTitle"
								data-bs-parent="#layananSurat"
								id="layananSurat">
								
								<a href="/staf/layanan-surat/buat-surat" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bxs-file-plus nav-icon"></i>
									<span class="nav-name" id="nav-name">Buat Surat</span>
								</a>

								<a href="/staf/layanan-surat/arsip-surat" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bxs-archive nav-icon"></i>
									<span class="nav-name" id="nav-name">Arsip</span>
								</a>
							</div>
						</div>
					</div>
					<div id="BukuAdministrasiDesa">
						<div class="accordion-item bg-dark mb-6">
							<div class="accordion-header" id="bukuAdministrasiDesaTitle">
								<button class="accordion-button collapsed nav-link bg-dark d-flex"
									style=""
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#bukuAdministrasiDesa"
									aria-expanded="false"
									aria-controls="bukuAdministrasiDesa"
									href="/staf/layanan-surat">

									<i class='bx bx-book nav-icon'></i>
									<span class="nav-name" id="nav-name">Buku Administrasi Desa</span>
								</button>
							</div>

							<div class="accordion-collapse collapse"
								aria-labelledby="bukuAdministrasiDesaTitle"
								data-bs-parent="#bukuAdministrasiDesa"
								id="bukuAdministrasiDesa">
								
								<a href="/staf/buku-administrasi-desa/administrasi-umum" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bxs-file nav-icon"></i>
									<span class="nav-name" id="nav-name">Administrasi Umum</span>
								</a>

								<a href="/staf/buku-administrasi-desa/administrasi-penduduk" class="nav-link collapse-body" style="margin-left: 2rem">
									<i class="bx bxs-group nav-icon"></i>
									<span class="nav-name" id="nav-name">Administrasi Penduduk</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<form action="/logout" method="post">
				@csrf

				<button type="submit" class="nav-link position-absolute bottom-0" style="background: none; border: none">
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