@extends('layouts/userFormMain')

@section('form')
<div class="row mt-3 container">
    <div class="col-lg">
        <form action="/staf/kependudukan/keluarga/new-keluarga" method="POST">
            @csrf

            <div class="form-group row">
                <label for="nik_kepala" class="col-sm-3 col-form-label">NIK Kepala Keluarga<span style="color:red">*</span></label>
                <div class="col-sm-9">
                    <select class="form-select form-select-sm" id="nik_kepala" name="nik_kepala" data-nik-kepala="{{ $nik_kepala }}">
                        <option value="">-- Pilih --</option>
                        @foreach ($nik_kepala as $item)
                        @if ($item->id_hubungan_kk == 1)
                        <option value="{{ $item->nik }}">{{ $item->nik }} - {{ $item->nama }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="no_kk" class="col-sm-3 col-form-label">No. KK</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" name="no_kk" id="no_kk" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="id_kelas_sosial" class="col-sm-3 col-form-label">Kelas Sosial</label>
                <div class="col-sm-9">
                    <select class="form-select form-select-sm" id="grup-input" name="id_kelas_sosial">
                        <option value="">-- Pilih --</option>
                        @foreach ($kelas_sosial as $item)
                        <option value="{{ $loop->iteration }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" name="alamat"
                        placeholder="JL. MERPATI NO.51 RT.03/RW.02">
                </div>
            </div>

            <div class="form-group row">
                <label for="tgl_dikeluarkan" class="col-sm-3 col-form-label">Tanggal KK Dikeluarkan</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control form-control-sm" name="tgl_dikeluarkan">
                </div>
            </div>

            <div class="d-sm-flex justify-content-md-end">
                <button class="btn btn-primary mt-2 mb-4 px-3 py-1">Tambah Data Keluarga</button>
            </div>
        </form>
    </div>
</div>

<script>
    var nikKepalaField = document.getElementById("nik_kepala");
    var noKKField = document.getElementById("no_kk");

    nikKepalaField.addEventListener("change", function () {
        var selectedNik = nikKepalaField.value;
        var nikKepalaData = JSON.parse(nikKepalaField.getAttribute('data-nik-kepala'));

        var kepalaKeluarga = nikKepalaData.find(function(item) {
            return item.nik === selectedNik;
        });

        noKKField.value = kepalaKeluarga ? kepalaKeluarga.no_kk : '';
        namaKepalaField.value = kepalaKeluarga ? kepalaKeluarga.nama : '';
    });
</script>

@endsection
