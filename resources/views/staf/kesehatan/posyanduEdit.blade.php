@extends('layouts/userFormMain')

@section('form')

<div class="row mt-3 container">
	<div class="col-lg">
		<form action="/staf/kesehatan/posyandu/edit-posyandu/{{ $posyandu->id }}" method="POST">
			@method('put')
			@csrf

			<div class="form-group row">
				<label for="nama" class="col-sm-3 col-form-label">Nama Posyandu</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="nama"
						value="@if(null!==old('nama')){{old('nama')}}@else{{$posyandu->nama}}@endif"
						placeholder="Posyandu Bakti Sehat"
						required>
				</div>
			</div>

			<div class="form-group row">
				<label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control form-control-sm"
						name="alamat"
						value="@if(null!==old('alamat')){{old('alamat')}}@else{{$posyandu->alamat}}@endif"
						placeholder="JL. MERPATI NO.51 RT.03/RW.02"
						required>
				</div>
			</div>

			<div class="d-sm-flex justify-content-md-end">
				<button class="btn btn-primary mt-2 mb-4 px-3 py-1">Ubah Data Posyandu</button>
			</div>
		</form>
	</div>
</div>

@endsection
