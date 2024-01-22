@extends('layouts/adminMain')

@section('main-content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                            <div class="accordion accordion-custom" id="statistikBar">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="statistikHeading">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#statistikPenduduk" aria-expanded="true" aria-controls="statistikPenduduk">
                                            Statistik Penduduk
                                        </button>
                                    </h2>
                                    <div id="statistikPenduduk" class="accordion-collapse collapse show" aria-labelledby="statistikHeading" data-bs-parent="#statistikBar">
                                        <div class="list-group">
                                            <a href="#gender" class="list-group-item list-group-item-action" onclick="showSection(1)">Jenis Kelamin</a>
                                            <a href="#agama" class="list-group-item list-group-item-action" onclick="showSection(2)">Agama</a>
                                            <a href="#pekerjaan" class="list-group-item list-group-item-action" onclick="showSection(3)">Pekerjaan</a>
                                            <a href="#status-penduduk" class="list-group-item list-group-item-action" onclick="showSection(4)">Status Penduduk</a>
                                            <a href="#pendidikan-terakhir" class="list-group-item list-group-item-action" onclick="showSection(5)">Pendidikan Terakhir</a>
                                            <a href="#status-perkawinan" class="list-group-item list-group-item-action" onclick="showSection(6)">Status Perkawinan</a>
                                            <a href="#kewarganegaraan" class="list-group-item list-group-item-action" onclick="showSection(7)">Kewarganegaraan</a>
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
                                            <a href="#kelas-sosial" class="list-group-item list-group-item-action" onclick="showSection(8)">Kelas Sosial</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">

                            <!-- Tabel 1 - Jenis Kelamin -->
                            <div class="section" id="section1" style="display: none;">

                                <div class="mb-4">
                                    <button type="button" class="btn btn-success btn-sm" id="barChart">
                                        <i class="bi bi-bar-chart-line-fill align-middle"></i> Grafik Data
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" id="pieChart">
                                        <i class=" bi bi-pie-chart-fill align-middle"></i> Pie Data
                                    </button>
                                </div>

                                <h5 class="text-center">Data Kependudukan berdasarkan Jenis Kelamin</h5>

                                <div class="mb-4">
                                    <div id="piechart-container" style="display: none;">
                                        <canvas id="pie-chart" width="400" height="300"></canvas>
                                    </div>

                                    <div id="barchart-container" style="display: none;">
                                        <canvas id="bar-chart" width="400" height="300"></canvas>
                                    </div>
                                </div>

                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                        <tr class="bg-dark text-light text-center align-middle">
                                            <th>No</th>
                                            <th>Jenis Kelompok</th>
                                            <th colspan="2">Jumlah</th>
                                        </tr>
                                    </thead>

                                    <tbody class=text-nowrap>
                                        @foreach($arr_gender as $stat_gender)
                                        <tr class="text-center align-middle">
                                            <td>{{ $stat_gender['id'] }}</td>
                                            <td class="text-start">{{ $stat_gender['name'] }}</td>
                                            <td>
                                                {{ $stat_gender['count'] }}
                                            </td>
                                            <td>
                                                {{ number_format($stat_gender['percentage'], 2) }}%
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="text-center align-middle">
                                            <td></td>
                                            <td>Jumlah</td>
                                            <td>
                                                {{ $total_gender }}
                                            </td>
                                            <td>
                                                {{ number_format($total_gender_percentage, 2) }}%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tabel 2 - Agama -->
                            <div class="section" id="section2" style="display: none;">

                                <div class="mb-4">
                                    <button type="button" class="btn btn-success btn-sm" id="barChart2">
                                        <i class="bi bi-bar-chart-line-fill align-middle"></i> Grafik Data
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" id="pieChart2">
                                        <i class=" bi bi-pie-chart-fill align-middle"></i> Pie Data
                                    </button>
                                </div>

                                <h5 class="text-center">Data Kependudukan berdasarkan Agama</h5>

                                <div class="mb-4">
                                    <div id="piechart2-container" style="display: none;">
                                        <canvas id="pie-chart2" width="400" height="300"></canvas>
                                    </div>

                                    <div id="barchart2-container" style="display: none;">
                                        <canvas id="bar-chart2" width="400" height="300"></canvas>
                                    </div>
                                </div>

                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                        <tr class="bg-dark text-light text-center align-middle">
                                            <th>No</th>
                                            <th>Jenis Kelompok</th>
                                            <th colspan="2">Jumlah</th>
                                        </tr>
                                    </thead>

                                    <tbody class=text-nowrap>
                                        @foreach($arr_agama as $stat_agama)
                                        <tr class="text-center align-middle">
                                            <td>{{ $stat_agama['id'] }}</td>
                                            <td class="text-start">{{ $stat_agama['name'] }}</td>
                                            <td>
                                                {{ $stat_agama['count'] }}
                                            </td>
                                            <td>
                                                {{ number_format($stat_agama['percentage'], 2) }}%
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="text-center align-middle">
                                            <td></td>
                                            <td>Jumlah</td>
                                            <td>
                                                {{ $total_agama }}
                                            </td>
                                            <td>
                                                {{ number_format($total_agama_percentage, 2) }}%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tabel 3 - Pekerjaan -->
                            <div class="section" id="section3" style="display: none;">
                                <div class="mb-4">
                                    <button type="button" class="btn btn-success btn-sm" id="barChart3">
                                        <i class="bi bi-bar-chart-line-fill align-middle"></i> Grafik Data
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" id="pieChart3">
                                        <i class=" bi bi-pie-chart-fill align-middle"></i> Pie Data
                                    </button>
                                </div>

                                <h5 class="text-center">Data Kependudukan berdasarkan Pekerjaan</h5>

                                <div class="mb-4">
                                    <div id="piechart3-container" style="display: none;">
                                        <canvas id="pie-chart3"></canvas>
                                    </div>

                                    <div id="barchart3-container" style="display: none;">
                                        <canvas id="bar-chart3" width="400" height="300"></canvas>
                                    </div>
                                </div>

                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                        <tr class="bg-dark text-light text-center align-middle">
                                            <th>No</th>
                                            <th>Jenis Kelompok</th>
                                            <th colspan="2">Jumlah</th>
                                        </tr>
                                    </thead>

                                    <tbody class=text-nowrap>
                                        @foreach($arr_pekerjaan as $stat_pekerjaan)
                                        <tr class="text-center align-middle">
                                            <td>{{ $stat_pekerjaan['id'] }}</td>
                                            <td class="text-start">{{ $stat_pekerjaan['name'] }}</td>
                                            <td>
                                                {{ $stat_pekerjaan['count'] }}
                                            </td>
                                            <td>
                                                {{ number_format($stat_pekerjaan['percentage'], 2) }}%
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="text-center align-middle">
                                            <td></td>
                                            <td>Jumlah</td>
                                            <td>
                                                {{ $total_pekerjaan }}
                                            </td>
                                            <td>
                                                {{ number_format($total_pekerjaan_percentage, 2) }}%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tabel 4 - Status Penduduk -->
                            <div class="section" id="section4" style="display: none;">
                                <div class="mb-4">
                                    <button type="button" class="btn btn-success btn-sm" id="barChart4">
                                        <i class="bi bi-bar-chart-line-fill align-middle"></i> Grafik Data
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" id="pieChart4">
                                        <i class=" bi bi-pie-chart-fill align-middle"></i> Pie Data
                                    </button>
                                </div>

                                <h5 class="text-center">Data Kependudukan berdasarkan Status Penduduk</h5>

                                <div class="mb-4">
                                    <div id="piechart4-container" style="display: none;">
                                        <canvas id="pie-chart4" width="400" height="300"></canvas>
                                    </div>

                                    <div id="barchart4-container" style="display: none;">
                                        <canvas id="bar-chart4" width="400" height="300"></canvas>
                                    </div>
                                </div>

                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                        <tr class="bg-dark text-light text-center align-middle">
                                            <th>No</th>
                                            <th>Jenis Kelompok</th>
                                            <th colspan="2">Jumlah</th>
                                        </tr>
                                    </thead>

                                    <tbody class=text-nowrap>
                                        @foreach($arr_status_penduduk as $stat_status_penduduk)
                                        <tr class="text-center align-middle">
                                            <td>{{ $stat_status_penduduk['id'] }}</td>
                                            <td class="text-start">{{ $stat_status_penduduk['name'] }}</td>
                                            <td>
                                                {{ $stat_status_penduduk['count'] }}
                                            </td>
                                            <td>
                                                {{ number_format($stat_status_penduduk['percentage'], 2) }}%
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="text-center align-middle">
                                            <td></td>
                                            <td>Jumlah</td>
                                            <td>
                                                {{ $total_status_penduduk }}
                                            </td>
                                            <td>
                                                {{ number_format($total_status_penduduk_percentage, 2) }}%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tabel 5 - Pendidikan Terakhir -->
                            <div class="section" id="section5" style="display: none;">
                                <div class="mb-4">
                                    <button type="button" class="btn btn-success btn-sm" id="barChart5">
                                        <i class="bi bi-bar-chart-line-fill align-middle"></i> Grafik Data
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" id="pieChart5">
                                        <i class=" bi bi-pie-chart-fill align-middle"></i> Pie Data
                                    </button>
                                </div>

                                <h5 class="text-center">Data Kependudukan berdasarkan Pendidikan Terakhir</h5>

                                <div class="mb-4">
                                    <div id="piechart5-container" style="display: none;">
                                        <canvas id="pie-chart5" width="400" height="300"></canvas>
                                    </div>

                                    <div id="barchart5-container" style="display: none;">
                                        <canvas id="bar-chart5" width="400" height="300"></canvas>
                                    </div>
                                </div>

                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                        <tr class="bg-dark text-light text-center align-middle">
                                            <th>No</th>
                                            <th>Jenis Kelompok</th>
                                            <th colspan="2">Jumlah</th>
                                        </tr>
                                    </thead>

                                    <tbody class=text-nowrap>
                                        @foreach($arr_pendidikan_terakhir as $stat_pendidikan_terakhir)
                                        <tr class="text-center align-middle">
                                            <td>{{ $stat_pendidikan_terakhir['id'] }}</td>
                                            <td class="text-start">{{ $stat_pendidikan_terakhir['name'] }}</td>
                                            <td>
                                                {{ $stat_pendidikan_terakhir['count'] }}
                                            </td>
                                            <td>
                                                {{ number_format($stat_pendidikan_terakhir['percentage'], 2) }}%
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="text-center align-middle">
                                            <td></td>
                                            <td>Jumlah</td>
                                            <td>
                                                {{ $total_pendidikan_terakhir }}
                                            </td>
                                            <td>
                                                {{ number_format($total_pendidikan_terakhir_percentage, 2) }}%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tabel 6 - Status Perkawinan -->
                            <div class="section" id="section6" style="display: none;">
                                <div class="mb-4">
                                    <button type="button" class="btn btn-success btn-sm" id="barChart6">
                                        <i class="bi bi-bar-chart-line-fill align-middle"></i> Grafik Data
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" id="pieChart6">
                                        <i class=" bi bi-pie-chart-fill align-middle"></i> Pie Data
                                    </button>
                                </div>

                                <h5 class="text-center">Data Kependudukan berdasarkan Status Perkawinan</h5>

                                <div class="mb-4">
                                    <div id="piechart6-container" style="display: none;">
                                        <canvas id="pie-chart6" width="400" height="300"></canvas>
                                    </div>

                                    <div id="barchart6-container" style="display: none;">
                                        <canvas id="bar-chart6" width="400" height="300"></canvas>
                                    </div>
                                </div>

                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                        <tr class="bg-dark text-light text-center align-middle">
                                            <th>No</th>
                                            <th>Jenis Kelompok</th>
                                            <th colspan="2">Jumlah</th>
                                        </tr>
                                    </thead>

                                    <tbody class=text-nowrap>
                                        @foreach($arr_status_perkawinan as $stat_status_perkawinan)
                                        <tr class="text-center align-middle">
                                            <td>{{ $stat_status_perkawinan['id'] }}</td>
                                            <td class="text-start">{{ $stat_status_perkawinan['name'] }}</td>
                                            <td>
                                                {{ $stat_status_perkawinan['count'] }}
                                            </td>
                                            <td>
                                                {{ number_format($stat_status_perkawinan['percentage'], 2) }}%
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="text-center align-middle">
                                            <td></td>
                                            <td>Jumlah</td>
                                            <td>
                                                {{ $total_status_perkawinan }}
                                            </td>
                                            <td>
                                                {{ number_format($total_status_perkawinan_percentage, 2) }}%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tabel 7 - Status Perkawinan -->
                            <div class="section" id="section7" style="display: none;">
                                <div class="mb-4">
                                    <button type="button" class="btn btn-success btn-sm" id="barChart7">
                                        <i class="bi bi-bar-chart-line-fill align-middle"></i> Grafik Data
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" id="pieChart7">
                                        <i class=" bi bi-pie-chart-fill align-middle"></i> Pie Data
                                    </button>
                                </div>

                                <h5 class="text-center">Data Kependudukan berdasarkan Kewarganegaraan</h5>

                                <div class="mb-4">
                                    <div id="piechart7-container" style="display: none;">
                                        <canvas id="pie-chart7" width="400" height="300"></canvas>
                                    </div>

                                    <div id="barchart7-container" style="display: none;">
                                        <canvas id="bar-chart7" width="400" height="300"></canvas>
                                    </div>
                                </div>

                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                        <tr class="bg-dark text-light text-center align-middle">
                                            <th>No</th>
                                            <th>Jenis Kelompok</th>
                                            <th colspan="2">Jumlah</th>
                                        </tr>
                                    </thead>

                                    <tbody class=text-nowrap>
                                        @foreach($arr_kewarganegaraan as $stat_kewarganegaraan)
                                        <tr class="text-center align-middle">
                                            <td>{{ $stat_kewarganegaraan['id'] }}</td>
                                            <td class="text-start">{{ $stat_kewarganegaraan['name'] }}</td>
                                            <td>
                                                {{ $stat_kewarganegaraan['count'] }}
                                            </td>
                                            <td>
                                                {{ number_format($stat_kewarganegaraan['percentage'], 2) }}%
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="text-center align-middle">
                                            <td></td>
                                            <td>Jumlah</td>
                                            <td>
                                                {{ $total_kewarganegaraan }}
                                            </td>
                                            <td>
                                                {{ number_format($total_kewarganegaraan_percentage, 2) }}%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tabel 8 - Kelas Sosial -->
                            <div class="section" id="section8" style="display: none;">
                                <div class="mb-4">
                                    <button type="button" class="btn btn-success btn-sm" id="barchart8">
                                        <i class="bi bi-bar-chart-line-fill align-middle"></i> Grafik Data
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" id="piechart8">
                                        <i class=" bi bi-pie-chart-fill align-middle"></i> Pie Data
                                    </button>
                                </div>

                                <h5 class="text-center">Data Kependudukan berdasarkan Kelas Sosial</h5>

                                <div class="mb-4">
                                    <div id="piechart8-container" style="display: none;">
                                        <canvas id="pie-chart8" width="400" height="300"></canvas>
                                    </div>

                                    <div id="barchart8-container" style="display: none;">
                                        <canvas id="bar-chart8" width="400" height="300"></canvas>
                                    </div>
                                </div>

                                <table class="table table-hover table-responsive table-bordered">
                                    <thead>
                                        <tr class="bg-dark text-light text-center align-middle">
                                            <th>No</th>
                                            <th>Jenis Kelompok</th>
                                            <th colspan="2">Jumlah</th>
                                        </tr>
                                    </thead>

                                    <tbody class=text-nowrap>
                                        @foreach($arr_kelas_sosial as $stat_kelas_sosial)
                                        <tr class="text-center align-middle">
                                            <td>{{ $stat_kelas_sosial['id'] }}</td>
                                            <td class="text-start">{{ $stat_kelas_sosial['name'] }}</td>
                                            <td>
                                                {{ $stat_kelas_sosial['count'] }}
                                            </td>
                                            <td>
                                                {{ number_format($stat_kelas_sosial['percentage'], 2) }}%
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="text-center align-middle">
                                            <td></td>
                                            <td>Jumlah</td>
                                            <td>
                                                {{ $total_kelas_sosial }}
                                            </td>
                                            <td>
                                                {{ number_format($total_kelas_sosial_percentage, 2) }}%
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
        // Hide semua section
        $('.section').hide();

        // Menampilkan tabel sesuai section
        var selectedSection = $('#section' + sectionNumber);
        if (selectedSection.length) {
            selectedSection.show();
        }
    }

    // Generate color palette sesuai jumlah data
    function generateColorPalette(numColors, alpha) {
        const colors = [];
        const hueStep = 360 / numColors;

        for (let i = 0; i < numColors; i++) {
            const hue = i * hueStep;
            colors.push(`rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${alpha})`);
        }

        return colors;
    }

    // Mengambil data statistik
    var genderStats = JSON.parse('{!! json_encode($arr_gender) !!}');
    var agamaStats = JSON.parse('{!! json_encode($arr_agama) !!}');
    var pekerjaanStats = JSON.parse('{!! json_encode($arr_pekerjaan) !!}');
    var statusPendudukStats = JSON.parse('{!! json_encode($arr_status_penduduk) !!}');
    var pendidikanTerakhirStats = JSON.parse('{!! json_encode($arr_pendidikan_terakhir) !!}');
    var statusPerkawinanStats = JSON.parse('{!! json_encode($arr_status_perkawinan) !!}');
    var kewarganegaraanStats = JSON.parse('{!! json_encode($arr_kewarganegaraan) !!}');
    var kelasSosialStats = JSON.parse('{!! json_encode($arr_kelas_sosial) !!}');

    // Canvas 1 - Jenis Kelamin
    var pieChartCanvas = document.getElementById('pie-chart');
    var barChartCanvas = document.getElementById('bar-chart');

    // Canvas 2 - Agama
    var pieChartCanvas2 = document.getElementById('pie-chart2');
    var barChartCanvas2 = document.getElementById('bar-chart2');

    // Canvas 3 - Pekerjaan
    var pieChartCanvas3 = document.getElementById('pie-chart3');
    var barChartCanvas3 = document.getElementById('bar-chart3');

    // Canvas 4 - Status Penduduk
    var pieChartCanvas4 = document.getElementById('pie-chart4');
    var barChartCanvas4 = document.getElementById('bar-chart4');

    // Canvas 5 - Pendidikan Terakhir
    var pieChartCanvas5 = document.getElementById('pie-chart5');
    var barChartCanvas5 = document.getElementById('bar-chart5');

    // Canvas 6 - Status Perkawinan
    var pieChartCanvas6 = document.getElementById('pie-chart6');
    var barChartCanvas6 = document.getElementById('bar-chart6');

    // Canvas 7 - Kewarganegaraan
    var pieChartCanvas7 = document.getElementById('pie-chart7');
    var barChartCanvas7 = document.getElementById('bar-chart7');

    // Canvas 8 - Kelas Sosial
    var pieChartCanvas8 = document.getElementById('pie-chart8');
    var barChartCanvas8 = document.getElementById('bar-chart8');

    /* Pengaturan Data untuk Chart */

    // 1 - Jenis Kelamin
    var genderNames = genderStats.map(stat => stat.name);
    var genderCounts = genderStats.map(stat => stat.count);
    var colorPalette = generateColorPalette(genderNames.length, 0.5);
	var borderColors = colorPalette.map(color => color.replace(/[^,]+(?=\))/, '1'));

    // 2 - Agama
    var agamaNames = agamaStats.map(stat => stat.name);
    var agamaCounts = agamaStats.map(stat => stat.count);
    var colorPalette2 = generateColorPalette(agamaNames.length, 0.5);
    var borderColors2 = colorPalette2.map(color => color.replace(/[^,]+(?=\))/, '1'));

    // 3 - Pekerjaan
    var pekerjaanNames = pekerjaanStats.map(stat => stat.name);
    var pekerjaanCounts = pekerjaanStats.map(stat => stat.count);
    var colorPalette3 = generateColorPalette(pekerjaanNames.length, 0.5);
    var borderColors3 = colorPalette3.map(color => color.replace(/[^,]+(?=\))/, '1'));

    // 4 - Status Penduduk
    var statusPendudukNames = statusPendudukStats.map(stat => stat.name);
    var statusPendudukCounts = statusPendudukStats.map(stat => stat.count);
    var colorPalette4 = generateColorPalette(statusPendudukNames.length, 0.5);
    var borderColors4 = colorPalette4.map(color => color.replace(/[^,]+(?=\))/, '1'));

    // 5 - Pendidikan Terakhir
    var pendidikanTerakhirNames = pendidikanTerakhirStats.map(stat => stat.name);
    var pendidikanTerakhirCounts = pendidikanTerakhirStats.map(stat => stat.count);
    var colorPalette5 = generateColorPalette(pendidikanTerakhirNames.length, 0.5);
    var borderColors5 = colorPalette5.map(color => color.replace(/[^,]+(?=\))/, '1'));

    // 6 - Status Perkawinan
    var statusPerkawinanNames = statusPerkawinanStats.map(stat => stat.name);
    var statusPerkawinanCounts = statusPerkawinanStats.map(stat => stat.count);
    var colorPalette6 = generateColorPalette(statusPerkawinanNames.length, 0.5);
    var borderColors6 = colorPalette6.map(color => color.replace(/[^,]+(?=\))/, '1'));

    // 7 - Kewarganegaraan
    var kewarganegaraanNames = kewarganegaraanStats.map(stat => stat.name);
    var kewarganegaraanCounts = kewarganegaraanStats.map(stat => stat.count);
    var colorPalette7 = generateColorPalette(kewarganegaraanNames.length, 0.5);
    var borderColors7 = colorPalette7.map(color => color.replace(/[^,]+(?=\))/, '1'));

    // 8 - Kelas Sosial
    var kelasSosialNames = kelasSosialStats.map(stat => stat.name);
    var kelasSosialCounts = kelasSosialStats.map(stat => stat.count);
    var colorPalette8 = generateColorPalette(kelasSosialNames.length, 0.5);
    var borderColors8 = colorPalette8.map(color => color.replace(/[^,]+(?=\))/, '1'));

    // Fungsi membuat chart
    function createChart(chartType, labels, data, backgroundColor, borderColor, canvasElement) {
        const ctx = canvasElement.getContext('2d');

        if (canvasElement.chart) {
            canvasElement.chart.destroy();
        }
        canvasElement.chart = new Chart(ctx, {
            type: chartType,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Data',
                    data: data,
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    borderWidth: 1
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: chartType === 'pie' ? 'Pie Chart' : 'Bar Chart',
                },
            },
        });
    }

    // 1 - Jenis Kelamin
    document.getElementById('pieChart').addEventListener('click', function() {
        createChart('pie', genderNames, genderCounts, colorPalette, borderColors, pieChartCanvas);
        document.getElementById('piechart-container').style.display = 'block';
        document.getElementById('barchart-container').style.display = 'none';
    });

    document.getElementById('barChart').addEventListener('click', function() {
        createChart('bar', genderNames, genderCounts, colorPalette, borderColors, barChartCanvas);
        document.getElementById('barchart-container').style.display = 'block';
        document.getElementById('piechart-container').style.display = 'none';
    });

    // 2 - Agama
    document.getElementById('pieChart2').addEventListener('click', function() {
        createChart('pie', agamaNames, agamaCounts, colorPalette2, borderColors2, pieChartCanvas2);
        document.getElementById('piechart2-container').style.display = 'block';
        document.getElementById('barchart2-container').style.display = 'none';
    });

    document.getElementById('barChart2').addEventListener('click', function() {
        createChart('bar', agamaNames, agamaCounts, colorPalette2, borderColors2, barChartCanvas2);
        document.getElementById('barchart2-container').style.display = 'block';
        document.getElementById('piechart2-container').style.display = 'none';
    });

    // 3 - Pekerjaan
    document.getElementById('pieChart3').addEventListener('click', function() {
        createChart('pie', pekerjaanNames, pekerjaanCounts, colorPalette3, borderColors3, pieChartCanvas3);
        document.getElementById('piechart3-container').style.display = 'block';
        document.getElementById('barchart3-container').style.display = 'none';
    });
    document.getElementById('barChart3').addEventListener('click', function() {
        createChart('bar', pekerjaanNames, pekerjaanCounts, colorPalette3, borderColors3, barChartCanvas3);
        document.getElementById('barchart3-container').style.display = 'block';
        document.getElementById('piechart3-container').style.display = 'none';
    });

    // 4 - Status Penduduk
    document.getElementById('pieChart4').addEventListener('click', function() {
        createChart('pie', statusPendudukNames, statusPendudukCounts, colorPalette4, borderColors4, pieChartCanvas4);
        document.getElementById('piechart4-container').style.display = 'block';
        document.getElementById('barchart4-container').style.display = 'none';
    });
    document.getElementById('barChart4').addEventListener('click', function() {
        createChart('bar', statusPendudukNames, statusPendudukCounts, colorPalette4, borderColors4, barChartCanvas4);
        document.getElementById('barchart4-container').style.display = 'block';
        document.getElementById('piechart4-container').style.display = 'none';
    });

    // 5 - Pendidikan Terakhir
    document.getElementById('pieChart5').addEventListener('click', function() {
        createChart('pie', pendidikanTerakhirNames, pendidikanTerakhirCounts, colorPalette5, borderColors5, pieChartCanvas5);
        document.getElementById('piechart5-container').style.display = 'block';
        document.getElementById('barchart5-container').style.display = 'none';
    });

    document.getElementById('barChart5').addEventListener('click', function() {
        createChart('bar', pendidikanTerakhirNames, pendidikanTerakhirCounts, colorPalette5, borderColors5, barChartCanvas5);
        document.getElementById('barchart5-container').style.display = 'block';
        document.getElementById('piechart5-container').style.display = 'none';
    });

    // 6 - Status Perkawinan
    document.getElementById('pieChart6').addEventListener('click', function() {
        createChart('pie', statusPerkawinanNames, statusPerkawinanCounts, colorPalette6, borderColors6, pieChartCanvas6);
        document.getElementById('piechart6-container').style.display = 'block';
        document.getElementById('barchart6-container').style.display = 'none';
    });

    document.getElementById('barChart6').addEventListener('click', function() {
        createChart('bar', statusPerkawinanNames, statusPerkawinanCounts, colorPalette6, borderColors6, barChartCanvas6);
        document.getElementById('barchart6-container').style.display = 'block';
        document.getElementById('piechart6-container').style.display = 'none';
    });

    // 7 - Kewarganegaraan
    document.getElementById('pieChart7').addEventListener('click', function() {
        createChart('pie', kewarganegaraanNames, kewarganegaraanCounts, colorPalette7, borderColors7, pieChartCanvas7);
        document.getElementById('piechart7-container').style.display = 'block';
        document.getElementById('barchart7-container').style.display = 'none';
    });

    document.getElementById('barChart7').addEventListener('click', function() {
        createChart('bar', kewarganegaraanNames, kewarganegaraanCounts, colorPalette7, borderColors7, barChartCanvas7);
        document.getElementById('barchart7-container').style.display = 'block';
        document.getElementById('piechart7-container').style.display = 'none';
    });

    // 8 - Kelas Sosial
    document.getElementById('piechart8').addEventListener('click', function() {
        createChart('pie', kelasSosialNames, kelasSosialCounts, colorPalette8, borderColors8, pieChartCanvas8);
        document.getElementById('piechart8-container').style.display = 'block';
        document.getElementById('barchart8-container').style.display = 'none';
    });

    document.getElementById('barchart8').addEventListener('click', function() {
        createChart('bar', kelasSosialNames, kelasSosialCounts, colorPalette8, borderColors8, barChartCanvas8);
        document.getElementById('barchart8-container').style.display = 'block';
        document.getElementById('piechart8-container').style.display = 'none';
    });
</script>

@endsection