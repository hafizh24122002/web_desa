<div class="table-responsive table-min-height">
    <table
        class="table table-condensed table-bordered dataTable table-striped table-hover tabel-daftar table text-nowrap ">
        <thead class="bg-gray color-palette">
            <tr class="bg-dark text-light text-center align-middle">
                <th rowspan="5">NO</th>
                <th rowspan="5">NAMA DUSUN</th>
                <th colspan="7">JUMLAH PENDUDUK AWAL BULAN</th>
                <th colspan="8">TAMBAHAN BULAN INI</th>
                <th colspan="8">PENGURANGAN BULAN INI</th>
                <th rowspan="2" colspan="7">JML PENDUDUK AKHIR BULAN</th>
                <th rowspan="4">KET</th>
            </tr>
            
            <tr class="bg-dark text-light text-center align-middle">
                <th colspan="2">WNA</th>
                <th colspan="2">WNI</th>
                <th rowspan="3">JML KEPALA KELUARGA</th>
                <th rowspan="3">JML ANGGOTA KELUARGA</th>
                <th rowspan="3">JML JIWA (7+8)</th>
                <th colspan="4">LAHIR</th>
                <th colspan="4">DATANG</th>
                <th colspan="4">MENINGGAL</th>
                <th colspan="4">PINDAH</th>
            </tr>

            <tr class="bg-dark text-light text-center align-middle">
                <th rowspan="2">L</th>
                <th rowspan="2">P</th>
                <th rowspan="2">L</th>
                <th rowspan="2">P</th>

                <th colspan="2">WNA</th>
                <th colspan="2">WNI</th>

                <th colspan="2">WNA</th>
                <th colspan="2">WNI</th>

                <th colspan="2">WNA</th>
                <th colspan="2">WNI</th>
                
                <th colspan="2">WNA</th>
                <th colspan="2">WNI</th>

                <th colspan="2">WNA</th>
                <th colspan="2">WNI</th>

                <th rowspan="3">JML KEPALA KELUARGA</th>
                <th rowspan="3">JML ANGGOTA KELUARGA</th>
                <th rowspan="3">JML JIWA (30+31)</th>
            </tr>

            <tr class="bg-dark text-light text-center align-middle">
                <th>L</th>
                <th>P</th>
                <th>L</th>
                <th>P</th>

                <th>L</th>
                <th>P</th>
                <th>L</th>
                <th>P</th>
                
                <th>L</th>
                <th>P</th>
                <th>L</th>
                <th>P</th>

                <th>L</th>
                <th>P</th>
                <th>L</th>
                <th>P</th>

                <th>L</th>
                <th>P</th>
                <th>L</th>
                <th>P</th>
            </tr>

            <tr></tr>

            <tr class="bg-dark text-light text-center align-middle">
                <th>1</th>
                <th>2</th>

                {{-- jml penduduk awal bulan --}}
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>

                {{-- tambahan bulan ini --}}
                <th>10</th>
                <th>11</th>
                <th>12</th>
                <th>13</th>
                <th>14</th>
                <th>15</th>
                <th>16</th>
                <th>17</th>

                {{-- pengurangan bulan ini --}}
                <th>18</th>
                <th>19</th>
                <th>20</th>
                <th>21</th>
                <th>22</th>
                <th>23</th>
                <th>24</th>
                <th>25</th>

                {{-- jml penduduk akhir bulan --}}
                <th>26</th>
                <th>27</th>
                <th>28</th>
                <th>29</th>
                <th>30</th>
                <th>31</th>
                <th>32</th>

                <th>33</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($dusun as $key => $data)
                <tr class="text-center align-middle">
                    <td>{{ $dusun->firstItem() + $key }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $todo ?? '-' }}</td>     {{-- penduduk awal bulan/wna/l --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- penduduk awal bulan/wna/p --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- penduduk awal bulan/wni/l --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- penduduk awal bulan/wni/p --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- penduduk awal bulan/jml kk --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- penduduk awal bulan/jml anggota --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- penduduk awal bulan/jml jiwa --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- tambahan bulan ini/lahir/wna/l --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- tambahan bulan ini/lahir/wna/p --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- tambahan bulan ini/lahir/wni/l --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- tambahan bulan ini/lahir/wni/p --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- tambahan bulan ini/datang/wna/l --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- tambahan bulan ini/datang/wna/p --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- tambahan bulan ini/datang/wni/l --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- tambahan bulan ini/datang/wni/p --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- pengurangan bulan ini/meninggal/wna/l --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- pengurangan bulan ini/meninggal/wna/p --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- pengurangan bulan ini/meninggal/wni/l --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- pengurangan bulan ini/meninggal/wni/p --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- pengurangan bulan ini/pindah/wna/l --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- pengurangan bulan ini/pindah/wna/p --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- pengurangan bulan ini/pindah/wni/l --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- pengurangan bulan ini/pindah/wni/p --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- penduduk akhir bulan/wna/l --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- penduduk akhir bulan/wna/p --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- penduduk akhir bulan/wni/l --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- penduduk akhir bulan/wni/p --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- penduduk akhir bulan/jml kk --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- penduduk akhir bulan/jml anggota --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- penduduk akhir bulan/jml jiwa --}}
                    <td>{{ $todo ?? '-' }}</td>     {{-- ket --}}
            @endforeach
        </tbody>
    </table>
</div>