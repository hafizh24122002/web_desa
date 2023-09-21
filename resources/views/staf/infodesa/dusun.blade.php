@extends('layouts/adminMain')

@section('main-content')
<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                {{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
                'title' => 'Dusun',
                'current_page' => 'Dusun',
                ])

                {{-- content --}}
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <a href="/staf/info-desa/dusun/new-dusun" style="width: auto" class="btn btn-primary my-2">
                    <i class="bx bx-user-plus align-middle"></i> Tambah Data Dusun
                </a>

                <table class="table table-hover">
                    <thead>
                        <tr class="bg-dark text-light text-center align-middle">
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Nama Dusun</th>
                            <th>Nama Kepala Dusun</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@include('partials.commonScripts')
@endsection