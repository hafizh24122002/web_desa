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

                <a href="/staf/kependudukan/keluarga/edit-keluarga/{{ $data->no_kk }}">
                    <button class="btn btn-sm btn-warning">
                        <i class="bx bx-edit-alt text-light"></i>
                    </button>
                </a>

                <form action="/staf/kependudukan/keluarga/{{ $data->no_kk }}"
                    onsubmit="return confirm('Apakah anda yakin ingin menghapus keluarga dengan No. KK {{ $data->no_kk }}? Keluarga yang dihapus tidak akan bisa dikembalikan!')"
                    method="POST">

                    @method('delete')
                    @csrf

                    <button class="btn btn-sm btn-danger" type="submit">
                        <i class="bx bx-trash text-light"></i>
                    </button>
                </form>
            </div>
        </td>

        <td>{{ $data->no_kk }}</td>

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
            @if ($data->dtks)
                {{ $data->dtks }}
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

        <td>
            @if ($data->tgl_cetak_kk)
                {{ $data->tgl_cetak_kk }}
            @else
                {{ '-' }}
            @endif
        </td>
    </tr>
@endforeach
