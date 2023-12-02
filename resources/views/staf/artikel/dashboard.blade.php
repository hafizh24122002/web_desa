@extends('layouts/adminMain')

@section('main-content')

<style>
	  * {
		margin: 0;
		padding: 0;
		font-family: sans-serif;
	  }
	  .chartMenu {
		width: 100vw;
		height: 40px;
		background: #1A1A1A;
		color: rgba(54, 162, 235, 1);
	  }
	  .chartMenu p {
		padding: 10px;
		font-size: 20px;
	  }
	  .chartCard {
		width: 100vw;
		height: calc(100vh - 40px);
		background: rgba(54, 162, 235, 0.2);
		display: flex;
		align-items: center;
		justify-content: center;
	  }
	  .chartBox {
		width: 700px;
		padding: 20px;
		border-radius: 20px;
		border: solid 3px rgba(54, 162, 235, 1);
		background: white;
	  }
	</style>

<section class="wrapper">
	<div class="container-fostrap">
		<div class="content">
			<div class="container">
				{{-- menu yang di atas --}}
				@include('partials.adminTopMenu', [
					'title' => 'Dashboard Artikel',
					'current_page' => 'Dashboard',
					])

				{{-- card --}}
				<div class="row mt-3 justify-content-center">
					<div class="col-xs-12 col-sm-6 col-lg-4">
						<div class="card text-white bg-primary mb-3 rounded shadow">
							<div class="card-content">
								<h4 class="card-title">
									{{ $artikel_total }}
								</h4>
								<p class="card-text">
									Total artikel aktif
								</p>
								<div class="icon">
									<i class="bi bi-journals"></i>
								</div>
							</div>
							
							<div class="card-read-more">
								<a href="/staf/manajemen-web/artikel" class="btn btn-link btn-block">
									Lihat Detail
									<i class="bi bi-arrow-right-circle-fill"></i>
								</a>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-6 col-lg-4">
						<div class="card text-white bg-info mb-3 rounded shadow">
							<div class="card-content">
								<h4 class="card-title">
									{{ $artikel_bulan }}
								</h4>
								<p class="card-text">
									Total artikel aktif bulan ini
								</p>
								<div class="icon">
									<i class="bi bi-journal"></i>
								</div>
							</div>

							<div class="card-read-more">
								<a href="#" class="btn btn-link btn-block">
									Lihat Detail
									<i class="bi bi-arrow-right-circle-fill"></i>
								</a>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-6 col-lg-4">
						<div class="card text-white bg-success mb-3 rounded shadow">
							<div class="card-content">
								<h4 class="card-title">
									{{ $artikel_views_bulan }}
								</h4>
								<p class="card-text">
									Pengunjung artikel bulan ini
								</p>
								<div class="icon">
									<i class="bi bi-people"></i>
								</div>
							</div>
							<div class="card-read-more">
								<a href="#" class="btn btn-link btn-block">
									Lihat Detail
									<i class="bi bi-arrow-right-circle-fill"></i>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="row mb-3 justify-content-center">
					<div class="col-xs-12 col-sm-6 col-lg-4">
						<div class="card text-white bg-warning mb-3 rounded shadow">
							<div class="card-content">
								<h4 class="card-title">
									{{ $dokumen_total }}
								</h4>
								<p class="card-text">
									Total dokumen aktif
								</p>
								<div class="icon">
									<i class="bi bi-file-earmark-check"></i>
								</div>
							</div>
							<div class="card-read-more">
								<a href="#" class="btn btn-link btn-block">
									Lihat Detail
									<i class="bi bi-arrow-right-circle-fill"></i>
								</a>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-6 col-lg-4">
						<div class="card text-white bg-danger mb-3 rounded shadow">
							<div class="card-content">
								<h4 class="card-title">
									{{ $dokumen_download_bulan }}
								</h4>
								<p class="card-text">
									Dokumen didownload bulan ini
								</p>
								<div class="icon">
									<i class="bi bi-file-earmark-arrow-down"></i>
								</div>
							</div>
							<div class="card-read-more">
								<a href="#" class="btn btn-link btn-block">
									Lihat Detail
									<i class="bi bi-arrow-right-circle-fill"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
	
				<div class="row">
					<div class="col-lg-6 mb-3">
						<div class="card shadow">
							<div class="card-header">
								<span class="me-2"><i class="bi bi-bar-chart-line-fill"></i></span>
								Grafik Artikel Bulan Ini
							</div>
							<div class="card-body">
								<canvas id="artikel"></canvas>
							</div>
						</div>
					</div>

					<div class="col-lg-6 mb-3">
						<div class="card shadow">
							<div class="card-header">
								<span class="me-2"><i class="bi bi-graph-up"></i></span>
								Grafik Pembaca Bulan Ini
							</div>
							<div class="card-body">
								<canvas id="views"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<script>
	var ctx_views = document.getElementById('views').getContext('2d');
	var viewsChartData = @json($artikel_views_hari);

	var chart = new Chart(ctx_views, {
		type: 'line',
		data: {
			labels: viewsChartData.map(entry => entry.date),
			datasets: [{
				label: 'Artikel dilihat per hari',
				data: viewsChartData.map(entry => entry.count),
				borderColor: 'rgba(0, 192, 54, 1)',
				borderWidth: 1,
				fill: false,
				backgroundColor: 'rgba(0, 192, 54, 1)',
				tension: 0.3
			}]
		},
		options: {
			scales: {
				x: {
					type: 'time',
					time: {
						unit: 'day',
					},
					title: {
						display: true,
						text: 'Tanggal'
					},
				},
				y: {
					beginAtZero: true,
					title: {
						display: true,
						text: 'Jumlah pengunjung'
					},
					ticks: {
						precision: 0
					}
				}
			}
		}
	});
</script>

<script>
	var ctx_views = document.getElementById('artikel').getContext('2d');
	var artikelChartData = @json($artikel_hari);

	var chart = new Chart(ctx_views, {
		type: 'bar',
		data: {
			labels: artikelChartData.map(entry => entry.date),
			datasets: [{
				label: 'Artikel dipublikasi per hari',
				data: artikelChartData.map(entry => entry.count),
				borderColor: 'rgb(0, 192, 255)',
				borderWidth: 1,
				fill: false,
				backgroundColor: 'rgba(0, 192, 255, 1)',
				tension: 0.3
			}]
		},
		options: {
			scales: {
				x: {
					type: 'time',
					time: {
						unit: 'day',
					},
					title: {
						display: true,
						text: 'Tanggal'
					},
				},
				y: {
					beginAtZero: true,
					title: {
						display: true,
						text: 'Jumlah Artikel'
					},
					ticks: {
						precision: 0
					}
				}
			}
		}
	});
</script>

@include('partials.commonScripts')

@endsection