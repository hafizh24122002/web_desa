@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                {{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
                'title' => 'Buku Administrasi Penduduk',
                'current_page' => 'Buku Administrasi Penduduk',
                ])
                {{-- content --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="accordion" id="statistikBar">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="statistikHeading">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#statistikPenduduk" aria-expanded="true"
                                            aria-controls="statistikPenduduk">
                                            Buku Administrasi Penduduk
                                        </button>
                                    </h2>
                                    <div id="statistikPenduduk" class="accordion-collapse collapse show"
                                        aria-labelledby="statistikHeading" data-bs-parent="#statistikBar">
                                        <div class="list-group">
                                            <!-- <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                                    The current link item
                                                </a> -->
                                            <a href="#" class="list-group-item list-group-item-action">Buku Induk
                                                Kependudukan</a>
                                            <a href="#" class="list-group-item list-group-item-action">Buku Mutasi
                                                Penduduk Desa</a>
                                            <a href="#" class="list-group-item list-group-item-action">Buku Rekapitulasi
                                                Jumlah Penduduk</a>
                                            <a href="#" class="list-group-item list-group-item-action">Buku Penduduk
                                                Sementara</a>
                                            <a href="#" class="list-group-item list-group-item-action">Buku KTP dan
                                                KK</a>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="col-md-8">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <a href="#"
                                        class="btn btn-social btn-light btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                                        title="Cetak Buku Induk Penduduk" data-remote="false" data-toggle="modal"
                                        data-target="#modalBox" data-title="Cetak Buku Induk Penduduk"><i
                                            class="fa fa-print "></i> Cetak</a>
                                    <a href="#" title="Unduh Buku Induk Penduduk"
                                        class="btn btn-social btn-light btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                                        title="Unduh Buku Induk Penduduk" data-remote="false" data-toggle="modal"
                                        data-target="#modalBox" data-title="Unduh Buku Induk Penduduk"><i
                                            class="fa fa-download"></i> Unduh</a>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive table-min-height">
                                        <table
                                            class="table table-condensed table-bordered dataTable table-striped table-hover tabel-daftar table text-nowrap ">
                                            <thead class="bg-gray color-palette">
                                                <tr class="bg-dark text-light text-center align-middle">
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2">Nama Lengkap / Panggilan</th>
                                                    <th rowspan="2">NIK</th>
                                                    <th colspan="2">Tempat & Tanggal Lahir</th>
                                                    <th rowspan="2">Jenis Kelamin</th>
                                                    <th rowspan="2">SHDK</th>
                                                    <th rowspan="2">Agama</th>
                                                    <th rowspan="2">Pendidikan Terakhir</th>
                                                    <th rowspan="2">Pekerjaan</th>
                                                    <th colspan="2">Nama Orang Tua Kandung</th>
                                                </tr>
                                                <tr class="bg-dark text-light text-center align-middle">
                                                    <th>Tempat Lahir</th>
                                                    <th width="50px">Tgl</th>
                                                    <th>Ayah</th>
                                                    <th>Ibu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($penduduk as $key => $data)
                                                <tr class="text-center align-middle">
                                                    <td>{{ $penduduk->firstItem() + $key }}</td>

                                                    <td class="d-flex gap-1 justify-content-center">
                                                        @if ($data->nama)
                                                        {{ $data->nama }}
                                                        @else
                                                        {{ "-" }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($data->nik)
                                                        {{ $data->nik }}
                                                        @else
                                                        {{ "-" }}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        {{ $data->tempat_lahir }}
                                                    </td>

                                                    <td>
                                                        {{ $data->tanggal_lahir }}
                                                    </td>

                                                    <td>@if ($data->jenis_kelamin === 'L')
                                                        {{ "Laki-laki" }}
                                                        @elseif ($data->jenis_kelamin === 'P')
                                                        {{ "Perempuan" }}
                                                        @else
                                                        {{ "-" }}
                                                        @endif</td>

                                                    <td>
                                                        @if ($data->status)
                                                        {{ $data->status }}
                                                        @else
                                                        {{ "-" }}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($data->id_agama)
                                                        {{ $data->id_agama }}
                                                        @else
                                                        {{ "-" }}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($data->id_pendidikan_terakhir)
                                                        {{ $data->id_pendidikan_terakhir }}
                                                        @else
                                                        {{ "-" }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($data->id_pekerjaan)
                                                        {{ ($data->id_pekerjaan) }}
                                                        @else
                                                        {{ "-" }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{-- @if ($data->nik_ayah)
                                                        {{ ($data->nik_ayah) }}
                                                        @else
                                                        {{ "-" }}
                                                        @endif --}}
                                                    </td>
                                                    <td>
                                                        {{-- @if ($data->nik_ibu)
                                                        {{ ($data->nik_ibu) }}
                                                        @else
                                                        {{ "-" }}
                                                        @endif --}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    {{ $penduduk->links() }}

                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</section>

@include('partials.commonScripts')
<script>
    function showTable(tableNumber) {
  // Hide all tables
  $('.table').hide();

  // Show the selected table
  var selectedTable = $('#table' + tableNumber);
  if (selectedTable.length) {
    selectedTable.show();
  }
}
</script>


@endsection