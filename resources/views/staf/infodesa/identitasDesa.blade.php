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
                <div class="box box-info">
                    <div class="box-header with-border">
                        <a href="/staf/info-desa/identitas-desa/form"
                            class="btn btn-social btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                            title="Ubah Data Desa"><i class="fa fa-edit"></i> Ubah
                            Data Desa</a>
                        <a href="#"
                            class="btn btn-social btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                            title="Lokasi Kantor Desa"><i
                                class='fa fa-map-marker'></i> Lokasi Kantor Desa</a>
                        <a href="#"
                            class="btn btn-social btn-primary btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                            title="Peta Wilayah Desa"><i class='fa fa-map'></i>
                            Peta Wilayah Desa</a>
                    </div>
                    <div class="box-body">
                        <div class="box-body bg-identitas">
                            <img class="img-identitas img-responsive" src="#{{-- Gambar --}}" alt="logo">
                            <h3 class="text-identitas">DESA MALIK</h3>
                            <p class="text-identitas">
                                <b>Kecamatan Payung, Kabupaten Bangka Selatan</b>
                            </p>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover tabel-rincian">
                                <tbody>
                                    <tr class="table-primary">
                                        <th colspan="3" class="subtitle_head"><strong>DESA</strong></th>
                                    </tr>
                                    <tr>
                                        <td width="300">Nama Desa</td>
                                        <td width="1">:</td>
                                        <td>Malik</td>
                                    </tr>
                                    <tr>
                                        <td>Kode Desa</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Kode Pos Desa</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Lurah</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>NIP Lurah</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Kantor Desa</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>E-Mail Desa</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Telpon Desa</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Website Desa</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr class = "table-primary">
                                        <th colspan="3" class="subtitle_head"><strong>KECAMATAN</strong></th>
                                    </tr>
                                    <tr>
                                        <td>Nama Kecamatan</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Kode Kecamatan</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Camat</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>NIP Camat</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr class = "table-primary">
                                        <th colspan="3" class="subtitle_head"><strong>KABUPATEN</strong></th>
                                    </tr>
                                    <tr>
                                        <td>Nama Kabupaten</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Kode Kabupaten</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr class = "table-primary">
                                        <th colspan="3" class="subtitle_head"><strong>PROVINSI</strong></th>
                                    </tr>
                                    <tr>
                                        <td>Nama Provinsi</td>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Kode Provinsi</td>
                                        <td>:</td>
                                        <td></td>
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