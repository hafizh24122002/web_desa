<div class="side_content">
	<div class="single_bottom_rightbar">
		<div class="position-sticky" style="top: 2rem;">
			<div class="p-4 mb-3 bg-light rounded">
				<h2><i class="bi bi-geo-alt-fill"></i>&ensp;Peta Wilayah Desa</h2>
				<div class="single_bottom_rightbar">
					<div id="map_wilayah"></div>
					<div style="overflow:hidden;width: 300px;position: relative;">
						<iframe width="300" height="200" src="https://maps.google.com/maps?width=300&amp;height=200&amp;hl=en&amp;q=desa%20malik%20bangka%20belitung+(Title)&amp;ie=UTF8&amp;t=h&amp;z=12&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
						<div style="position: absolute;width: 80%;bottom: 10px;left: 0;right: 0;margin-left: auto;margin-right: auto;color: #000;text-align: center;">
							<small style="line-height: 1.8;font-size: 2px;background: #fff;">Powered by <a href="https://embedgooglemaps.com/">Embed Google Maps</a> & <a href="https://unoregler.com/no/">https://unoregler.com/no/</a>
							</small>
						</div>
						<style>
							#gmap_canvas img {
								max-width: none !important;
								background: none !important
							}
						</style>
					</div>
					<div style="white-space: nowrap; text-align: center; width: 300px; padding: 6px 0;">
						<a href="https://www.google.co.id/maps/place/Malik,+Payung,+South+Bangka+Regency,+Bangka+Belitung+Islands/@-2.5164387,106.0863051,13z/data=!3m1!4b1!4m6!3m5!1s0x2e3d38281861f393:0x44d74aa98a42b2fb!8m2!3d-2.5113635!4d106.1169299!16s%2Fg%2F12lqjzwbb" class="btn btn-primary btn-block" rel="noopener noreferrer" target="_blank">Buka Peta</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="single_bottom_rightbar">
	<div class="position-sticky" style="top: 2rem;">
		<div class="p-4 mb-3 bg-light rounded">
			<h2 class="box-title"><i class="bi bi-person-fill-check"></i>&ensp;Agenda Desa</h2>
			<ul class="nav nav-tabs" id="agendaTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link active" id="upcoming-tab" data-bs-toggle="tab" href="#upcoming" role="tab" aria-controls="upcoming" aria-selected="true">Yang akan datang</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="past-tab" data-bs-toggle="tab" href="#past" role="tab" aria-controls="past" aria-selected="false">Sudah lewat</a>
				</li>
			</ul>

			<div class="tab-content" id="agendaTabContent">
				<div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
					<table class="table">
						<thead>
							<tr>
								<th>Judul</th>
								<th>Waktu</th>
								<th>Lokasi</th>
								<th>Koordinator</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($upcomingAgenda as $agenda)
							<tr>
								<td>{{ $agenda->judul }}</td>
								<td>{{ $agenda->tgl_agenda }}</td>
								<td>{{ $agenda->lokasi }}</td>
								<td>{{ $agenda->koordinator }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="past" role="tabpanel" aria-labelledby="past-tab">
					<table class="table">
						<thead>
							<tr>
								<th>Judul</th>
								<th>Waktu</th>
								<th>Lokasi</th>
								<th>Koordinator</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($pastAgenda as $agenda)
							<tr>
								<td>{{ $agenda->judul }}</td>
								<td>{{ $agenda->tgl_agenda }}</td>
								<td>{{ $agenda->lokasi }}</td>
								<td>{{ $agenda->koordinator }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="single_bottom_rightbar">
	<div class="position-sticky" style="top: 2rem;">
		<div class="p-4 mb-3 bg-light rounded">
			<h2 class="box-title"><i class="bi bi-person-fill-check"></i>&ensp;Aparatur Desa</h2>
			<div class="box-body">
				<div class="content_middle_middle">
					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active" style="text-align: center">
								<img class="d-block w-100" src="https://demosid.opendesa.id/assets/images/pengguna/kuser.png" alt="First slide">
								<tr>
									<th id="label-meta-agenda" width="30%"><b>Riza Umami</b></th>
									<br>
									<td width="5%">Kepala Desa</td>
									<br>
									<td id="isi-meta-agenda" width="65%">Belum Melakukan Presensi</td>
								</tr>
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="..." alt="Second slide">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="..." alt="Third slide">
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="single_bottom_rightbar">
	<div class="position-sticky" style="top: 2rem;">
		<div class="p-4 my-3 bg-light rounded">
			<h2 class="box-title"><i class="bi bi-bar-chart-line-fill align-middle"></i>&ensp;Statistik Penduduk</h2>

			<div class="mt-2">
				<div id="barchart-container">
					<canvas id="bar-chart" width="400" height="300"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	.single_bottom_rightbar {
		margin-left: auto;
		margin-right: 20px;
		width: 350px;
	}

	h2 {
		font-size: 25px;
	}
</style>