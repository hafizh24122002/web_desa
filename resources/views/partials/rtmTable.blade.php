@foreach ($rtm as $key => $data)
    <tr class="text-center align-middle">
        <td>{{ $rtm->firstitem() + $key }}</td>

        <td>
            <div style="display: flex; gap: 5px; justify-content: center;">
                <a href="/staf/kependudukan/keluarga/anggota/{{ $data->no_kk }}">
                    <button class="btn btn-sm btn-primary">
                        <i class="bx bx-list-ul text-light"></i>
                    </button>
                </a>

                <a href="/staf/kependudukan/rtm/edit-rtm/{{ $data->no_rtm }}">
                    <button class="btn btn-sm btn-warning">
                        <i class="bx bx-edit-alt text-light"></i>
                    </button>
                </a>

                <form action="/staf/kependudukan/rtm/{{ $data->no_rtm }}"
                    onsubmit="return confirm('Apakah anda yakin ingin menghapus rumah tangga dengan No. rumah tangga {{ $data->no_rtm }}? Rumah tangga yang dihapus tidak akan bisa dikembalikan!')"
                    method="POST">

                    @method('delete')
                    @csrf

                    <button class="btn btn-sm btn-danger" type="submit">
                        <i class="bx bx-trash text-light"></i>
                    </button>
                </form>
            </div>
        </td>

        <td>{{ $data->no_rtm }}</td>

        <td>
            @if ($data->nama_kepala_keluarga)
                {{ $data->nama_kepala_keluarga }}
            @else
                {{ '-' }}
            @endif
        </td>

        <td>
            @if ($data->nik_kepala)
                {{ $data->nik_kepala }}
            @else
                {{ '-' }}
            @endif
        </td>

        <td>
            @if ($data->dtks == 1)
                {{ 'Terdaftar' }}
            @elseif ($data->dtks == 0)
                {{ 'Tidak terdaftar' }}
            @else
                {{ '-' }}
            @endif
        </td>
        

        <td>
            @if ($data->jumlah_anggota)
                {{ $data->jumlah_anggota }}
            @else
                {{ '-' }}
            @endif
        </td>

        <td>
            @if ($data->alamat)
                {{ $data->alamat }}
            @else
                {{ '-' }}
            @endif
        </td>

        <td>
            @if ($data->tgl_daftar)
                {{ $data->tgl_daftar }}
            @else
                {{ '-' }}
            @endif
        </td>
    </tr>
@endforeach
