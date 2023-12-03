@extends('layouts/adminMain')

@section('main-content')
    <section class="wrapper">
        <div class="container-fostrap">
            <div class="content">
                <div class="container">
                    {{-- menu yang di atas --}}
                    @include('partials.adminTopMenu', [
                        'title' => 'Identitas Desa',
                        'current_page' => 'Identitas Desa',
                        // 'parent_page' => 'Identitas Desa',
                        // 'parent_link' => '/admin/identitas-desa',
                    ])

                    {{-- content --}}
                    @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <a href="/staf/info-desa/identitas-desa/edit"
                                class="btn btn-social btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                                title="Ubah Data Desa"><i class="fa fa-edit"></i> Ubah
                                Data Desa</a>
                            <a href="{{ route('desa.kantorDesa') }}"
                                class="btn btn-social btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                                title="Lokasi Kantor Desa"><i class='fa fa-map-marker'></i> Lokasi Kantor Desa</a>
                            <a href="{{ route('desa.petaWilayah') }}"
                                class="btn btn-social btn-primary btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                                title="Peta Wilayah Desa"><i class='fa fa-map'></i>
                                Peta Wilayah Desa</a>
                        </div>
                        <div class="box-body">
                            
                            <div class="box-body bg-identitas" style="margin-top: 10px;">
                                <tr>
                                <div class="row">
                                    <div class="card-body">
                                        <center>
                                            <img class="img-identitas img-responsive mx-2" src="{{ $lambangUrl }}" alt="logo"
                                                style="width: auto; max-height: 200px;">
                                            <img class="img-identitas img-responsive mx-2" src="{{ $kantorUrl }}" alt="kantor"
                                                style="width: auto; max-height: 200px;">
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        
                                    </div>
                                </div>
                                </tr>
                                <h3 class="text-identitas">DESA {{ strtoupper($dataDesa->nama_desa) }}</h3>
                                <p class="text-identitas">
                                    <b>Kecamatan {{ $dataDesa->nama_kecamatan }}, Kabupaten {{ $dataDesa->nama_kabupaten }}</b>
                                </p>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                        <tr class="bg-dark  align-middle">
                                            <th colspan="3" class="text-light"><strong>DESA</strong></th>
                                        </tr>
                                        <tr>
                                            <td width="300">Nama Desa</td>
                                            <td width="1">:</td>
                                            <td>{{ $dataDesa->nama_desa }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kode Desa</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->kode_desa }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kode Pos Desa</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->kode_pos_desa }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Kepala Desa</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->nama_kepala_desa }}</td>
                                        </tr>
                                        <tr>
                                            <td>NIP Kepala Desa</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->nip_kepala_desa }}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Kantor Desa</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->alamat_kantor }}</td>
                                        </tr>
                                        <tr>
                                            <td>E-Mail Desa</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->email_desa }}</td>
                                        </tr>
                                        <tr>
                                            <td>Telpon Desa</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->telepon }}</td>
                                        </tr>
                                        <tr>
                                            <td>Website Desa</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->website }}</td>
                                        </tr>
                                        <tr class="bg-dark  align-middle">
                                            <th colspan="3" class="text-light"><strong>KECAMATAN</strong></th>
                                        </tr>
                                        <tr>
                                            <td>Nama Kecamatan</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->nama_kecamatan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kode Kecamatan</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->kode_kecamatan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Camat</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->nama_kepala_camat }}</td>
                                        </tr>
                                        <tr>
                                            <td>NIP Camat</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->nip_kepala_camat }}</td>
                                        </tr>
                                        <tr class="bg-dark  align-middle">
                                            <th colspan="3" class="text-light"><strong>KABUPATEN</strong></th>
                                        </tr>
                                        <tr>
                                            <td>Nama Kabupaten</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->nama_kabupaten }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kode Kabupaten</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->kode_kabupaten }}</td>
                                        </tr>
                                        <tr class="bg-dark  align-middle">
                                            <th colspan="3" class="text-light"><strong>PROVINSI</strong></th>
                                        </tr>
                                        <tr>
                                            <td>Nama Provinsi</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->nama_provinsi }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kode Provinsi</td>
                                            <td>:</td>
                                            <td>{{ $dataDesa->kode_provinsi }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.commonScripts')
@endsection
