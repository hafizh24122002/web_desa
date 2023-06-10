@extends('layouts/adminMain')

@section('main-content')
<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                {{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
                'title' => 'Identitas Desa',
                'current_page' => 'Ubah Data',
                'parent_page' => 'Identitas Desa',
                'parent_link' => '/admin/identitas-desa',
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
                        <hr>
                        <div class="row mt-3 container">
                            <div class="col-lg-4">
                                <h5>Lambang Desa</h5>
                                <img id="frame" src="" class="img-fluid" />
                                <div class="input-group">
                                    <input type="file" class="form-control form-control-sm" id="formFile"
                                        onchange="preview()" aria-label="Upload">
                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                        id="inputGroupFileAddon04">Upload</button>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <form>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Desa</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail3"
                                                placeholder="Nama Desa">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Kode Desa</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputPassword3"
                                                placeholder="Kode Desa">
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
</section>
@endsection