<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Agama;
use App\Models\Artikel;
use App\Models\HubunganKK;
use App\Models\IbuHamil;
use App\Models\IdentitasDesa;
use App\Models\Image;
use App\Models\KelasSosial;
use App\Models\Keluarga;
use App\Models\Kesehatan;
use App\Models\Kewarganegaraan;
use App\Models\Kia;
use App\Models\LogPenduduk;
use App\Models\Pekerjaan;
use App\Models\PendidikanSaatIni;
use App\Models\PendidikanTerakhir;
use App\Models\Penduduk;
use App\Models\PendudukBahasa;
use App\Models\PenyebabKematian;
use App\Models\PenolongKematian;
use App\Models\Peristiwa;
use App\Models\Pindah;
use App\Models\Posyandu;
use App\Models\Rtm;
use App\Models\StatusDasar;
use App\Models\StatusPerkawinan;
use App\Models\Staf;
use App\Models\Surat;
use App\Models\Tamu;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Coordinate;
use App\Models\Asuransi;
use App\Models\Cacat;
use App\Models\CaraKb;
use App\Models\GolonganDarah;
use App\Models\HelperDusun;
use App\Models\HelperPendudukKeluarga;
use App\Models\HelperPendudukRtm;
use App\Models\HelperRt;
use App\Models\JenisKelamin;
use App\Models\KetuaRt;
use App\Models\RtmHubungan;
use App\Models\SakitMenahun;
use App\Models\WilayahRt;
use App\Models\WilayahDusun;

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

        RtmHubungan::create(['nama' => 'KEPALA RUMAH TANGGA']);
        RtmHubungan::create(['nama' => 'ANGGOTA']);

        JenisKelamin::create([
            'nama' => 'LAKI-LAKI',
            'singkatan' => 'L'
        ]);
        JenisKelamin::create([
            'nama' => 'PEREMPUAN',
            'singkatan' => 'P'
        ]);

        GolonganDarah::create(['nama' => 'A']);
        GolonganDarah::create(['nama' => 'B']);
        GolonganDarah::create(['nama' => 'AB']);
        GolonganDarah::create(['nama' => 'O']);
        GolonganDarah::create(['nama' => 'A+']);
        GolonganDarah::create(['nama' => 'A-']);
        GolonganDarah::create(['nama' => 'B+']);
        GolonganDarah::create(['nama' => 'B-']);
        GolonganDarah::create(['nama' => 'AB+']);
        GolonganDarah::create(['nama' => 'AB-']);
        GolonganDarah::create(['nama' => 'O+']);
        GolonganDarah::create(['nama' => 'O-']);
        GolonganDarah::create(['nama' => 'TIDAK TAHU']);

        CaraKb::create([
            'nama' => 'PIL',
            'id_jenis_kelamin' => '2'
        ]);
        CaraKb::create([
            'nama' => 'SUNTIK',
            'id_jenis_kelamin' => '2'
        ]);
        CaraKb::create([
            'nama' => 'KONDOM',
            'id_jenis_kelamin' => '1'
        ]);
        CaraKb::create([
            'nama' => 'SUSUK KB',
            'id_jenis_kelamin' => '2'
        ]);
        CaraKb::create([
            'nama' => 'STERILISASI WANITA',
            'id_jenis_kelamin' => '2'
        ]);
        CaraKb::create([
            'nama' => 'STERILISASI PRIA',
            'id_jenis_kelamin' => '1'
        ]);
        CaraKb::create([
            'nama' => 'LAINNYA',
            'id_jenis_kelamin' => '3'
        ]);
        CaraKb::create([
            'nama' => 'TIDAK MENGGUNAKAN',
            'id_jenis_kelamin' => '3'
        ]);

        KelasSosial::create(['nama' => 'SANGAT MISKIN']);
        KelasSosial::create(['nama' => 'MISKIN']);
        KelasSosial::create(['nama' => 'MBR BAWAH']);
        KelasSosial::create(['nama' => 'MBR']);
        KelasSosial::create(['nama' => 'MBR ATAS']);
        KelasSosial::create(['nama' => 'MBM']);
        KelasSosial::create(['nama' => 'MBA']);

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

        PendidikanSaatIni::create(['nama' => 'BELUM MASUK TK/KELOMPOK BERMAIN']);
        PendidikanSaatIni::create(['nama' => 'SEDANG TK/KELOMPOK BERMAIN']);
        PendidikanSaatIni::create(['nama' => 'TIDAK PERNAH SEKOLAH']);
        PendidikanSaatIni::create(['nama' => 'SEDANG SD/SEDERAJAT']);
        PendidikanSaatIni::create(['nama' => 'TIDAK TAMAT/SD SEDERAJAT']);
        PendidikanSaatIni::create(['nama' => 'SEDANG SLTP/SEDERAJAT']);
        PendidikanSaatIni::create(['nama' => 'SEDANG SLTA/SEDERAJAT']);
        PendidikanSaatIni::create(['nama' => 'SEDANG D-1/SEDERAJAT']);
        PendidikanSaatIni::create(['nama' => 'SEDANG D-2/SEDERAJAT']);
        PendidikanSaatIni::create(['nama' => 'SEDANG D-3/SEDERAJAT']);
        PendidikanSaatIni::create(['nama' => 'SEDANG S-1/SEDERAJAT']);
        PendidikanSaatIni::create(['nama' => 'SEDANG S-2/SEDERAJAT']);
        PendidikanSaatIni::create(['nama' => 'SEDANG S-3/SEDERAJAT']);
        PendidikanSaatIni::create(['nama' => 'SEDANG SLB A/SEDERAJAT']);
        PendidikanSaatIni::create(['nama' => 'SEDANG SLB B/SEDERAJAT']);
        PendidikanSaatIni::create(['nama' => 'SEDANG SLB C/SEDERAJAT']);
        PendidikanSaatIni::create(['nama' => 'TIDAK DAPAT MEMBACA DAN MENULIS HURUF LATIN/ARAB']);
        PendidikanSaatIni::create(['nama' => 'TIDAK SEDANG SEKOLAH']);

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

        PendudukBahasa::create([
            'nama' => 'Latin',
            'singkatan' => 'L'
        ]);
        PendudukBahasa::create([
            'nama' => 'Daerah',
            'singkatan' => 'D'
        ]);
        PendudukBahasa::create([
            'nama' => 'Arab',
            'singkatan' => 'A'
        ]);
        PendudukBahasa::create([
            'nama' => 'Arab dan Latin',
            'singkatan' => 'AL'
        ]);
        PendudukBahasa::create([
            'nama' => 'Arab dan Daerah',
            'singkatan' => 'AD'
        ]);
        PendudukBahasa::create([
            'nama' => 'Arab, Latin, dan Daerah',
            'singkatan' => 'ALD'
        ]);

        PenyebabKematian::create(['nama' => 'Sakit biasa / tua']);
        PenyebabKematian::create(['nama' => 'Wabah penyakit']);
        PenyebabKematian::create(['nama' => 'Kecelakaan']);
        PenyebabKematian::create(['nama' => 'Kriminalitas']);
        PenyebabKematian::create(['nama' => 'Bunuh diri']);
        PenyebabKematian::create(['nama' => 'Lainnya']);

        PenolongKematian::create(['nama' => 'Dokter']);
        PenolongKematian::create(['nama' => 'Tenaga Kesehatan']);
        PenolongKematian::create(['nama' => 'Kepolisian']);
        PenolongKematian::create(['nama' => 'Lainnya']);

        Peristiwa::create(['nama' => 'Lahir']);
        Peristiwa::create(['nama' => 'Mati']);
        Peristiwa::create(['nama' => 'Pindah Keluar']);
        Peristiwa::create(['nama' => 'Hilang']);
        Peristiwa::create(['nama' => 'Pindah Masuk']);
        Peristiwa::create(['nama' => 'Pergi']);

        Pindah::create(['nama' => 'Pindah keluar Desa/Kelurahan']);
        Pindah::create(['nama' => 'Pindah keluar Kecamatan']);
        Pindah::create(['nama' => 'Pindah keluar Kabupaten/Kota']);
        Pindah::create(['nama' => 'Pindah keluar Provinsi']);

        StatusDasar::create(['nama' => 'HIDUP']);
        StatusDasar::create(['nama' => 'MATI']);
        StatusDasar::create(['nama' => 'PINDAH']);
        StatusDasar::create(['nama' => 'HILANG']);
        StatusDasar::create(['nama' => 'PERGI']);
        StatusDasar::create(['nama' => 'TIDAK VALID']);

        StatusPerkawinan::create(['nama' => 'BELUM KAWIN']);
        StatusPerkawinan::create(['nama' => 'KAWIN']);
        StatusPerkawinan::create(['nama' => 'CERAI HIDUP']);
        StatusPerkawinan::create(['nama' => 'CERAI MATI']);

        Cacat::create(['nama' => 'CACAT FISIK']);
        Cacat::create(['nama' => 'CACAT NETRA/BUTA']);
        Cacat::create(['nama' => 'CACAT RUNGU/WICARA']);
        Cacat::create(['nama' => 'CACAT MENTAL/JIWA']);
        Cacat::create(['nama' => 'CACAT FISIK DAN MENTAL']);
        Cacat::create(['nama' => 'CACAT LAINNYA']);
        Cacat::create(['nama' => 'TIDAK CACAT']);

        Asuransi::create(['nama' => 'TIDAK/BELUM PUNYA']);
        Asuransi::create(['nama' => 'BPJS PENERIMA BANTUAN IURAN']);
        Asuransi::create(['nama' => 'BPJS NON PENERIMA BANTUAN IURAN']);
        Asuransi::create(['nama' => 'ASURANSI LAINNYA']);

        SakitMenahun::create(['nama' => 'JANTUNG']);
        SakitMenahun::create(['nama' => 'LEVER']);
        SakitMenahun::create(['nama' => 'PARU-PARU']);
        SakitMenahun::create(['nama' => 'KANKER']);
        SakitMenahun::create(['nama' => 'STROKE']);
        SakitMenahun::create(['nama' => 'DIABETES MELITUS']);
        SakitMenahun::create(['nama' => 'GINJAL']);
        SakitMenahun::create(['nama' => 'MALARIA']);
        SakitMenahun::create(['nama' => 'LEPRA/KUSTA']);
        SakitMenahun::create(['nama' => 'HIV/AIDS']);
        SakitMenahun::create(['nama' => 'GILA/STRESS']);
        SakitMenahun::create(['nama' => 'TBC']);
        SakitMenahun::create(['nama' => 'ASTHMA']);
        SakitMenahun::create(['nama' => 'TIDAK ADA/TIDAK SAKIT']);

        Surat::create([
            'nama' => 'KETERANGAN USAHA',
            'kode_surat' => '521',
            'filename' => 'keterangan_usaha.docx',
        ]);
        Surat::create([
            'nama' => 'KETERANGAN TIDAK MAMPU',
            'kode_surat' => '474.4',
            'filename' => 'sktm.docx',
        ]);
        Surat::create([
            'nama' => 'KETERANGAN PENGHASILAN ORANG TUA',
            'kode_surat' => '474.4',
            'filename' => 'skpo.docx',
        ]);
        Surat::create([
            'nama' => 'UNDANGAN PEMBAHASAN HUT BASEL',
            'kode_surat' => '140',
            'filename' => 'undangan_pembahasan_hut_basel.docx',
        ]);
        Surat::create([
            'nama' => 'REKOMENDASI IZIN KERAMAIAN',
            'kode_surat' => '300',
            'filename' => 'rekomendasi_keramaian.docx',
        ]);
        Surat::create([
            'nama' => 'KETERANGAN BELUM MENIKAH',
            'kode_surat' => '474.4',
            'filename' => 'keterangan_belum_menikah.docx',
        ]);

        Staf::create([
            'nama' => 'RIZA UMAMI',
            'jabatan' => 'Kepala Desa',
        ]);
        Staf::create([
            'nama' => 'HOTIB',
            'jabatan' => 'Sekretaris Desa',
        ]);
        Staf::create([
            'nama' => 'ISWANDI',
            'jabatan' => 'Kasi Kesejahteraan',
        ]);
        Staf::create([
            'nama' => 'RENDY SANDRA',
            'jabatan' => 'Kasi Pelayanan',
        ]);
        Staf::create([
            'nama' => 'ISBIK MIRWANTO',
            'jabatan' => 'Kasi Pemerintahan',
        ]);
        Staf::create([
            'nama' => 'DIAH ISMAINI',
            'jabatan' => 'Kasi TU dan Umum',
        ]);
        Staf::create([
            'nama' => 'SUFARTA',
            'jabatan' => 'Kaur Perencanaan',
        ]);
        Staf::create([
            'nama' => 'ERLANGGA',
            'jabatan' => 'Kaur Keuangan',
        ]);
        Staf::create([
            'nama' => 'HORMEN',
            'jabatan' => 'Kepala Dusun 1',
        ]);
        Staf::create([
            'nama' => 'SUHARDI',
            'jabatan' => 'Kepala Dusun 2',
        ]);
        Staf::create([
            'nama' => 'SILVI FEBRIANTI',
            'jabatan' => 'Staf Administrasi',
        ]);

        HelperPendudukRtm::create([
            'no_rtm' => '10000000001',
            'nik_kepala' => '6401042412340001',
        ]);

        HelperPendudukRtm::create([
            'no_rtm' => '10000000002',
            'nik_kepala' => '6401042412340002',
        ]);

        HelperPendudukKeluarga::create([
            'no_kk' => '1234567891234567',
            'nik_kepala' => '6401042412340001',
        ]);

        HelperPendudukKeluarga::create([
            'no_kk' => '1234567891234568',
            'nik_kepala' => '6401042412340002',
        ]);

        HelperDusun::create(['nik_kepala' => '6401042412340001']);
        HelperDusun::create(['nik_kepala' => '6401042412340002']);
        HelperDusun::create(['nik_kepala' => '6401042412340008']);

        HelperRt::create(['nik_kepala' => '6401042412340003']);
        HelperRt::create(['nik_kepala' => '6401042412340006']);
        HelperRt::create(['nik_kepala' => '6401042412340007']);

        WilayahDusun::create([
            'nama' => 'DUSUN 1',
            'id_helper_dusun' => 1,
        ]);

        WilayahDusun::create([
            'nama' => 'DUSUN 2',
            'id_helper_dusun' => 2,
        ]);

        WilayahDusun::create([
            'nama' => 'DUSUN 3',
            'id_helper_dusun' => 3,
        ]);

        WilayahRt::create([
            'nama' => '001',
            'id_helper_rt' => 1,
            'id_wilayah_dusun' => 1,
        ]);

        WilayahRt::create([
            'nama' => '001',
            'id_helper_rt' => 2,
            'id_wilayah_dusun' => 2,
        ]);

        WilayahRt::create([
            'nama' => '002',
            'id_helper_rt' => 3,
            'id_wilayah_dusun' => 3,
        ]);

        Penduduk::create([
            'nama' => 'HAFIZH LUTFI HIDAYAT',
            'nik' => '6401042412340001',
            'id_helper_penduduk_keluarga' => 1,
            'id_helper_penduduk_rtm' => 1,
            'id_hubungan_kk' => 1,
            'id_rtm_hubungan' => 1,
            'id_wilayah_dusun' => 1,
            'id_wilayah_rt' => 1,
            'id_jenis_kelamin' => 1,
            'tempat_lahir' => 'SAMARINDA',
            'tanggal_lahir' => '2002-12-24',
            'id_agama' => 1,
            'id_pendidikan_terakhir' => 1,
            'id_pendidikan_saat_ini' => 1,
            'id_pekerjaan' => 3,
            'id_status_perkawinan' => 1,
            'id_kewarganegaraan' => 1,
            'nama_ayah' => 'John',
            'nama_ibu' => 'Jany',
            'penduduk_tetap' => false,
            'telepon' => '081255598024',
            'id_golongan_darah' => 4,
        ]);

        Penduduk::create([
            'nama' => 'AMIRAH DZATUL HIMMAH',
            'nik' => '6401042412340002',
            'id_helper_penduduk_keluarga' => 2,
            'id_helper_penduduk_rtm' => 2,
            'id_hubungan_kk' => 1,
            'id_rtm_hubungan' => 1,
            'id_wilayah_dusun' => 2,
            'id_wilayah_rt' => 2,
            'id_jenis_kelamin' => 2,
            'tempat_lahir' => 'BOGOR',
            'tanggal_lahir' => '2002-11-06',
            'id_agama' => 1,
            'id_pendidikan_terakhir' => 2,
            'id_pendidikan_saat_ini' => 2,
            'id_pekerjaan' => 3,
            'id_status_perkawinan' => 1,
            'id_kewarganegaraan' => 1,
            'nama_ayah' => 'John',
            'nama_ibu' => 'Jany',
            'penduduk_tetap' => true,
            'telepon' => '082114643544',
            'id_golongan_darah' => 1,
        ]);

        Penduduk::create([
            'nama' => 'ABDUL KARIM',
            'nik' => '6401042412340003',
            'id_helper_penduduk_keluarga' => 2,
            'id_helper_penduduk_rtm' => 2,
            'id_hubungan_kk' => 4,
            'id_rtm_hubungan' => 2,
            'id_wilayah_dusun' => 2,
            'id_wilayah_rt' => 2,
            'id_jenis_kelamin' => 1,
            'tempat_lahir' => 'BOGOR',
            'tanggal_lahir' => '2016-11-06',
            'id_agama' => 1,
            'id_pendidikan_terakhir' => 2,
            'id_pendidikan_saat_ini' => 2,
            'id_pekerjaan' => 3,
            'id_status_perkawinan' => 1,
            'id_kewarganegaraan' => 1,
            'nama_ayah' => 'John',
            'nama_ibu' => 'Jany',
            'penduduk_tetap' => true,
            'telepon' => '082114643590',
            'id_golongan_darah' => 1,
        ]);

        Penduduk::create([
            'nama' => 'SUJONO',
            'nik' => '6401042412340004',
            'id_helper_penduduk_keluarga' => 1,
            'id_helper_penduduk_rtm' => 1,
            'id_hubungan_kk' => 2,
            'id_rtm_hubungan' => 2,
            'id_jenis_kelamin' => 1,
            'tempat_lahir' => 'SAMARINDA',
            'tanggal_lahir' => '2002-12-24',
            'id_agama' => 1,
            'id_pendidikan_terakhir' => 1,
            'id_pendidikan_saat_ini' => 1,
            'id_pekerjaan' => 3,
            'id_status_perkawinan' => 1,
            'id_kewarganegaraan' => 1,
            'nama_ayah' => 'John',
            'nama_ibu' => 'Jany',
            'penduduk_tetap' => false,
            'telepon' => '081255598024',
            'id_golongan_darah' => 4,
        ]);

        Penduduk::create([
            'nama' => 'TUKIYEM',
            'nik' => '6401042412340005',
            'id_helper_penduduk_keluarga' => 2,
            'id_helper_penduduk_rtm' => 2,
            'id_hubungan_kk' => 2,
            'id_rtm_hubungan' => 2,
            'id_jenis_kelamin' => 1,
            'tempat_lahir' => 'SAMARINDA',
            'tanggal_lahir' => '2002-12-24',
            'id_agama' => 1,
            'id_pendidikan_terakhir' => 1,
            'id_pendidikan_saat_ini' => 1,
            'id_pekerjaan' => 3,
            'id_status_perkawinan' => 1,
            'id_kewarganegaraan' => 1,
            'nama_ayah' => 'John',
            'nama_ibu' => 'Jany',
            'penduduk_tetap' => false,
            'telepon' => '081255598024',
            'id_golongan_darah' => 4,
        ]);

        Penduduk::create([
            'nama' => 'AIJO KUNCORO',
            'nik' => '6401042412340006',
            'id_hubungan_kk' => 1,
            'id_wilayah_dusun' => 2,
            'id_wilayah_rt' => 2,
            'id_jenis_kelamin' => 2,
            'tempat_lahir' => 'DEPOK',
            'tanggal_lahir' => '2000-11-06',
            'id_agama' => 1,
            'id_pendidikan_terakhir' => 2,
            'id_pendidikan_saat_ini' => 2,
            'id_pekerjaan' => 3,
            'id_status_perkawinan' => 1,
            'id_kewarganegaraan' => 1,
            'nama_ayah' => 'John',
            'nama_ibu' => 'Jany',
            'penduduk_tetap' => true,
            'telepon' => '082114643544',
            'id_golongan_darah' => 2,
        ]);

        Penduduk::create([
            'nama' => 'JEANY',
            'nik' => '6401042412340007',
            'id_hubungan_kk' => 2,
            'id_wilayah_dusun' => 3,
            'id_wilayah_rt' => 3,
            'id_jenis_kelamin' => 2,
            'tempat_lahir' => 'DEPOK',
            'tanggal_lahir' => '2000-11-06',
            'id_agama' => 1,
            'id_pendidikan_terakhir' => 2,
            'id_pendidikan_saat_ini' => 2,
            'id_pekerjaan' => 3,
            'id_status_perkawinan' => 1,
            'id_kewarganegaraan' => 1,
            'nama_ayah' => 'John',
            'nama_ibu' => 'Jany',
            'penduduk_tetap' => false,
            'telepon' => '082114643544',
            'id_golongan_darah' => 3,
        ]);

        Penduduk::create([
            'nama' => 'DEVIA',
            'nik' => '6401042412340008',
            'id_hubungan_kk' => 3,
            'id_wilayah_dusun' => 3,
            'id_wilayah_rt' => 2,
            'id_jenis_kelamin' => 1,
            'tempat_lahir' => 'DEPOK',
            'tanggal_lahir' => '2000-11-06',
            'id_agama' => 1,
            'id_pendidikan_terakhir' => 2,
            'id_pendidikan_saat_ini' => 2,
            'id_pekerjaan' => 3,
            'id_status_perkawinan' => 1,
            'id_kewarganegaraan' => 1,
            'nama_ayah' => 'John',
            'nama_ibu' => 'Jany',
            'penduduk_tetap' => false,
            'telepon' => '082114643544',
            'id_golongan_darah' => 3,
        ]);

        LogPenduduk::create([
            'id_penduduk' => 1,
            'id_peristiwa' => 5,
            'alamat_tujuan' => 'JL. MERPATI NO. 51 RT.03/RW.02',
            'maksud_tujuan_kedatangan' => 'Melaksanakan KKN',
            'tanggal_lapor' => Carbon::now(),
            'tanggal_peristiwa' => Carbon::now(),
        ]);

        LogPenduduk::create([
            'id_penduduk' => 2,
            'id_peristiwa' => 1,
            'tanggal_lapor' => Carbon::now(),
            'tanggal_peristiwa' => Carbon::now(),
        ]);
        LogPenduduk::create([
            'id_penduduk' => 3,
            'id_peristiwa' => 1,
            'tanggal_lapor' => Carbon::now(),
            'tanggal_peristiwa' => Carbon::now(),
        ]);
        LogPenduduk::create([
            'id_penduduk' => 4,
            'id_peristiwa' => 1,
            'tanggal_lapor' => Carbon::now(),
            'tanggal_peristiwa' => Carbon::now(),
        ]);
        LogPenduduk::create([
            'id_penduduk' => 5,
            'id_peristiwa' => 5,
            'alamat_tujuan' => 'JL. MERPATI NO. 51 RT.03/RW.02',
            'maksud_tujuan_kedatangan' => 'Melaksanakan KKN',
            'tanggal_lapor' => Carbon::now(),
            'tanggal_peristiwa' => Carbon::now(),
        ]);
        LogPenduduk::create([
            'id_penduduk' => 5,
            'id_peristiwa' => 6,
            'catatan' => 'Kegiatan selesai',
            'tanggal_lapor' => Carbon::now(),
            'tanggal_peristiwa' => Carbon::now(),
        ]);

        Tamu::create([
            'id_log_penduduk_masuk' => 1,
        ]);
        Tamu::create([
            'id_log_penduduk_masuk' => 5,
            'id_log_penduduk_pergi' => 6,
        ]);

        Keluarga::create([
            'id_helper_penduduk_keluarga' => 1,
            'tgl_cetak_kk' => '2002-11-06',
            'id_kelas_sosial' => '4',
            'alamat' => 'JL. MERPATI NO.51 RT.03/RW.02',
        ]);

        Keluarga::create([
            'id_helper_penduduk_keluarga' => 2,
            'tgl_cetak_kk' => '2002-11-06',
            'id_kelas_sosial' => '4',
            'alamat' => 'JL. GAGAK NO.51 RT.03/RW.02',
        ]);

        Rtm::create([
            'id_helper_penduduk_rtm' => 1,
            'id_kelas_sosial' => 1,
            'bdt' => '',
            'dtks' => false,
            'alamat' => "JL. CEMPAKA",
        ]);

        Rtm::create([
            'id_helper_penduduk_rtm' => 2,
            'id_kelas_sosial' => 1,
            'bdt' => '10000000000000001',
            'dtks' => true,
            'alamat' => "JL. KENANGA",
        ]);

        Posyandu::create([
            'nama' => 'Posyandu Bakti Sehat',
            'alamat' => 'Jl. Melati No. 123',
        ]);

        // Kia::create([
        //     'no_kia' => '12345',
        //     'id_ibu' => 2,
        // ]);

        IdentitasDesa::create([
            'nama_desa' => 'Malik',
            'kode_desa' => '19.03.05.2002',
            'kode_pos_desa' => '33778',
            'nama_kepala_desa' => 'Riza Umami',
            'email_desa' => 'pemdesmalik@gmail.com',
            'website' => 'malik.com',
            'kode_kecamatan' => '19.03.05',
            'nama_kecamatan' => 'Payung',
            'nama_kabupaten' => 'Bangka Selatan',
            'kode_kabupaten' => '19.03',
            'kode_provinsi' => '19',
            'nama_provinsi' => 'Bangka Belitung',
        ]);

        Image::create([
            'filename' => 'foto_lambang.png',
            'hash' => 'b37bc134fcf5d965ebab9871226cb800',
            'path' => 'images/identitas_desa/foto_lambang.png',
        ]);
        Image::create([
            'filename' => 'kantor_desa.jpg',
            'hash' => '3f9313a95e727b43b34ee1ec00e49d39',
            'path' => 'images/identitas_desa/kantor_desa.jpg',
        ]);

        Agenda::create([
            'judul' => 'Bantuan KRS',
            'isi' => 'Pendistribusian bantuan Keluarga Berisiko Stunting (KRS) di kantor desa',
            'tgl_agenda' => '2023-08-17',
            'koordinator' => 'Amiw',
            'lokasi' => 'Kantor Desa'
        ]);

        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'id_grup' => 1,
            'id_staf' => 11,
            'name' => 'admin',
        ]);
        User::create([
            'username' => 'staf',
            'password' => Hash::make('password'),
            'id_grup' => 2,
            'id_staf' => 1,
            'name' => 'staf',
        ]);

        Coordinate::create([
            'nama' => 'center',
            'coordinate' => DB::raw('POINT(-2.5143220643393005, 106.11670285770147)'),
            'zoom' => 13.4,
        ]);
        Coordinate::create([
            'nama' => 'kantor_desa',
            'coordinate' => DB::raw('POINT(-2.5143220643393005, 106.11670285770147)'),
            'zoom' => 17,
        ]);
    }
}
