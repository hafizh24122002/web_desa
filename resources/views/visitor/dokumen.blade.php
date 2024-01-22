@extends('layouts/visitorMain')

@section('main-content')

<div class="main-content">
    <div class="main-content-body">
        <div class="h2 mt-5">
            Dokumen
        </div>
        <hr>
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr class="table-dark text-center">
                        <th>No</th>
                        <th>File</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($documents as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <strong class="fw-bold text-capitalize"> {{ $item->judul }} </strong>
                            <p>{{ $item->keterangan }}</p>
                        </td>
                        <td class="text-center">
                            <a href="/dokumen/download/{{ strtolower($item->judul) }}">
                                <button type="button" class="btn btn-light btn-sm">
                                    <i class="bi bi-download"></i>
                                    Download
                                </button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $documents->links() }}
            </div>
        </div>
    </div>
</div>

@endsection