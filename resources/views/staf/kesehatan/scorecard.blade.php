@extends('layouts/adminMain')

@section('main-content')
<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                {{-- menu yang di atas --}}
                @include('partials.adminTopMenu', [
                'title' => 'Scorecard',
                'current_page' => 'Scorecard',
                ])

                {{-- content --}}
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif


                <table class="table table-hover table-bordered">
                    <!-- Tabel 1 -->
                    <thead>
                        <tr class="table-light text-center align-middle">
                            <th colspan="6">Tabel 1. Jumlah Sasaran 1.000 HPK (Ibu Hamil dan Anak 0-23 Bulan)</th>
                        </tr>
                        <tr class="bg-dark text-light text-center align-middle">
                            <th rowspan="2">Sasaran</th>
                            <th rowspan="2">Jml Total Rumah Tangga HPK</th>
                            <th colspan="2">Ibu Hamil</th>
                            <th colspan="2">Anak 0-23 Bulan</th>
                        </tr>
                        <tr class="bg-dark text-light text-center align-middle">
                            <th>Total</th>
                            <th>Kek/Resti</th>
                            <th>Total</th>
                            <th>Gizi Kurang/Gizi Buruk/Stunting </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="text-center align-middle">
                            <th>Jumlah</th>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
                <!-- Tabel 2 -->
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="table-light text-center align-middle">
                            <th colspan="6">Tabel 2. Hasil Pengukuran Tikar Pertumbuhan (Deteksi Dini Stunting)</th>
                        </tr>
                        <tr class="bg-dark text-light text-center align-middle">
                            <th>Sasaran</th>
                            <th colspan="2">Jml Total Anak Usia 0-23 Bulan</th>
                            <th>Hijau (Normal)</th>
                            <th>Kuning (Resiko Stunting)</th>
                            <th>Merah (Terindikasi Stunting)</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="text-center align-middle">
                            <th>Jumlah</th>
                            <td colspan="2">0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
                <!-- Tabel 3 -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="table-light text-center align-middle">
                            <th colspan="6">Tabel 3. Kelengkapan Konvergensi Paket Layanan Pencegahan Stunting</th>
                        </tr>
                        <tr class="bg-dark text-light text-center align-middle">
                            <th>Sasaran</th>
                            <th>No</th>
                            <th>Indikator</th>
                            <th>Jumlah</th>
                            <th>%</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- Ibu Hamil -->
                        <tr class="text-center align-middle">
                            <th rowspan="8">Ibu Hamil</th>
                            <th>1</th>
                            <td class="text-start">Ibu hamil periksa kehamilan paling sedikit 4 kali selama kehamilan kehamilan.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>2</th>
                            <td class="text-start">Ibu hamil mendapatkan dan minum 1 tablet tambah darah (pil FE) setiap hari minimal selama 90 hari.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>3</th>
                            <td class="text-start">Ibu bersalin mendapatkan layanan nifas oleh nakes dilaksanakan minimal 3 kali.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>4</th>
                            <td class="text-start">Ibu hamil mengikuti kegiatan konseling gizi atau kelas ibu hamil minimal 4 kali selama kehamilan.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>5</th>
                            <td class="text-start">Ibu hamil dengan kondisi resiko tinggi dan/atau Kekurangan Energi Kronis (KEK) mendapat kunjungan ke rumah oleh bidan Desa secara terpadu minimal 1 bulan sekali.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>6</th>
                            <td class="text-start">Rumah Tangga Ibu hamil memiliki sarana akses air minum yang aman.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>7</th>
                            <td class="text-start">Rumah Tangga Ibu hamil memiliki sarana jamban keluarga yang layak.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>8</th>
                            <td class="text-start">Ibu hamil memiliki jaminan layanan kesehatan.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>

                        <!-- Anak 0-23 Bulan -->
                        <tr class="text-center align-middle">
                            <th rowspan="10" class="table-light">Anak 0-23 Bulan (0-2 Tahun)</th>
                            <th>1</th>
                            <td class="text-start">Bayi usia 12 bulan ke bawah mendapatkan imunisasi dasar lengkap.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>2</th>
                            <td class="text-start">Anak usia 0-23 bulan diukur berat badannya di posyandu secara rutin setiap bulan.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>3</th>
                            <td class="text-start">Anak usia 0-23 bulan diukur panjang/tinggi badannya oleh tenaga kesehatan terlatih minimal 2 kali dalam setahun.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>4</th>
                            <td class="text-start">Orang tua/pengasuh yang memiliki anak usia 0-23 bulan mengikuti kegiatan konseling gizi secara rutin minimal sebulan sekali.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>5</th>
                            <td class="text-start">Anak usia 0-23 bulan dengan status gizi buruk, gizi kurang, dan stunting mendapat kunjungan ke rumah secara terpadu minimal 1 bulan sekali.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>6</th>
                            <td class="text-start">	Rumah Tangga anak usia 0-23 bulan memiliki sarana akses air minum yang aman.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>7</th>
                            <td class="text-start">Rumah Tangga anak usia 0-23 bulan memiliki sarana jamban yang layak.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>8</th>
                            <td class="text-start">Anak usia 0-23 bulan memiliki akte kelahiran.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>9</th>
                            <td class="text-start">Anak usia 0-23 bulan memiliki jaminan layanan kesehatan.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>10</th>
                            <td class="text-start">Orang tua/pengasuh yang memiliki anak usia 0-23 bulan mengikuti Kelas Pengasuhan minimal sebulan sekali.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        
                        <!-- Anak 2-6 Tahun -->
                        <tr class="text-center align-middle">
                            <th rowspan="10">Anak 0-6 Tahun</th>
                            <th>1</th>
                            <td class="text-start">Anak usia 2-6 tahun terdaftar dan aktif mengikuti kegiatan layanan PAUD.</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Tabel 4 -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="table-light text-center align-middle">
                            <th colspan="6">Tabel 4. Tingkat Konvergensi Desa</th>
                        </tr>
                        <tr class="bg-dark text-light text-center align-middle">
                            <th rowspan="2">No</th>
                            <th rowspan="2">Sasaran</th>
                            <th colspan="2">Jumlah Indikator</th>
                            <th rowspan="2">Tingkat Konvergensi (%)</th>
                        </tr>
                        <tr class="bg-dark text-light text-center align-middle">
                            <th>Yang Diterima</th>
                            <th>Seharusnya Diterima</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="text-center align-middle">
                            <th>1</th>
                            <td class="text-start">Ibu Hamil</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>2</th>
                            <td class="text-start">Anak 0-23 Bulan</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <th colspan="2">Total Tingkat Konvergensi Desa</th>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@include('partials.commonScripts')
@endsection