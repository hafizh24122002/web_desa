@extends('layouts/userFormMain')

@section('form')

<div class="row mt-3 container">
    <div class="col-lg">
        <form action="/staf/info-desa/dusun/edit-dusun/{{ $dusun->id }}" method="POST">
            @method('put')
            @csrf

            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama Dusun<span style="color:red">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" name="nama" value="@if(null!==old('nama')){{old('nama')}}@else{{$dusun->nama}}@endif" placeholder="Dusun 1" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="id_kepala_dusun" class="col-sm-3 col-form-label">Kepala Desa<span style="color:red">*</span></label>
                <div class="col-sm-9">
                    <select name="id_kepala_dusun" id="id_kepala_dusun" class="form-control form-control-sm">
                        @foreach ($kepala_dusun as $data)
                        <option value="{{ $data->id }}" @if (old('id_kepala_dusun')==$data->id || (old('id_kepala_dusun') == null && $dusun['id_kepala_dusun'] == $data->id))
                            selected
                            @endif
                            >
                            {{ $data->jabatan.' - '.$data->nama }}
                        </option>

                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="no_telp_dusun" class="col-sm-3 col-form-label">No. Telp Dusun</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" name="no_telp_dusun" value="@if(null!==old('no_telp_dusun')){{old('no_telp_dusun')}}@else{{$dusun->no_telp_dusun}}@endif" placeholder="0210192307" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="jumlah_rt" class="col-sm-3 col-form-label">Jumlah RT</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" name="jumlah_rt" value="@if(null!==old('jumlah_rt')){{old('jumlah_rt')}}@else{{$dusun->jumlah_rt}}@endif" placeholder="5" required>
                </div>
            </div>

            <div class="d-sm-flex justify-content-md-end">
                <button class="btn btn-primary mt-2 mb-4 px-3 py-1">Ubah Data Dusun</button>
            </div>
        </form>
    </div>
</div>

@endsection