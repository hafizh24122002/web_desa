@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                {{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
					'title' => 'Dashboard',
					'current_page' => 'Dashboard',
					])

                {{-- card --}}
                <div class="row mt-3">
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="card text-white bg-primary mb-3 rounded">
                            <div class="card-content">
                                <h4 class="card-title">
                                    3
                                </h4>
                                <p class="card-text">
                                    Wilayah Desa
                                </p>
                                <div class="icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                            </div>
                            <div class="card-read-more">
                                <a href="#" class="btn btn-link btn-block">
                                    Lihat Detail
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="card text-white bg-success mb-3 rounded">
                            <div class="card-content">
                                <h4 class="card-title">
                                    3
                                </h4>
                                <p class="card-text">
                                    Wilayah Desa
                                </p>
                                <div class="icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                            </div>
                            <div class="card-read-more">
                                <a href="#" class="btn btn-link btn-block">
                                    Lihat Detail
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="card text-white bg-info mb-3 rounded">
                            <div class="card-content">
                                <h4 class="card-title">
                                    3
                                </h4>
                                <p class="card-text">
                                    Wilayah Desa
                                </p>
                                <div class="icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                            </div>
                            <div class="card-read-more">
                                <a href="#" class="btn btn-link btn-block">
                                    Lihat Detail
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="card text-white bg-warning mb-3 rounded">
                            <div class="card-content">
                                <h4 class="card-title">
                                    3
                                </h4>
                                <p class="card-text">
                                    Wilayah Desa
                                </p>
                                <div class="icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                            </div>
                            <div class="card-read-more">
                                <a href="#" class="btn btn-link btn-block">
                                    Lihat Detail
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="card text-white bg-danger mb-3 rounded">
                            <div class="card-content">
                                <h4 class="card-title">
                                    3
                                </h4>
                                <p class="card-text">
                                    Wilayah Desa
                                </p>
                                <div class="icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                            </div>
                            <div class="card-read-more">
                                <a href="#" class="btn btn-link btn-block">
                                    Lihat Detail
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="card text-white bg-dark mb-3 rounded">
                            <div class="card-content">
                                <h4 class="card-title">
                                    3
                                </h4>
                                <p class="card-text">
                                    Wilayah Desa
                                </p>
                                <div class="icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                            </div>
                            <div class="card-read-more">
                                <a href="#" class="btn btn-link btn-block">
                                    Lihat Detail
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection