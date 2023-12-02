@extends('layouts.adminMain')

@section('main-content')
    <section class="wrapper">
        <div class="container-fostrap">
            <div class="content">
                <div class="container">
                    {{-- menu yang di atas --}}
                    @include('partials.adminTopMenu', [
                        'title' => 'Edit Identitas Desa',
                        'current_page' => 'Edit Identitas Desa',
                    ])

                    {{-- content --}}
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <a href="/staf/info-desa/identitas-desa/"
                                class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                                title="Ubah Data Desa"><i class="fa fa-arrow-left"></i>
                                Kembali ke Data Identitas Desa</a>
                        </div>
                        <div class="box-body">
                            <div class="row mt-3 container">
                                <div class="col-6 mb-3 mt-2 ps-0">
                                    <div class="card shadow">
                                        <div class="card-header fw-bold">
                                            <span class="me-2"></span>
                                            Lambang Desa
                                        </div>
                                        <div class="card-body">
                                            <input type="file" class="form-control form-control-sm" id="formFile"
                                                onchange="loadFile(event, 'lambang_desa')" accept="image/*" aria-label="Upload">
                                            <img id="lambang_desa" class="my-2" width="465px" height="auto"/>
                                            <div class="input-group">
                                                <button class="btn btn-outline-secondary btn-sm" type="button"
                                                    id="inputGroupFileAddon04">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 mb-3 mt-2 pe-0">
                                    <div class="card shadow">
                                        <div class="card-header fw-bold">
                                            <span class="me-2"></span>
                                            Kantor Desa
                                        </div>
                                        <div class="card-body">
                                            <input type="file" class="form-control form-control-sm" id="formFile"
                                                onchange="loadFile(event, 'kantor_desa')" accept="image/*" aria-label="Upload">
                                            <img id="kantor_desa" class="my-2" width="465px" height="auto"/>
                                            <div class="input-group">
                                                <button class="btn btn-outline-secondary btn-sm" type="button"
                                                    id="inputGroupFileAddon04">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-12 mb-5">        
                                    <form method="post" action="{{ route('desa.update') }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row shadow p-3">
                                            @php
                                                $fields = [
                                                    'Nama Desa' => 'nama_desa',
                                                    'Kode Desa' => 'kode_desa',
                                                    'Kode Pos' => 'kode_pos_desa',
                                                    'Nama Kepala Desa' => 'nama_kepala_desa',
                                                    'NIP Kepala Desa' => 'nip_kepala_desa',
                                                    'Alamat Kantor' => 'alamat_kantor',
                                                    'Email' => 'email_desa',
                                                    'Telepon' => 'telepon',
                                                    'Website' => 'website',
                                                    'Nama Kecamatan' => 'nama_kecamatan',
                                                    'Kode Kecamatan' => 'kode_kecamatan',
                                                    'Nama Camat' => 'nama_kepala_camat',
                                                    'NIP Camat' => 'nip_kepala_camat',
                                                    'Nama Kabupaten' => 'nama_kabupaten',
                                                    'Kode Kabupaten' => 'kode_kabupaten',
                                                    'Nama Provinsi' => 'nama_provinsi',
                                                    'Kode Provinsi' => 'kode_provinsi',
                                                ];
                                            @endphp

                                            @foreach ($fields as $label => $fieldName)
                                                <label for="{{ $fieldName }}"
                                                    class="col-sm-4 col-form-label">{{ $label }}</label>
                                                <div class="col-sm-8" style="margin-top: 10px;">
                                                    <input type="text" name="{{ $fieldName }}" class="form-control"
                                                        value="{{ $dataDesa->$fieldName }}">
                                                </div>
                                            @endforeach
                                            <div class="button-container mt-3 mb-3">
                                                <a href="{{ route('desa.edit') }}" class="btn btn-secondary">Cancel</a>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
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
        var loadFile = function(event, id) {
            var output = document.getElementById(id);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection
