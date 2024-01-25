@extends('layouts/userFormMain')

@section('form')
<div class="mt-3 container">
	<a href="/admin/dashboard"
		class="btn btn-info btn-sm mb-4">

		<i class="fa fa-arrow-left"></i> Kembali ke Dashboard
	</a>

	<div class="d-flex justify-content-center mt-2">
		<img src="data:image/png;base64, {!! base64_encode($qr) !!}">
	</div>

	<form action="/staf/download-qr" method="POST" autocomplete="off" id="form" class="d-flex justify-content-center">
		@csrf

		<input type="hidden" name="qr" value="{!! base64_encode($qr) !!}">
		<button class="btn btn-primary mt-4 mb-4"><i class="fa-solid fa-download"></i> Download Kode QR</button>
	</form>
</div>

<script>
	var loadFile = function(event, id) {
		var output = document.getElementById(id);
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};
</script>

@endsection