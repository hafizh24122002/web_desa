@extends('layouts/userFormMain')

@section('form')

<div class="row mt-3 container">
	<div class="container">
		<h1>Create Rumah Tangga</h1>
	
		<form action="#" method="POST">
			@csrf <!-- Token CSRF untuk keamanan -->
	
			<!-- Input Nomor Rumah Tangga (no_rt) -->
			<div class="form-group">
				<label for="no_rt">Nomor Rumah Tangga</label>
				<input type="text" class="form-control" id="no_rt" name="no_rt" required>
			</div>
	
			<!-- Input Kepala Rumah Tangga -->
			<div class="form-group">
				<label for="kepala_rumah_tangga">Kepala Rumah Tangga</label>
				<select class="form-control" id="kepala_rumah_tangga" name="kepala_rumah_tangga" required>
					<!-- Isi opsi select dengan nama-nama dari tabel penduduk -->
					@foreach($penduduk as $penduduk)
						<option value="{{ $penduduk->id }}">{{ $penduduk->nama }}</option>
					@endforeach
				</select>
			</div>
	
			<!-- Input BDT (number only) -->
			<div class="form-group">
				<label for="bdt">BDT</label>
				<input type="number" class="form-control" id="bdt" name="bdt" required>
			</div>
	
			<!-- Checkbox DTKS -->
			<div class="form-check">
				<input type="checkbox" class="form-check-input" id="dtks" name="dtks">
				<label class="form-check-label" for="dtks">DTKS</label>
			</div>
	
			<!-- Tombol Submit -->
			<button type="submit" class="btn btn-primary">Simpan</button>
		</form>
	</div>

@endsection