<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Agama;
use App\Models\Artikel;
use App\Models\HubunganKK;
use App\Models\IbuHamil;
use App\Models\IdentitasDesa;
use App\Models\KelasSosial;
use App\Models\Keluarga;
use App\Models\Kesehatan;
use App\Models\Kewarganegaraan;
use App\Models\Kia;
use App\Models\Pekerjaan;
use App\Models\PendidikanSaatIni;
use App\Models\PendidikanTerakhir;
use App\Models\Penduduk;
use App\Models\Posyandu;
use App\Models\Rtm;
use App\Models\StatusPerkawinan;
use App\Models\Staf;
use App\Models\Surat;
use App\Models\User;
use App\Models\Agenda;
use App\Models\CaraKb;
use App\Models\GolonganDarah;
use App\Models\JenisKelamin;
use App\Models\PendudukStatus;

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

        JenisKelamin::create(['nama' => 'LAKI-LAKI']);
        JenisKelamin::create(['nama' => 'PEREMPUAN']);

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

        PendudukStatus::create(['nama' => 'TETAP']);
        PendudukStatus::create(['nama' => 'TIDAK TETAP']);
        
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

        StatusPerkawinan::create(['nama' => 'BELUM KAWIN']);
        StatusPerkawinan::create(['nama' => 'KAWIN']);
        StatusPerkawinan::create(['nama' => 'CERAI HIDUP']);
        StatusPerkawinan::create(['nama' => 'CERAI MATI']);

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

        // Penduduk::create([
        //     'nama' => 'HAFIZH LUTFI HIDAYAT',
        //     'nik' => '6401042412340001',
        //     'no_kk' => '6401042412340029',
        //     'id_hubungan_kk' => 1, 
        //     'jenis_kelamin' => 'L',
        //     'tempat_lahir' => 'SAMARINDA',
        //     'tanggal_lahir' => '2002-12-24',
        //     'id_agama' => 1,
        //     'id_status_perkawinan' => 1,
        //     'id_kewarganegaraan' => 1,
        //     'id_pekerjaan' => 3,
        //     'nik_ayah' => '6401042412340002',
        //     'nik_ibu' => '6401042412340003',
        //     'penduduk_tetap' => false,
        //     'telepon' => '081255598024',
        // ]);

        // Penduduk::create([
        //     'nama' => 'JEAN DOE',
        //     'nik' => '6401042412340009',
        //     'no_kk' => '6401042412340029',
        //     'id_hubungan_kk' => 3, 
        //     'nik_ayah' => '6401042412340002',
        //     'nik_ibu' => '6401042412340003',
        // ]);

        // Penduduk::create([
        //     'nama' => 'JOHN DOE',
        //     'nik' => '1903051234567891',
        //     'no_kk' => '6401042412340030',
        //     'id_hubungan_kk' => 1, 
        //     'nik_ayah' => '6401042412340002',
        //     'nik_ibu' => '6401042412340003',
        // ]);

        // Penduduk::create([
        //     'nama' => 'ANI',
        //     'nik' => '1903051234567890',
        //     'no_kk' => '6401042412340030',
        //     'id_hubungan_kk' => 3, 
        //     'jenis_kelamin' => 'P',
        //     'tempat_lahir' => 'BANGKA SELATAN',
        //     'tanggal_lahir' => '1995-04-14',
        //     'id_agama' => 1,
        //     'id_pendidikan_terakhir' => 2,
        //     'id_status_perkawinan' => 2,
        //     'id_kewarganegaraan' => 1,
        //     'id_pekerjaan' => 2,
        //     'nik_ayah' => '1903051234567891',
        //     'nik_ibu' => '1903051234567892',
        //     'penduduk_tetap' => true,
        // ]);

        // Keluarga::create([
        //     'no_kk' => '6401042443210001',
        //     'nik_kepala' => '6401042412340001',
        //     'id_kelas_sosial' => '4',
        //     'alamat' => 'JL. MERPATI NO.51 RT.03/RW.02',
        //     'tgl_dikeluarkan' => '2006-04-15',
        // ]);

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
            'kode_desa' => '123.456',
            'nama_kepala_desa' => 'Riza Umami',
            'email_desa' => 'pemdesmalik@gmail.com',
            'website' => 'malik.com',
            'nama_kecamatan' => 'Payung',
            'nama_kabupaten' => 'Bangka Selatan',
            'nama_provinsi' => 'Bangka Belitung'
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
    }
}
