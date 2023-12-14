@extends('layouts/adminMain')

@section('main-content')
    <section class="wrapper">
        <div class="container-fostrap">
            <div class="content">
                <div class="container">
                    {{-- menu yang di atas --}}
                    @include('partials.adminTopMenu', [
                        'current_page' => 'Daftar RT - ' . $dusun->nama,
                    ])

                    {{-- content --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="/staf/info-desa/rt/new-rt/{{$dusun->id}}" style="width: auto" class="btn btn-primary my-2">
                        <i class="bx bx-user-plus align-middle"></i> Tambah Data RT
                    </a>

                    <a href="/staf/info-desa/dusun/" style="width: auto" class="btn btn-success my-2">
						<i class="bi bi-arrow-left-circle align-middle"></i> Kembali ke Daftar Dusun
					</a>

                    <table class="table table-hover">
                        <thead>
                            <tr class="bg-dark text-light text-center align-middle">
                                <th>No</th>
                                <th>Aksi</th>
                                <th>RT</th>
                                <th>Ketua RT</th>
                                <th>NIK Ketua RT</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($rt as $key => $data)
                                <tr class="align-middle text-center">
                                    <td class="text-center">{{ $rt->firstitem() + $key }}</td>

                                    <td class="d-flex gap-1 justify-content-center">
                                        <a href="/staf/info-desa/rt/edit-rt/{{ $data->id_helper_rt }}">
                                            <button class="btn btn-sm btn-warning">
                                                <i class="bx bx-edit-alt text-light"></i>
                                            </button>
                                        </a>

                                        <form action="/staf/info-desa/rt/{{ $dusun->id }}/{{ $data->id_helper_rt }}"
                                            onsubmit="return confirm('Apakah anda yakin ingin menghapus RT ini? RT yang dihapus tidak akan bisa dikembalikan!')"
                                            method="POST">

                                            @method('delete')
                                            @csrf

                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <i class="bx bx-trash text-light"></i>
                                            </button>
                                        </form>
                                    </td>

                                    <td> {{ $data->nama_rt ?? ' ' }} </td>
                                    <td> {{ $data->nama_kepala_rt ?? ' ' }} </td>
                                    <td> {{ $data->nik_kepala ?? ' ' }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end">
                        {{ $rt->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.commonScripts')
@endsection
