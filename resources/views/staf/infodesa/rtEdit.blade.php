@extends('layouts/userFormMain')

@section('form')

<div class="row mt-3 container">
    <div class="col-lg">
        <form action="/staf/info-desa/rt/edit-rt/{{ $rt->id }}" method="POST">
            @method('put')
            @csrf

            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama RT<span style="color:red">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" name="nama" value="@if(null!==old('nama')){{old('nama')}}@else{{$rt->nama}}@endif" placeholder="Dusun 1" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="id_kepala_dusun" class="col-sm-3 col-form-label">Ketua RT<span style="color:red">*</span></label>
                <div class="col-sm-9">
                    <select name="nik_kepala" id="nik_kepala" class="form-control form-control-sm">
                    <option value="">-- Pilih --</option>
                        @foreach ($penduduk as $data)
                        @if((!collect($helper_rt)->contains('nik_kepala', $data->nik) || $data->id_wilayah_dusun == $rt->id_helper_rt) && (!collect($helper_dusun)->contains('nik_kepala', $data->nik) || $data->id_wilayah_dusun == $id_dusun))
                        <option value="{{ $data->nik }}"
                            >
                            {{ $data->nik.' - '.$data->nama }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-sm-flex justify-content-md-end">
                <button class="btn btn-primary mt-2 mb-4 px-3 py-1">Ubah Data RT</button>
            </div>
        </form>
    </div>
</div>

@endsection