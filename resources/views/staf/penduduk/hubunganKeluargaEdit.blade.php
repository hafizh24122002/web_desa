@extends('layouts/userFormMain')

@section('form')

<div class="row mt-3 container">

    <table class="table table-hover">
        <thead>
            <tr class="bg-dark text-light text-center align-middle">
                <th>NIK</th>
                <th>Nama</th>
            </tr>
        </thead>

        <tbody>
            <tr class="text-center align-middle">
                <td>{{ $penduduk->nik }}</td>
                <td>{{ $penduduk->nama }}</td>
            </tr>
        </tbody>
    </table>
    <div class="col-lg">
        <form action="/staf/kependudukan/keluarga/daftar-anggota/edit-hubungan/{{ $penduduk->nik }}" method="POST">
            @csrf
            @method('put')

            <div class="form-group row">
                <label for="id_kelas_sosial" class="col-sm-3 col-form-label">Hubungan KK</label>
                <div class="col-sm-9">
					<select class="form-select form-select-sm" id="grup-input" name="id_hubungan_kk">
						@foreach ($hubungan_kk as $item)
							<option value="{{ $loop->iteration }}" {{ old('id_hubungan_kk', $penduduk->id_hubungan_kk) == $loop->iteration ? "selected":"" }}>{{ $item->nama }}</option>
						@endforeach
					</select>
				</div>
            </div>

            <div class="d-sm-flex justify-content-md-end">
                <button class="btn btn-primary mt-2 mb-4 px-3 py-1">Ubah Hubungan Keluarga</button>
            </div>
        </form>
    </div>
</div>

@endsection