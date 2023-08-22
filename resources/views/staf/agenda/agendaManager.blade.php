@extends('layouts/adminMain')

@section('main-content')
    <section class="wrapper">
        <div class="container-fostrap">
            <div class="content">
                <div class="container">
                    {{-- menu yang di atas --}}
                    @include('partials.adminTopMenu', [
                        'title' => 'Agenda',
                        'parent_page' => 'Manajemen Web',
                        'parent_link' => '/staf/manajemen-web/dashboard',
                        'current_page' => 'Agenda',
                    ])

                    {{-- content --}}
                    
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="box box-info">
                            <div class="box-header with-border">
                                <a href="/staf/manajemen-web/agenda/new-agenda"
                                    class="btn btn-social btn-primary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                                    title="Ubah Data Desa"><i class="fa fa-plus"></i>Tambah Agenda Baru</a>

                            </div>
                            <div class="box-body">

                              
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="bg-dark text-light text-center align-middle">
                                                <th>NO</th>
                                                <th>AKSI</th>
                                                <th>JUDUL</th>
                                                {{-- <th>HIT</th> --}}
												<th>TANGGAL PELAKSANAAN</th>
                                                <th>DIPOSTING PADA</th>
                                                {{-- <th>AKTIF</th> --}}
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($artikel as $key => $item)
                                                <tr class="text-center align-middle">
                                                    <td>{{ $artikel->firstitem() + $key }}</td>

                                                    <td>
                                                        <div style="display: flex; gap: 5px; justify-content: center;">
                                                            <a
                                                                href="/staf/manajemen-web/agenda/edit-agenda/{{ $item->id }}">
                                                                <button class="btn btn-sm btn-warning"
                                                                    data-bs-toggle="tooltip" title="Edit agenda">
                                                                    <i class="bx bx-edit-alt text-light"></i>
                                                                </button>
                                                            </a>

                                                            <form action="/staf/manajemen-web/agenda/{{ $item->id }}"
                                                                onsubmit="return confirm('Apakah anda yakin ingin menghapus artikel dengan judul {{ $item->judul }}? Artikel yang dihapus tidak akan bisa dikembalikan!')"
                                                                method="POST">

                                                                @method('delete')
                                                                @csrf

                                                                <button class="btn btn-sm btn-danger" type="submit"
                                                                    data-bs-toggle="tooltip"title="Hapus agenda">
                                                                    <i class="bx bx-trash text-light"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>

                                                    <td>{{ $item->judul }}</td>

                                                    <td>{{ $item->tgl_agenda }}</td>

                                                    <td>{{ $item->created_at }}</td>

                                                    {{-- <td>
                                                        @if ($item->is_active)
                                                            <i class="bx bx-check fs-4" style="color: green"></i>
                                                        @else
                                                            <i class="bx bx-x fs-4" style="color: red"></i>
                                                        @endif
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                
                                </div>
                            </div>
                        </div>

                       

                        <div class="d-flex justify-content-end">
                            {{ $artikel->links() }}
                        </div>
                    
                </div>
            </div>
        </div>
    </section>

    @include('partials.commonScripts')
@endsection
