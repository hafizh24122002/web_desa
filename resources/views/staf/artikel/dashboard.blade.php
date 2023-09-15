@extends('layouts/adminMain')

@section('main-content')

<style>
      * {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
      }
      .chartMenu {
        width: 100vw;
        height: 40px;
        background: #1A1A1A;
        color: rgba(54, 162, 235, 1);
      }
      .chartMenu p {
        padding: 10px;
        font-size: 20px;
      }
      .chartCard {
        width: 100vw;
        height: calc(100vh - 40px);
        background: rgba(54, 162, 235, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .chartBox {
        width: 700px;
        padding: 20px;
        border-radius: 20px;
        border: solid 3px rgba(54, 162, 235, 1);
        background: white;
      }
    </style>

<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                {{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
					'title' => 'Dashboard Artikel',
					'current_page' => 'Dashboard',
					])

                {{-- card --}}
                <div class="row mt-3">
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="card text-white bg-primary mb-3 rounded">
                            <div class="card-content">
                                <h4 class="card-title">
                                    0
                                </h4>
                                <p class="card-text">
                                    Artikel terbit
                                </p>
                                <div class="icon">
                                    <i class="bi bi-journals"></i>
                                </div>
                            </div>
                            <div class="card-read-more">
                                <a href="#" class="btn btn-link btn-block">
                                    Lihat Detail
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="card text-white bg-info mb-3 rounded">
                            <div class="card-content">
                                <h4 class="card-title">
                                    0
                                </h4>
                                <p class="card-text">
                                    Artikel terbit bulan ini
                                </p>
                                <div class="icon">
                                    <i class="bi bi-journal"></i>
                                </div>
                            </div>
                            <div class="card-read-more">
                                <a href="/staf/kependudukan/penduduk" class="btn btn-link btn-block">
                                    Lihat Detail
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="card text-white bg-success mb-3 rounded">
                            <div class="card-content">
                                <h4 class="card-title">
                                    0
                                </h4>
                                <p class="card-text">
                                    Pengunjung Artikel
                                </p>
                                <div class="icon">
                                    <i class="bi bi-people"></i>
                                </div>
                            </div>
                            <div class="card-read-more">
                                <a href="/staf/kependudukan/keluarga" class="btn btn-link btn-block">
                                    Lihat Detail
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- line graph --}}
                    {{--<div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-header">
                                <span class="me-2"><i class="bi bi-graph-up"></i></span>
                                Pembaca Artikel
                            </div>
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>--}}
                    {{-- bar graph --}}
                    <div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-header">
                                <span class="me-2"><i class="bi bi-bar-chart-steps"></i></span>
                                Grafik Pembaca
                            </div>
                            <div class="card-body">
                            <canvas id="myChart"></canvas>
                            <button onclick="timeFrame(this)" value="day">Hari</button>
                            <button onclick="timeFrame(this)" value="week">Minggu</button>
                            <button onclick="timeFrame(this)" value="month">Bulan</button>
                            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
                            <script>
                            // setup
                            const day = [
                                { x: Date.parse('2021-11-01 00:00:00 GMT+0800'), y: 18},
                                { x: Date.parse('2021-11-02 00:00:00 GMT+0800'), y: 12},
                                { x: Date.parse('2021-11-03 00:00:00 GMT+0800'), y: 6},
                                { x: Date.parse('2021-11-04 00:00:00 GMT+0800'), y: 9},
                                { x: Date.parse('2021-11-05 00:00:00 GMT+0800'), y: 3},
                                { x: Date.parse('2021-11-06 00:00:00 GMT+0800'), y: 12},
                                { x: Date.parse('2021-11-07 00:00:00 GMT+0800'), y: 3},
                            ];
                            const week = [
                                { x: Date.parse('2021-10-31 00:00:00 GMT+0800'), y: 50},
                                { x: Date.parse('2021-11-07 00:00:00 GMT+0800'), y: 70},
                                { x: Date.parse('2021-11-14 00:00:00 GMT+0800'), y: 100},
                                { x: Date.parse('2021-11-21 00:00:00 GMT+0800'), y: 60},
                                { x: Date.parse('2021-11-28 00:00:00 GMT+0800'), y: 30},
                            ];
                            const month = [
                                { x: Date.parse('2021-08-01 00:00:00 GMT+0800'), y: 50},
                                { x: Date.parse('2021-09-01 00:00:00 GMT+0800'), y: 70},
                                { x: Date.parse('2021-10-01 00:00:00 GMT+0800'), y: 100},
                                { x: Date.parse('2021-11-01 00:00:00 GMT+0800'), y: 60},
                                { x: Date.parse('2021-12-01 00:00:00 GMT+0800'), y: 30},
                            ];
                            const data = {
                            //labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                            datasets: [{
                                label: '',
                                data: day,
                                backgroundColor: [
                                'rgba(255, 26, 104, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(0, 0, 0, 0.2)'
                                ],
                                borderColor: [
                                'rgba(255, 26, 104, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(0, 0, 0, 1)'
                                ],
                                borderWidth: 1
                            }]
                            };

                            // config 
                            const config = {
                            type: 'bar',
                            data,
                            options: {
                                scales: {
                                x: {
                                    type: 'time',
                                    time: {
                                        unit: 'day'
                                    }
                                },
                                y: {
                                    beginAtZero: true
                                }
                                }
                            }
                            };

                            // render init block
                            const myChart = new Chart(
                            document.getElementById('myChart'),
                            config
                            );
                            
                            function timeFrame(period){
                                console.log(period.value);
                                if(period.value =='day') {
                                    myChart.config.options.scales.x.time.unit = period.value;
                                    myChart.config.data.datasets[0].data = day;
                                }
                                if(period.value =='week') {
                                    myChart.config.options.scales.x.time.unit = period.value;
                                    myChart.config.data.datasets[0].data = week;
                                }
                                if(period.value =='month') {
                                    myChart.config.options.scales.x.time.unit = period.value;
                                    myChart.config.data.datasets[0].data = month;
                                }
                                myChart.update();
                            }
                            // Instantly assign Chart.js version
                            const chartVersion = document.getElementById('chartVersion');
                            chartVersion.innerText = Chart.version;
                            </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
</section>

@include('partials.commonScripts')

@endsection