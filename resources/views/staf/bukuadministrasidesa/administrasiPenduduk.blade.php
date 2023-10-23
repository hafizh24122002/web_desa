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
                    <div class="col-xl-3">
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

                    <div class="col-xl-9">
                        <div class="row justify-content-between">
                            <div class="col-auto">
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

                            <div class="col-auto d-flex mb-3">
                                <select name="month" id="month" class="form-select form-select-sm me-2" style="width: 7rem">
                                    @for ($i = 1; $i <= 12; $i++) 
                                        <option value="{{ $i }}"
                                            @if ($i === \Carbon\Carbon::now()->month)
                                                selected
                                            @endif>

                                            {{ \Carbon\Carbon::create(null, $i, 1)->translatedFormat('F') }}
                                        </option>
                                    @endfor
                                </select>

                                <select name="year" id="year" class="form-select form-select-sm" style="width: 7rem">
                                    @for ($year = $earliestYear; $year <= \Carbon\Carbon::now()->year; $year++)
                                        <option value="{{ $year }}"
                                            @if ($year === \Carbon\Carbon::now()->year)
                                                selected
                                            @endif>

                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="input-group" id="nama-search">
                                <input type="search" name="nama" id="nama" class="form-control" placeholder="Cari berdasarkan Nama" aria-label="Cari" />
                                <button type="button" id="nama-search-btn" class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                        <div class="mt-2" id="table-container">
                            {{-- tabel yang akan ditampilkan berdasarkan item yang dipilih --}}
                            
                            {{-- tampilan tabel default --}}
                            @include('staf.bukuadministrasidesa.partials.indukKependudukan')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const listItems = document.querySelectorAll('.list-group-item');
        listItems.forEach(item => {
            item.addEventListener('click', function() {
                const itemType = this.getAttribute('data-type');
                const itemMonth = document.getElementById('month').value;
                const itemYear = document.getElementById('year').value;
                const itemNama = document.getElementById('nama').value;

                if (itemType === 'rekapitulasiJumlahPenduduk') {
                    if ($('#nama-search').is(':visible')) {
                        $('#nama').prop('disabled', true);
                        $('#nama-search').delay(300).slideUp();
                    }
                } else {
                    if ($('#nama-search').is(':hidden')) {
                        $('#nama-search').delay(300).slideDown();
                        $('#nama').prop('disabled', false);
                    }
                }

                setActiveItem(this);
                fetchData(itemType, itemMonth, itemYear, itemNama);
            });
        });

        $('#month, #year').change(function () {
            const itemType = document.querySelector('.list-group-item.active').getAttribute('data-type');
            const itemMonth = document.getElementById('month').value;
            const itemYear = document.getElementById('year').value;
            const itemNama = document.getElementById('nama').value;

            fetchData(itemType, itemMonth, itemYear, itemNama);
        });

        const searchButton = document.getElementById('nama-search-btn');
        searchButton.addEventListener('click', function() {
            const itemType = document.querySelector('.list-group-item.active').getAttribute('data-type');
            const itemMonth = document.getElementById('month').value;
            const itemYear = document.getElementById('year').value;
            const itemNama = document.getElementById('nama').value;

            fetchData(itemType, itemMonth, itemYear, itemNama);
        });

        // Function to set the active item
        function setActiveItem(selectedItem) {
            listItems.forEach(item => {
                item.classList.remove('active');
            });
            selectedItem.classList.add('active');
        }

        // Function to fetch and render the selected view
        function fetchData(type, month, year, nama) {
            const tableContainer = document.getElementById('table-container');
            tableContainer.classList.add('hidden');

            // Create an object to hold the query parameters
            const params = {
                month: month,
                year: year,
                nama: nama
            };
            
            axios.get(`/staf/buku-administrasi-desa/get-data/${type}`, {params: params})
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