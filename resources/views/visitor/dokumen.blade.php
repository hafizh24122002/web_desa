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
                    <tr class="table-dark">
                        <th>File</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr>
                        <td>
                            <strong>File Name</strong>
                            <p>File Description</p>
                        </td>
                        <td>
                            <button type="button" class="btn btn-light btn-sm">
                                <i class="bi bi-download"></i> 
                                Download
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection