@extends('layouts/adminMain')

@section('main-content')

<link rel="stylesheet" href="{{ asset('css/bukuAdministrasiPendudukStyle.css') }}">
@include('partials.commonScripts')

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                {{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
                'title' => 'Buku Administrasi Penduduk',
                'current_page' => 'Buku Administrasi Penduduk',
                ])

                {{-- content --}}
                <div class="row mt-3">
                    <div class="col float-start me-2">
                        <div class="card rounded">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item active" data-type="indukKependudukan">Buku Induk Kependudukan</li>
                                <li class="list-group-item" data-type="mutasiPendudukDesa">Buku Mutasi Penduduk Desa</li>
                                <li class="list-group-item" data-type="rekapitulasiJumlahPenduduk">Buku Rekapitulasi Jumlah Penduduk</li>
                                <li class="list-group-item" data-type="pendudukSementara">Buku Penduduk Sementara</li>
                                <li class="list-group-item" data-type="ktpKk">Buku KTP dan KK</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-9">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <a href="#"
                                    class="btn btn-social btn-primary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block me-2"
                                    title="Cetak Buku Induk Penduduk" data-remote="false" data-toggle="modal"
                                    data-target="#modalBox" data-title="Cetak Buku Induk Penduduk"><i
                                        class="fa fa-print "></i> Cetak</a>
                                <a href="/penduduk/unduh" title="Unduh Buku Induk Penduduk"
                                    class="btn btn-social btn-primary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                                    title="Unduh Buku Induk Penduduk" data-remote="false" data-toggle="modal"
                                    data-target="#modalBox" data-title="Unduh Buku Induk Penduduk"><i
                                        class="fa fa-download"></i> Unduh</a>
                            </div>

                            <div class="box-body mt-2" id="table-container">
                                {{-- tabel yang akan ditampilkan berdasarkan item yang dipilih --}}
                                
                                {{-- tampilan tabel default --}}
                                @include('staf.bukuadministrasidesa.partials.indukKependudukan')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // JavaScript to handle list item clicks
    document.addEventListener('DOMContentLoaded', function() {
        const listItems = document.querySelectorAll('.list-group-item');
        listItems.forEach(item => {
            item.addEventListener('click', function() {
                const itemType = this.getAttribute('data-type');
                setActiveItem(this);
                fetchData(itemType);
            });
        });

        // Function to set the active item
        function setActiveItem(selectedItem) {
            listItems.forEach(item => {
                item.classList.remove('active');
            });
            selectedItem.classList.add('active');
        }

        // Function to fetch and render the selected view
        function fetchData(type) {
            const tableContainer = document.getElementById('table-container');
            tableContainer.classList.add('hidden');
            
            axios.get(`/staf/buku-administrasi-desa/get-data/${type}`)
                .then(response => {
                    // Delay rendering the new content slightly to allow the fade-out effect
                    setTimeout(() => {
                        // Render the selected view in the container
                        tableContainer.innerHTML = response.data;

                        // After rendering, remove the "hidden" class to show the new content with a smooth fade-in effect
                        tableContainer.classList.remove('hidden');
                    }, 0); // Adjust this delay as needed
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });
</script>

@endsection