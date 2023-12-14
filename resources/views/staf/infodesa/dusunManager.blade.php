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
                            <th>Kepala Dusun</th>
                            <th>Jumlah RT</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($dusun as $key => $data)
                        <tr class="align-middle text-center">
                            <td class="text-center">{{ $dusun->firstitem() + $key }}</td>

                            <td class="d-flex gap-1 justify-content-center">
                                <a href="/staf/info-desa/rt/{{ $data->id_dusun }}">
                                    <button class="btn btn-sm btn-primary" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Daftar RT">
                                        <i class="bx bx-list-ul text-light"></i>
                                    </button>
                                </a>

                                <a href="/staf/info-desa/dusun/edit-dusun/{{ $data->id_dusun }}">
                                    <button class="btn btn-sm btn-warning" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Edit Data Dusun">
                                        <i class="bx bx-edit-alt text-light"></i>
                                    </button>
                                </a>

                                <form action="/staf/info-desa/dusun/{{ $data->id_helper }}" onsubmit="return confirm('Apakah anda yakin ingin menghapus dusun ini? Dusun yang dihapus tidak akan bisa dikembalikan!')" method="POST">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-sm btn-danger" type="submit" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Hapus Data Dusun">
                                        <i class="bx bx-trash text-light"></i>
                                    </button>
                                </form>
                            </td>

                            <td> {{ $data->nama_dusun ?? ' ' }} </td>
                            <td> {{ $data->nama_kepala_dusun ?? ' ' }} </td>
                            <td> {{ $data->jumlah_rt ?? ' ' }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-end">
                    {{ $dusun->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.commonScripts')
@endsection