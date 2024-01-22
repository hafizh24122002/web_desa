@extends('layouts/visitorMain')

@section('main-content')
<div class="main-content">
    <div class="main-content-body">
        <div class="h2 mt-5">
            Demografi Desa
        </div>
        <hr>
        <h4 class="text-center mb-3"><strong>Rincian Demografi</strong></h4>
        <ol>
            <li>Data Penduduk Berdasarkan Jenis Kelamin</li>
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
                        <td>{{ $loop->iteration }}</td>
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

            <li>Data Penduduk Berdasarkan Agama</li>
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
                        <td>{{ $loop->iteration }}</td>
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

            <li>Data Penduduk Berdasarkan Pekerjaan</li>
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
                        <td>{{ $loop->iteration }}</td>
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

            <li>Data Penduduk Berdasarkan Status Penduduk</li>
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
                        <td>{{ $loop->iteration }}</td>
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

            <li>Data Penduduk Berdasarkan Pendidikan Terakhir</li>
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
                        <td>{{ $loop->iteration }}</td>
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

            <li>Data Penduduk Berdasarkan Status Perkawinan</li>
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
                        <td>{{ $loop->iteration }}</td>
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

            <li>Data Penduduk Berdasarkan Kewarganegaraan</li>
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
                        <td>{{ $loop->iteration }}</td>
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

            <li>Data Keluarga Berdasarkan Kelas Sosial</li>
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
                        <td>{{ $loop->iteration }}</td>
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
        </ol>
    </div>
</div>
@endsection