@extends('layouts/userFormMain')

@section('form')

<div class="row mt-3 container">

    <table class="table table-hover">
        <thead>
            <tr class="bg-dark text-light text-center align-middle">
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Hubungan</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pendudukDalamKeluarga as $penduduk)
            <tr class="text-center align-middle">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $penduduk->nik }}</td>
                <td>{{ $penduduk->nama }}</td>
                <td>{{ $penduduk->hubunganKK->nama }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-lg">
        <form action="/staf/kependudukan/keluarga/daftar-anggota/{{ $keluarga->no_kk }}/new-anggota/" method="POST">
            @csrf

            <div class="form-group row">
                <label for="nik" class="col-sm-3 col-form-label">NIK / Nama Penduduk (dari penduduk yang tidak memiliki No. KK)<span style="color:red">*</span></label>
                <div class="col-sm-9">
                    <select class="form-select form-select-sm" id="nik" name="nik"">
                        <option value="">-- Pilih --</option>
                        @foreach ($anggota as $item)
                        @if ($item->id_helper_penduduk_keluarga == NULL)
                        <option value=" {{ $item->nik }}">{{ $item->nik }} - {{ $item->nama }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="id_hubungan_kk" class="col-sm-3 col-form-label">Hubungan KK</label>
                <div class="col-sm-9">
                    <select class="form-select form-select-sm" id="grup-input" name="id_hubungan_kk">
                        <option value="">-- Pilih --</option>
                        @foreach ($hubungan_kk as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-sm-flex justify-content-md-end">
                <button class="btn btn-primary mt-2 mb-4 px-3 py-1">Tambah Anggota Keluarga</button>
            </div>
        </form>
    </div>
</div>

@endsection