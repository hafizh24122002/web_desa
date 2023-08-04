@extends('layouts/adminMain')

@section('main-content')

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                {{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
                'title' => 'Statistik Kependudukan',
                'current_page' => 'Statistik Kependudukan',
                ])

                {{-- content --}}
                <div class="row mt-3 container">
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" style="width: 100%" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="row mt-3 container">
                        <div class="col-lg-4">
                            <div class="accordion" id="statistikBar">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="statistikHeading">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#statistikPenduduk" aria-expanded="true" aria-controls="statistikPenduduk">
                                            Statistik Penduduk
                                        </button>
                                    </h2>
                                    <div id="statistikPenduduk" class="accordion-collapse collapse show" aria-labelledby="statistikHeading" data-bs-parent="#statistikBar">
                                        <div class="list-group">
                                            <!-- <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                                The current link item
                                            </a> -->
                                            <a href="#" class="list-group-item list-group-item-action" onclick="showSection(1)">Jenis Kelamin</a>
                                            <a href="#" class="list-group-item list-group-item-action" onclick="showSection(2)">Agama</a>
                                            <a href="#" class="list-group-item list-group-item-action" onclick="showSection(3)">Pekerjaan</a>
                                            <a href="#" class="list-group-item list-group-item-action" onclick="showSection(4)">Status Penduduk</a>
                                            <a href="#" class="list-group-item list-group-item-action" onclick="showSection(5)">Pendidikan Terakhir</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="statistikHeading">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#statistikKeluarga" aria-expanded="true" aria-controls="statistikKeluarga">
                                            Statistik Keluarga
                                        </button>
                                    </h2>
                                    <div id="statistikKeluarga" class="accordion-collapse collapse show" aria-labelledby="statistikHeading" data-bs-parent="#statistikBar">
                                        <div class="list-group">
                                            <!-- <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                                The current link item
                                            </a> -->
                                            <a href="#" class="list-group-item list-group-item-action" onclick="showSection(6)">Kelas Sosial</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <!-- <a href="/staf/kependudukan/penduduk/new-penduduk" style="width: auto" class="btn btn-primary my-2">
                                <i class="bx bx-user-plus align-middle"></i> Tambah Data Penduduk Baru
                            </a> -->

                            <!-- Tabel 1 - Jenis Kelamin -->
                            <div class="section" id="section1" style="display: none;">
                                <div class="mb-4">
                                    <button type="button" class="btn btn-success btn-sm">
                                        <i class="bi bi-bar-chart-line-fill align-middle"></i> Grafik Data
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pie-chart-fill align-middle"></i> Pie Data
                                    </button>
                                </div>
                                <h5 class="text-center">Data Kependudukan berdasarkan Jenis Kelamin</h5>
                                <canvas id="pieChart" style="display: none;"></canvas>
                                <canvas id="barChart" style="display: none;"></canvas>
                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                        <tr class="bg-dark text-light text-center align-middle">
                                            <th>No</th>
                                            <th>Jenis Kelompok</th>
                                            <th colspan="2">Jumlah</th>
                                        </tr>
                                    </thead>

                                    @php
                                    $counterGender = array_fill(0, 2, 0);
                                    $percentageGender = array_fill(0, 2, 0);
                                    $total = 0;
                                    $total_percentage = 0;
                                    @endphp

                                    @foreach ($penduduk as $data)
                                    @php
                                    if($data->jenis_kelamin === 'L'){
                                    $counterGender[0]++;
                                    }
                                    else if($data->jenis_kelamin === 'P'){
                                    $counterGender[1]++;
                                    }

                                    $total = array_sum($counterGender);
                                    for($i = 0; $i < 2; $i++){ 
                                        $percentageGender[$i]=($counterGender[$i] / $total) * 100; 
                                    } 
                                    $total_percentage=($total / $total) * 100; 
                                    @endphp 
                                    @endforeach 
                                    <tbody class=text-nowrap>
                                        <tr class="text-center align-middle">
                                            <td>1</td>
                                            <td class="text-start">LAKI-LAKI</td>
                                            <td>
                                                {{ $counterGender[0] }}
                                            </td>
                                            <td>
                                                {{ number_format($percentageGender[0], 2) }}%
                                            </td>
                                        </tr>
                                        <tr class="text-center align-middle">
                                            <td>2</td>
                                            <td class="text-start">PEREMPUAN</td>
                                            <td>
                                                {{ $counterGender[1] }}
                                            </td>
                                            <td>
                                                {{ number_format($percentageGender[1], 2) }}%
                                            </td>
                                        </tr>
                                        <tr class="text-center align-middle">
                                            <td></td>
                                            <td>Jumlah</td>
                                            <td>
                                                {{ $total }}
                                            </td>
                                            <td>
                                                {{ number_format($total_percentage, 2) }}%
                                            </td>
                                        </tr>
                                        </tbody>
                                </table>
                            </div>
                            

                            <!-- Tabel 2 - Agama -->
                            <div class="section" id="section2" style="display: none;">
                                <div class="mb-4">
                                    <button type="button" class="btn btn-success btn-sm">
                                        <i class="bi bi-bar-chart-line-fill align-middle"></i> Grafik Data
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pie-chart-fill align-middle"></i> Pie Data
                                    </button>
                                </div>
                                <h5 class="text-center">Data Kependudukan berdasarkan Agama</h5>
                                <canvas id="pieChart" style="display: none;"></canvas>
                                <canvas id="barChart" style="display: none;"></canvas>
                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                        <tr class="bg-dark text-light text-center align-middle">
                                            <th>No</th>
                                            <th>Jenis Kelompok</th>
                                            <th colspan="2">Jumlah</th>
                                        </tr>
                                    </thead>

                                    @php
                                    $counterAgama = array_fill(0, $totalRowAgama, 0);
                                    $percentageAgama = array_fill(0, $totalRowAgama, 0);
                                    $total = 0;
                                    $total_percentage = 0;
                                    $x = 0;

                                    @endphp

                                    @foreach ($penduduk as $data)

                                    @php
                                    for($i = 0; $i < $totalRowAgama; $i++){ if($data->id_agama === $i+1){
                                            $counterAgama[$i]++;
                                        }
                                    }

                                        $total = array_sum($counterAgama);
                                        for($i = 0; $i < $totalRowAgama; $i++){ 
                                            $percentageAgama[$i]=($counterAgama[$i] / $total) * 100; 
                                        } 
                                        $total_percentage=($total / $total) * 100; 
                                        @endphp 
                                        @endforeach 
                                        
                                        <tbody class=text-nowrap>
                                            @foreach ($agama as $a)
                                            <tr class="text-center align-middle">
                                                <td> {{ $a->id }} </td>
                                                <td class="text-start"> {{ $a->nama }} </td>
                                                <td>
                                                    {{ $counterAgama[$x] }}
                                                </td>
                                                <td>
                                                    {{ number_format($percentageAgama[$x], 2) }}%
                                                </td>
                                            </tr>
                                            @php
                                            $x++;
                                            @endphp
                                            @endforeach

                                            <tr class="text-center align-middle">
                                                <td></td>
                                                <td>Jumlah</td>
                                                <td>
                                                    {{ $total }}
                                                </td>
                                                <td>
                                                    {{ number_format($total_percentage, 2) }}%
                                                </td>
                                            </tr>
                                        </tbody>
                                </table>
                            </div>

                            <!-- Tabel 3 - Pekerjaan -->
                            <div class="section" id="section3" style="display: none;">
                                <div class="mb-4">
                                    <button type="button" class="btn btn-success btn-sm">
                                        <i class="bi bi-bar-chart-line-fill align-middle"></i> Grafik Data
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pie-chart-fill align-middle"></i> Pie Data
                                    </button>
                                </div>
                                <h5 class="text-center">Data Kependudukan berdasarkan Pekerjaan</h5>
                                <canvas id="pieChart" style="display: none;"></canvas>
                                <canvas id="barChart" style="display: none;"></canvas>
                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                        <tr class="bg-dark text-light text-center align-middle">
                                            <th>No</th>
                                            <th>Jenis Kelompok</th>
                                            <th colspan="2">Jumlah</th>
                                        </tr>
                                    </thead>

                                    @php
                                    $counterPekerjaan = array_fill(0, $totalRowPekerjaan, 0);
                                    $percentagePekerjaan = array_fill(0, $totalRowPekerjaan, 0);
                                    $total = 0;
                                    $total_percentage = 0;
                                    $x = 0;
                                    @endphp

                                    @foreach ($penduduk as $data)

                                    @php
                                    for($i = 0; $i < $totalRowPekerjaan; $i++){ if($data->id_pekerjaan === $i+1){
                                            $counterPekerjaan[$i]++;
                                        }
                                    }

                                        $total = array_sum($counterPekerjaan);
                                        for($i = 0; $i < $totalRowPekerjaan; $i++){ 
                                            $percentagePekerjaan[$i]=($counterPekerjaan[$i] / $total) * 100; 
                                        } 
                                        $total_percentage=($total / $total) * 100; 
                                        @endphp 
                                        @endforeach 

                                        <tbody class=text-nowrap>
                                            @foreach ($pekerjaan as $p)
                                            <tr class="text-center align-middle">
                                                <td>{{ $p->id }}</td>
                                                <td class="text-start">{{ $p->nama }}</td>
                                                <td>
                                                    {{ $counterPekerjaan[$x] }}
                                                </td>
                                                <td>
                                                    {{ number_format($percentagePekerjaan[$x], 2) }}%
                                                </td>
                                            </tr>
                                            @php
                                            $x++;
                                            @endphp
                                            @endforeach
                                            <tr class="text-center align-middle">
                                                <td></td>
                                                <td>Jumlah</td>
                                                <td>
                                                    {{ $total }}
                                                </td>
                                                <td>
                                                    {{ number_format($total_percentage, 2) }}%
                                                </td>
                                            </tr>
                                        </tbody>
                                </table>
                            </div>

                            <!-- Tabel 4 - Status Penduduk -->
                            <div class="section" id="section4" style="display: none;">
                                <div class="mb-4">
                                    <button type="button" class="btn btn-success btn-sm">
                                        <i class="bi bi-bar-chart-line-fill align-middle"></i> Grafik Data
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pie-chart-fill align-middle"></i> Pie Data
                                    </button>
                                </div>
                                <h5 class="text-center">Data Kependudukan berdasarkan Status Penduduk</h5>
                                <canvas id="pieChart" style="display: none;"></canvas>
                                <canvas id="barChart" style="display: none;"></canvas>
                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                        <tr class="bg-dark text-light text-center align-middle">
                                            <th>No</th>
                                            <th>Jenis Kelompok</th>
                                            <th colspan="2">Jumlah</th>
                                        </tr>
                                    </thead>

                                    @php
                                    $counterStatusPenduduk = array_fill(0, 2, 0);
                                    $percentageStatusPenduduk = array_fill(0, 2, 0);
                                    $total = 0;
                                    $total_percentage = 0;
                                    @endphp

                                    @foreach ($penduduk as $data)

                                    @php
                                    if($data->penduduk_tetap === true){
                                    $counterStatusPenduduk[0]++;
                                    }
                                    else{
                                    $counterStatusPenduduk[1]++;
                                    }

                                    $total = array_sum($counterStatusPenduduk);
                                    for($i = 0; $i < 2; $i++){ 
                                        $percentageStatusPenduduk[$i]=($counterStatusPenduduk[$i] / $total) * 100; 
                                    } 
                                    $total_percentage=($total / $total) * 100; 
                                    @endphp 
                                    @endforeach 
                                    <tbody class=text-nowrap>
                                        <tr class="text-center align-middle">
                                            <td>1</td>
                                            <td class="text-start">TETAP</td>
                                            <td>
                                                {{ $counterStatusPenduduk[0] }}
                                            </td>
                                            <td>
                                                {{ number_format($percentageStatusPenduduk[0], 2) }}%
                                            </td>
                                        </tr>
                                        <tr class="text-center align-middle">
                                            <td>2</td>
                                            <td class="text-start">TIDAK TETAP</td>
                                            <td>
                                                {{ $counterStatusPenduduk[1] }}
                                            </td>
                                            <td>
                                                {{ number_format($percentageStatusPenduduk[1], 2) }}%
                                            </td>
                                        </tr>
                                        <tr class="text-center align-middle">
                                            <td></td>
                                            <td>Jumlah</td>
                                            <td>
                                                {{ $total }}
                                            </td>
                                            <td>
                                                {{ number_format($total_percentage, 2) }}%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tabel 5 - Pendidikan Terakhir -->
                            <div class="section" id="section5" style="display: none;">
                                <div class="mb-4">
                                    <button type="button" class="btn btn-success btn-sm">
                                        <i class="bi bi-bar-chart-line-fill align-middle"></i> Grafik Data
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pie-chart-fill align-middle"></i> Pie Data
                                    </button>
                                </div>
                                <h5 class="text-center">Data Kependudukan berdasarkan Pendidikan Terakhir</h5>
                                <canvas id="pieChart" style="display: none;"></canvas>
                                <canvas id="barChart" style="display: none;"></canvas>
                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                        <tr class="bg-dark text-light text-center align-middle">
                                            <th>No</th>
                                            <th>Jenis Kelompok</th>
                                            <th colspan="2">Jumlah</th>
                                        </tr>
                                    </thead>

                                    @php
                                    $counterPendidikanTerakhir = array_fill(0, $totalRowPendidikanTerakhir, 0);
                                    $percentagePendidikanTerakhir = array_fill(0, $totalRowPendidikanTerakhir, 0);
                                    $total = 0;
                                    $total_percentage = 0;
                                    $x = 0;

                                    @endphp

                                    @foreach ($penduduk as $data)

                                    @php
                                    for($i = 0; $i < $totalRowPendidikanTerakhir; $i++){ if($data->id_pendidikan_terakhir === $i+1){
                                        $counterPendidikanTerakhir[$i]++;
                                        }
                                        }

                                        $total = array_sum($counterPendidikanTerakhir);
                                        for($i = 0; $i < $totalRowPendidikanTerakhir; $i++){ 
                                            $percentagePendidikanTerakhir[$i]=($counterPendidikanTerakhir[$i] / $total) * 100; 
                                        } 
                                        $total_percentage=($total / $total) * 100; 
                                        @endphp 
                                        @endforeach 
                                        
                                        <tbody class=text-nowrap>
                                            @foreach ($pendidikan_terakhir as $pt)
                                            <tr class="text-center align-middle">
                                                <td>{{ $pt->id }}</td>
                                                <td class="text-start">{{ $pt->nama }}</td>
                                                <td>
                                                    {{ $counterPendidikanTerakhir[$x] }}
                                                </td>
                                                <td>
                                                    {{ number_format($percentagePendidikanTerakhir[$x], 2) }}%
                                                </td>
                                            </tr>
                                            @php
                                            $x++;
                                            @endphp
                                            @endforeach
                                            <tr class="text-center align-middle">
                                                <td></td>
                                                <td>Jumlah</td>
                                                <td>
                                                    {{ $total }}
                                                </td>
                                                <td>
                                                    {{ number_format($total_percentage, 2) }}%
                                                </td>
                                            </tr>
                                        </tbody>
                                </table>
                            </div>

                            <!-- Tabel 6 - Kelas Sosial -->
                            <div class="section" id="section6" style="display: none;">
                                <div class="mb-4">
                                    <button type="button" class="btn btn-success btn-sm">
                                        <i class="bi bi-bar-chart-line-fill align-middle"></i> Grafik Data
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pie-chart-fill align-middle"></i> Pie Data
                                    </button>
                                </div>
                                <h5 class="text-center">Data Kependudukan berdasarkan Kelas Sosial</h5>
                                <canvas id="pieChart" style="display: none;"></canvas>
                                <canvas id="barChart" style="display: none;"></canvas>
                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                        <tr class="bg-dark text-light text-center align-middle">
                                            <th>No</th>
                                            <th>Jenis Kelompok</th>
                                            <th colspan="2">Jumlah</th>
                                        </tr>
                                    </thead>

                                    @php
                                    $counterKelasSosial = array_fill(0, $totalRowKelasSosial, 0);
                                    $percentageKelasSosial = array_fill(0, $totalRowKelasSosial, 0);
                                    $total = 0;
                                    $total_percentage = 0;
                                    $x = 0;

                                    @endphp

                                    @foreach ($keluarga as $dataKeluarga)

                                    @php
                                    for($i = 0; $i < $totalRowKelasSosial; $i++){ 
                                        if($dataKeluarga->id_kelas_sosial === $i+1){
                                            $counterKelasSosial[$i]++;
                                        }
                                    }

                                    $total = array_sum($counterKelasSosial);
                                    for($i = 0; $i < $totalRowKelasSosial; $i++){ 
                                        $percentageKelasSosial[$i]=($counterKelasSosial[$i] / $total) * 100; 
                                    } 
                                    $total_percentage=($total / $total) * 100; 
                                    @endphp 
                                    @endforeach 
                                        
                                        <tbody class=text-nowrap>
                                            @foreach ($kelas_sosial as $ks)
                                            <tr class="text-center align-middle">
                                                <td>{{ $ks->id }}</td>
                                                <td class="text-start">{{ $ks->nama }}</td>
                                                <td>
                                                    {{ $counterKelasSosial[$x] }}
                                                </td>
                                                <td>
                                                    {{ number_format($percentageKelasSosial[$x], 2) }}%
                                                </td>
                                            </tr>
                                            @php
                                            $x++;
                                            @endphp
                                            @endforeach
                                            <tr class="text-center align-middle">
                                                <td></td>
                                                <td>Jumlah</td>
                                                <td>
                                                    {{ $total }}
                                                </td>
                                                <td>
                                                    {{ number_format($total_percentage, 2) }}%
                                                </td>
                                            </tr>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.commonScripts')
<script>
    function showSection(sectionNumber) {
        // Hide all sections
        $('.section').hide();

        // Show the selected table
        var selectedSection = $('#section' + sectionNumber);
        if (selectedSection.length) {
            selectedSection.show();
        }
    }
</script>

@endsection