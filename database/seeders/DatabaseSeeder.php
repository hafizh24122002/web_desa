<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Agama;
use App\Models\Artikel;
use App\Models\HubunganKK;
use App\Models\KelasSosial;
use App\Models\Keluarga;
use App\Models\Kesehatan;
use App\Models\Kewarganegaraan;
use App\Models\Pekerjaan;
use App\Models\PendidikanSaatIni;
use App\Models\PendidikanTerakhir;
use App\Models\Penduduk;
use App\Models\Rtm;
use App\Models\StatusPerkawinan;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Agama::create(['nama' => 'ISLAM']);
        Agama::create(['nama' => 'KRISTEN']);
        Agama::create(['nama' => 'KATOLIK']);
        Agama::create(['nama' => 'HINDU']);
        Agama::create(['nama' => 'BUDHA']);
        Agama::create(['nama' => 'KONGHUCU']);
        Agama::create(['nama' => 'LAINNYA']);

        for($i = 0; $i < 20; $i++){
            Artikel::create([
                'id_staf' => 2,
                'judul' => 'judul artikel',
                'isi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pellentesque sapien id consectetur venenatis. Donec at lectus enim. In tempor aliquam suscipit. Pellentesque scelerisque volutpat sem, a tempus felis consequat eu. Proin vel augue mattis, porta quam vel, semper urna. Etiam tellus odio, posuere at odio nec, egestas accumsan sapien. Mauris neque est, pharetra placerat arcu sit amet, efficitur laoreet leo. Suspendisse in dictum justo. Pellentesque ut urna libero. Quisque laoreet, felis in rhoncus cursus, felis purus gravida sapien, vitae egestas purus risus ac tortor. Nunc quis arcu diam. Cras commodo tincidunt tortor, ac posuere diam. Suspendisse pretium interdum ipsum vestibulum consectetur.
    
Vestibulum erat nibh, porta sit amet molestie ac, placerat at odio. Mauris aliquam, nisl sit amet sollicitudin molestie, mauris enim ornare lectus, sed varius dolor quam non quam. Proin at vestibulum felis, vitae posuere justo. Morbi eleifend orci vel tellus porttitor tristique. In vel orci aliquam, vulputate leo id, aliquet orci. Sed non vulputate elit, eu suscipit lacus. Sed finibus rhoncus ante, non venenatis nisl egestas sit amet. Integer imperdiet dapibus arcu sit amet lobortis. Vivamus tempor nisl et urna imperdiet sollicitudin. Nunc mattis aliquet orci, et euismod erat varius vitae. Praesent elementum porta metus, in consequat risus dignissim eget. Etiam neque odio, suscipit ac luctus non, maximus congue mauris. Proin eros lectus, tincidunt ut porta ut, eleifend at erat. Sed fermentum, nisl sit amet mattis aliquam, neque orci sagittis mauris, id mollis purus libero quis urna. Nunc et facilisis neque, quis viverra eros. Fusce bibendum convallis volutpat.

Mauris sed sagittis tortor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus laoreet a ante ac congue. Aenean est libero, pulvinar quis ipsum a, posuere vestibulum arcu. Morbi eu cursus erat. Mauris imperdiet malesuada posuere. Curabitur pulvinar maximus imperdiet. Aenean posuere odio ac imperdiet aliquet. Quisque condimentum lobortis pellentesque. Curabitur porttitor massa justo, quis vestibulum ligula faucibus gravida.

Pellentesque vel pellentesque dui. Proin tellus neque, semper ut tortor eu, sollicitudin volutpat dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum nisi elit, viverra vitae tortor sed, ornare egestas orci. Nullam neque lorem, venenatis eu dui ac, sodales ultricies quam. Suspendisse euismod mauris vitae fringilla gravida. Aenean leo neque, aliquam id pharetra id, sollicitudin et sem. Donec in facilisis tortor. Praesent non purus ut enim pretium convallis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.

Duis ac pulvinar ipsum. In hac habitasse platea dictumst. Etiam sed ligula est. Mauris et gravida tellus. Quisque ac commodo elit. Sed a velit nibh. Praesent a tortor pulvinar, vehicula diam at, lobortis nisl. Etiam congue quis magna ut blandit. Nullam dictum dui urna, eget dictum justo ultrices at. Integer dolor orci, finibus eu laoreet non, mollis at massa. Praesent vel placerat turpis.',
            ]);
        }

        HubunganKK::create(['nama' => 'KEPALA KELUARGA']);
        HubunganKK::create(['nama' => 'SUAMI']);
        HubunganKK::create(['nama' => 'ISTRI']);
        HubunganKK::create(['nama' => 'ANAK']);
        HubunganKK::create(['nama' => 'MENANTU']);
        HubunganKK::create(['nama' => 'CUCU']);
        HubunganKK::create(['nama' => 'ORANGTUA']);
        HubunganKK::create(['nama' => 'MERTUA']);
        HubunganKK::create(['nama' => 'FAMILI LAIN']);
        HubunganKK::create(['nama' => 'PEMBANTU']);

        KelasSosial::create(['nama' => 'SANGAT MISKIN']);
        KelasSosial::create(['nama' => 'MISKIN']);
        KelasSosial::create(['nama' => 'MBR BAWAH']);
        KelasSosial::create(['nama' => 'MBR']);
        KelasSosial::create(['nama' => 'MBR ATAS']);
        KelasSosial::create(['nama' => 'MBM']);
        KelasSosial::create(['nama' => 'MBA']);

        Keluarga::create([
            'no_kk' => '6401042443210001',
            'nik_kepala' => '6401042412340001',
            'id_kelas_sosial' => '4',
            'alamat' => 'JL. MERPATI NO.51 RT.03/RW.02',
            'tgl_dikeluarkan' => '2006-04-15',
        ]);

        Kewarganegaraan::create(['nama' => 'WNI']);
        Kewarganegaraan::create(['nama' => 'WNA']);
        Kewarganegaraan::create(['nama' => 'DUA KEWARGANEGARAAN']);

        Pekerjaan::create(['nama' => 'BELUM/TIDAK BEKERJA']);
        Pekerjaan::create(['nama' => 'MENGURUS RUMAH TANGGA']);
        Pekerjaan::create(['nama' => 'PELAJAR/MAHASISWA']);
        Pekerjaan::create(['nama' => 'PENSIUN']);
        Pekerjaan::create(['nama' => 'PEGAWAI NEGERI SIPIL']);
        Pekerjaan::create(['nama' => 'TENTARA']);
        Pekerjaan::create(['nama' => 'KEPOLISIAN']);
        Pekerjaan::create(['nama' => 'PERDAGANGAN']);
        Pekerjaan::create(['nama' => 'PETANI/PEKEBUN']);
        Pekerjaan::create(['nama' => 'PETERNAK']);
        Pekerjaan::create(['nama' => 'NELAYAN/PERIKANAN']);
        Pekerjaan::create(['nama' => 'INDUSTRI']);
        Pekerjaan::create(['nama' => 'KONSTRUKSI']);
        Pekerjaan::create(['nama' => 'TRANSPORTASI']);
        Pekerjaan::create(['nama' => 'KARYAWAN SWASTA']);
        Pekerjaan::create(['nama' => 'KARYAWAN BUMN']);
        Pekerjaan::create(['nama' => 'KARYAWAN BUMD']);
        Pekerjaan::create(['nama' => 'KARYAWAN HONORER']);
        Pekerjaan::create(['nama' => 'BURUH HARIAN LEPAS']);
        Pekerjaan::create(['nama' => 'BURUH TANI/PERKEBUNAN']);
        Pekerjaan::create(['nama' => 'BURUH NELAYAN/PERIKANAN']);
        Pekerjaan::create(['nama' => 'BURUH PETERNAKAN']);
        Pekerjaan::create(['nama' => 'PEMBANTU RUMAH TANGGA']);
        Pekerjaan::create(['nama' => 'TUKANG CUKUR']);
        Pekerjaan::create(['nama' => 'TUKANG LISTRIK']);
        Pekerjaan::create(['nama' => 'TUKANG BATU']);
        Pekerjaan::create(['nama' => 'TUKANG KAYU']);
        Pekerjaan::create(['nama' => 'TUKANG SOL SEPATU']);
        Pekerjaan::create(['nama' => 'TUKANG LAS/PANDAI BESI']);
        Pekerjaan::create(['nama' => 'TUKANG JAHIT']);
        Pekerjaan::create(['nama' => 'PENATA RAMBUT']);
        Pekerjaan::create(['nama' => 'PENATA RIAS']);
        Pekerjaan::create(['nama' => 'PENATA BUSANA']);
        Pekerjaan::create(['nama' => 'MEKANIK']);
        Pekerjaan::create(['nama' => 'TUKANG GIGI']);
        Pekerjaan::create(['nama' => 'SENIMAN']);
        Pekerjaan::create(['nama' => 'TABIB']);
        Pekerjaan::create(['nama' => 'PARAJI']);
        Pekerjaan::create(['nama' => 'PERANCANG BUSANA']);
        Pekerjaan::create(['nama' => 'PENTERJEMAH']);
        Pekerjaan::create(['nama' => 'IMAM MASJID']);
        Pekerjaan::create(['nama' => 'PENDETA']);
        Pekerjaan::create(['nama' => 'PASTUR']);
        Pekerjaan::create(['nama' => 'WARTAWAN']);
        Pekerjaan::create(['nama' => 'USTADZ/MUBALIGH']);
        Pekerjaan::create(['nama' => 'JURU MASAK']);
        Pekerjaan::create(['nama' => 'PROMOTOR ACARA']);
        Pekerjaan::create(['nama' => 'ANGGOTA DPR']);
        Pekerjaan::create(['nama' => 'ANGGOTA DPD']);
        Pekerjaan::create(['nama' => 'ANGGOTA BPK']);
        Pekerjaan::create(['nama' => 'PRESIDEN']);
        Pekerjaan::create(['nama' => 'WAKIL PRESIDEN']);
        Pekerjaan::create(['nama' => 'ANGGOTA MAHKAMAH KONSTITUSI']);
        Pekerjaan::create(['nama' => 'ANGGOTA KABINET/KEMENTERIAN']);
        Pekerjaan::create(['nama' => 'DUTA BESAR']);
        Pekerjaan::create(['nama' => 'GUBERNUR']);
        Pekerjaan::create(['nama' => 'WAKIL GUBERNUR']);
        Pekerjaan::create(['nama' => 'BUPATI']);
        Pekerjaan::create(['nama' => 'WAKIL BUPATI']);
        Pekerjaan::create(['nama' => 'WALIKOTA']);
        Pekerjaan::create(['nama' => 'WAKIL WALIKOTA']);
        Pekerjaan::create(['nama' => 'ANGGOTA DPRD PROVINSI']);
        Pekerjaan::create(['nama' => 'ANGGOTA DPRD KAB/KOTA']);
        Pekerjaan::create(['nama' => 'DOSEN']);
        Pekerjaan::create(['nama' => 'GURU']);
        Pekerjaan::create(['nama' => 'PILOT']);
        Pekerjaan::create(['nama' => 'PENGACARA']);
        Pekerjaan::create(['nama' => 'NOTARIS']);
        Pekerjaan::create(['nama' => 'ARSITEK']);
        Pekerjaan::create(['nama' => 'AKUNTAN']);
        Pekerjaan::create(['nama' => 'KONSULTAN']);
        Pekerjaan::create(['nama' => 'DOKTER']);
        Pekerjaan::create(['nama' => 'BIDAN']);
        Pekerjaan::create(['nama' => 'PERAWAT']);
        Pekerjaan::create(['nama' => 'APOTEKER']);
        Pekerjaan::create(['nama' => 'PSIKIATER/PSIKOLOG']);
        Pekerjaan::create(['nama' => 'PENYIAR TELEVISI']);
        Pekerjaan::create(['nama' => 'PENYIAR RADIO']);
        Pekerjaan::create(['nama' => 'PELAUT']);
        Pekerjaan::create(['nama' => 'PENELITI']);
        Pekerjaan::create(['nama' => 'SOPIR']);
        Pekerjaan::create(['nama' => 'PIALANG']);
        Pekerjaan::create(['nama' => 'PARANORMAL']);
        Pekerjaan::create(['nama' => 'LAINNYA']);

        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);
        PendidikanSaatIni::create(['nama' => '']);

        PendidikanTerakhir::create(['nama' => 'TIDAK/BELUM SEKOLAH']);
        PendidikanTerakhir::create(['nama' => 'BELUM TAMAT SD/SEDERAJAT']);
        PendidikanTerakhir::create(['nama' => 'TAMAT SD/SEDERAJAT']);
        PendidikanTerakhir::create(['nama' => 'SLTP/SEDERAJAT']);
        PendidikanTerakhir::create(['nama' => 'SLTA/SEDERAJAT']);
        PendidikanTerakhir::create(['nama' => 'DIPLOMA I/II']);
        PendidikanTerakhir::create(['nama' => 'AKADEMI/DIPLOMA III/S. MUDA']);
        PendidikanTerakhir::create(['nama' => 'DIPLOMA IV/STRATA I']);
        PendidikanTerakhir::create(['nama' => 'STRATA II']);
        PendidikanTerakhir::create(['nama' => 'STRATA III']);

        Penduduk::create([
            'nama' => 'HAFIZH LUTFI HIDAYAT',
            'nik' => '6401042412340001',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'SAMARINDA',
            'tanggal_lahir' => '2002-12-24',
            'penduduk_tetap' => true,
            'telepon' => '081255598024',
        ]);

        StatusPerkawinan::create(['nama' => 'BELUM KAWIN']);
        StatusPerkawinan::create(['nama' => 'KAWIN']);
        StatusPerkawinan::create(['nama' => 'CERAI HIDUP']);
        StatusPerkawinan::create(['nama' => 'CERAI MATI']);

        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'id_grup' => 1,
            'name' => 'admin',
        ]);
        User::create([
            'username' => 'staf',
            'password' => Hash::make('password'),
            'id_grup' => 2,
            'name' => 'staf',
        ]);

        
    }
}
