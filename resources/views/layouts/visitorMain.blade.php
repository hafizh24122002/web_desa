<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-mdb-theme="light">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	@include('partials.commonStyles')
	<link rel="stylesheet" href="{{ asset('css/visitorStyle.css') }}">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
	integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
	crossorigin=""/>

	<title>{{ $title }} - Web Desa</title>
</head>

<body>
	<nav class="navbar navbar-expand-lg fixed-top navbar-before-scroll shadow-0" id="main-navbar">
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
						<a class="nav-link dropdown-toggle navbar-items" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Profil Desa
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="/tentang-desa">Tentang Kami</a></li>
							<li><a class="dropdown-item" href="/geografis-desa">Geografis Desa</a></li>
							<li><a class="dropdown-item" href="/demografi-desa">Demografi Desa</a></li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle navbar-items" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Pemerintahan
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="/struktur-organisasi">Struktur Organisasi</a></li>
							<li><a class="dropdown-item" href="/perangkat-desa">Perangkat Desa</a></li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle navbar-items" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Informasi Publik
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="/dokumen">Dokumen</a></li>
							<li><a class="dropdown-item" href="#">Galeri</a></li>
							<li><a class="dropdown-item" href="#">Berita Desa</a></li>
						</ul>
					</li>
				</ul>
				<form class="d-flex me-2" role="search">
					<div class="input-group">
						<input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
						<button type="button" class="btn btn-primary rounded" id="searchbtn" data-mdb-ripple-init>
							<i class="fas fa-search"></i>
						</button>
					</div>
				</form>

				@auth
					<a href="/admin/dashboard">
						<button type="button" class="btn btn-primary rounded-pill" id="dashboard-btn" data-mdb-ripple-init>Dashboard</button>
					</a>
				@else
					<a href="/login">
						<button type="button" class="btn btn-primary rounded-pill" id="login-btn" data-mdb-ripple-init>Login</button>
					</a>
				@endauth
			</div>
		</div>
	</nav>
	
	@yield('header')
	<div class="body-wrapper" style="flex-direction: column">
		@yield('main-content')
		@yield('peta')
		@yield('aparatur')
		{{-- @if(!isset($disableSidebar) || !$disableSidebar)
			@include('partials.sideContent')
        @endif --}}
	</div>

	@include('partials.commonScripts')

	<script>
		// Helper function to strip images from HTML content
		function stripImages(content) {
			var tempDiv = document.createElement('div');
			tempDiv.innerHTML = content;

			// Remove all img elements
			var images = tempDiv.getElementsByTagName('img');
			for (var i = images.length - 1; i >= 0; i--) {
				images[i].parentNode.removeChild(images[i]);
			}

			// Get the updated content
			var contentWithoutImages = tempDiv.innerHTML;

			return contentWithoutImages;
		}

		$(document).ready(function() {
			// Update each card text with content without images
			$('.artikel-text').each(function() {
				var content = $(this).data('content');
				var contentWithoutImages = stripImages(content);
				$(this).html(contentWithoutImages);
			});
		});
	</script>

	<script>
		const navbar = document.getElementById("main-navbar");

		window.addEventListener('scroll', function () {
			if (window.pageYOffset > 0) {
				navbar.classList.add("navbar-after-scroll");
				navbar.classList.remove("navbar-before-scroll");
			} else {
				navbar.classList.remove("navbar-after-scroll");
				navbar.classList.add("navbar-before-scroll");
			}
		});
	  </script>

	<script>
		AOS.init();
	</script>

	<script>
		$('.aparatur-carousel').slick({
			dots: true,
			infinite: false,
			speed: 300,
			slidesToShow: 5,
			slidesToScroll: 5,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
						infinite: true,
						dots: true
					}
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 576,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
				// You can unslick at a given breakpoint now by adding:
				// settings: "unslick"
				// instead of a settings object
			]
			});
	</script>

	  {{-- <script>
		document.addEventListener("DOMContentLoaded", function () {
			const animatedElement = document.querySelector('.animated-element');

			const options = {
				threshold: 0.5 // Adjust this value based on your needs
			};

			const observer = new IntersectionObserver(function (entries, observer) {
				entries.forEach(entry => {
				if (entry.isIntersecting) {
					entry.target.classList.add('animate');
					observer.unobserve(entry.target);
				}
				});
			}, options);

			observer.observe(animatedElement);
		});
	  </script> --}}

	{{-- <script>
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
	</script> --}}
</body>

	@include('partials.visitorFooter')
</html>