@extends('layouts/userFormMain')

@section('form')
    <div class="row mt-3 container">
        <div class="col-lg">
            <form action="/staf/kependudukan/rtm/edit-rtm/{{ $rtm->id }}" method="POST">
                @method('put')
                @csrf
                <div class="form-group row">
                    <label for="nik_kepala" class="col-sm-3 col-form-label">NIK Kepala Keluarga<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm" id="nik_kepala" name="nik_kepala">
                            <option value="">-- Pilih --</option>
                            @foreach ($nik_kepala as $item)
                            @if ($item->id_hubungan_kk == 1)
                            <option value=" {{ $item->nik }}">{{ $item->nik }} - {{ $item->nama }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="no_kk" class="col-sm-3 col-form-label">No. KK<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('no_kk') is-invalid @enderror" name="no_kk" placeholder="1903051234567890" value="@if(null!==old('no_kk')){{old('no_kk')}}@else{{$keluarga->no_kk}}@endif" required>

                        @error('no_kk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_kelas_sosial" class="col-sm-3 col-form-label">Kelas Sosial</label>
                    <div class="col-sm-9">
                        <select class="form-select form-select-sm" id="grup-input" name="id_kelas_sosial">
                            <option value="">-- Pilih --</option>
                            @foreach ($kelas_sosial as $item)
                            <option value="{{ $loop->iteration }}" {{ old('id_kelas_sosial', $keluarga->id_kelas_sosial) == $loop->iteration ? "selected":""}}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="alamat" value="@if(null!==old('alamat')){{old('alamat')}}@else{{$keluarga->alamat}}@endif" placeholder="JL. MERPATI NO.51 RT.03/RW.02">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgl_dikeluarkan" class="col-sm-3 col-form-label">Tanggal KK Dikeluarkan</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control form-control-sm" name="tgl_dikeluarkan" value="@if(null!==old('tgl_dikeluarkan')){{old('tgl_dikeluarkan')}}@else{{$keluarga->tgl_dikeluarkan}}@endif">
                    </div>
                </div>

                <div class="d-sm-flex justify-content-md-end">
                    <button class="btn btn-primary mt-2 mb-4 px-3 py-1">Ubah Data Keluarga</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // $(document).ready(function() {
        //     // Menggunakan jQuery untuk mendeteksi saat form disubmit
        //     $('#pendudukForm').on('submit', function(event) {
        //         // Reset semua field yang memiliki class "is-invalid" menjadi normal
        //         $('.grup-input').removeClass('is-invalid');
        //         $('.required-field').removeClass('is-invalid');

        //         // Validasi semua elemen select dengan class grup-input
        //         var selectElements = $('.grup-input');
        //         selectElements.each(function() {
        //             if ($(this).val() === '') {
        //                 $(this).addClass('is-invalid');
        //             }
        //         });

        //         // Validasi semua elemen input dengan class-field
        //         var inputElements = $('.required-field');
        //         inputElements.each(function() {
        //             if ($(this).val() === '') {
        //                 $(this).addClass('is-invalid');
        //             }
        //         });

        //         // Cek apakah ada field yang kosong
        //         if ($('.is-invalid').length > 0) {
        //             // Jika ada, batalkan submit form
        //             event.preventDefault();
        //         }
        //     });

        //     // Menggunakan jQuery untuk mendeteksi perubahan pada elemen select
        //     $('.grup-input').on('change', function() {
        //         if ($(this).val() === '') {
        //             $(this).addClass('is-invalid');
        //         } else {
        //             $(this).removeClass('is-invalid');
        //         }
        //     });

        //     // Menggunakan jQuery untuk mendeteksi perubahan pada elemen input teks
        //     $('.required-field').each('input', function() {
        //         if ($(this).val() === '') {
        //             $(this).addClass('is-invalid');
        //         } else {
        //             $(this).removeClass('is-invalid');
        //         }
        //     });
        // });
    </script>
@endsection
