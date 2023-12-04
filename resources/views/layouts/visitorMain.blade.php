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
							<li><a class="dropdown-item" href="/struktur-organisasi">Struktur Organisasi</a></li>
							<li><a class="dropdown-item" href="/perangkat-desa">Perangkat Desa</a></li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Informasi Publik
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="/dokumen">Dokumen</a></li>
							<li><a class="dropdown-item" href="#">Galeri</a></li>
							<li><a class="dropdown-item" href="#">Berita Desa</a></li>
						</ul>
					</li>
				</ul>
				<form class="d-flex" role="search">
					<div class="input-group">
						<input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
						<button type="button" class="btn btn-primary rounded" id="searchbtn">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</form>
				@auth
				<a href="/admin/dashboard">
					<button type="button" class="btn btn-primary rounded-pill ms-2" data-mdb-ripple-init data-mdb-ripple-color="light">Dashboard</button>
				</a>
				@else
				<a href="/login">
					<button type="button" class="btn btn-primary rounded-pill ms-2">Login</button>
				</a>
				@endauth
			</div>
		</div>
	</nav>
	
	@yield('header')
	<div class="body-wrapper">
		@yield('main-content')
		@if(!isset($disableSidebar) || !$disableSidebar)
			@include('partials.sideContent')
        @endif
		@include('partials.commonScripts')
	</div>

	<script>
		$(document).ready(function () {
		  var prevScrollPos = $(window).scrollTop();
	  
		  $(window).scroll(function () {
			var currentScrollPos = $(window).scrollTop();
	  
			if (prevScrollPos > currentScrollPos) {
			  // User is scrolling up
			  $('.navbar').css('transform', 'translateY(0)');
			} else {
			  // User is scrolling down
			  $('.navbar').css('transform', 'translateY(-100%)');
			}
	  
			prevScrollPos = currentScrollPos;
		  });
		});
	  </script>

	<script>
		function generateColorPalette(numColors, alpha) {
			const colors = [];
			const hueStep = 360 / numColors;

			for (let i = 0; i < numColors; i++) {
				const hue = i * hueStep;
				colors.push(`rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${alpha})`);
			}

			return colors;
		}

		// Mengambil data statistik
		var genderStats = JSON.parse('{!! json_encode($arr_gender) !!}');
		var barChartCanvas = document.getElementById('bar-chart');
		var genderNames = genderStats.map(stat => stat.name);
		var genderCounts = genderStats.map(stat => stat.count);
		var colorPalette = generateColorPalette(genderNames.length, 0.5);
		var borderColors = colorPalette.map(color => color.replace(/[^,]+(?=\))/, '1'));

		function createChart(chartType, labels, data, backgroundColor, borderColor, canvasElement) {
			const ctx = canvasElement.getContext('2d');

			if (canvasElement.chart) {
				canvasElement.chart.destroy();
			}
			canvasElement.chart = new Chart(ctx, {
				type: chartType,
				data: {
					labels: labels,
					datasets: [{
						label: 'Data Berdasarkan Jenis Kelamin',
						data: data,
						backgroundColor: backgroundColor,
						borderColor: borderColor,
						borderWidth: 1
					}],
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
				},
			});
		}

		createChart('bar', genderNames, genderCounts, colorPalette, borderColors, barChartCanvas);
		document.getElementById('barchart-container').style.display = 'block';
	</script>
</body>

	@include('partials.visitorFooter')
</html>