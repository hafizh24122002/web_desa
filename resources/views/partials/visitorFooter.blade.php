<div class="spacer"></div>
<!-- Footer -->
<footer class="bg-dark text-white text-center text-md-start">
	<!-- Grid container -->
	<div class="container p-4">
		<!--Grid row-->
		<div class="row">
			<!--Grid column-->
			<div class="col-lg-6 col-md-12 mb-0 mb-md-0">
				<div class="col-lg-6">
					<h5 class="text-uppercase fw-bold">Desa Malik</h5>
					<p>{{ $identitas_desa->alamat_kantor }}</p>
					<p>
						{{ 
							($identitas_desa->nama_kecamatan ? 'Kecamatan '.$identitas_desa->nama_kecamatan.', ' : '').
							($identitas_desa->nama_kabupaten ? 'Kabupaten '.$identitas_desa->nama_kabupaten.', ' : '').
							($identitas_desa->nama_provinsi ? 'Provinsi '.$identitas_desa->nama_provinsi.', ' : '').
							$identitas_desa->kode_pos_desa ?? '' 
						}}
					</p>
				</div>
			</div>

			<!--Grid column-->
			<div class="col-lg-3 col-md-6 mb-0 mb-md-0">
				<h5 class="text-uppercase fw-bold">Kontak Kami</h5>

				<ul class="list-unstyled">
					<li>
						<a href="mailto:{{ $identitas_desa->email_desa ?? '' }}" class="text-white"><i class="fas fa-envelope me-2"></i> {{ $identitas_desa->email_desa ?? '-' }}</a>
					</li>
					<li>
						<a href="tel:{{ $identitas_desa->telepon ?? '' }}" class="text-white"><i class="fas fa-phone me-2"></i> {{ $identitas_desa->telepon ?? '-' }}</a>
					</li>
				</ul>
			</div>
			<!--Grid column-->
		</div>
		<!--Grid row-->
	</div>
	<!-- Grid container -->

	<!-- Copyright -->
	<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
		© 2023
	</div>
	<!-- Copyright -->
</footer>
<!-- Footer -->