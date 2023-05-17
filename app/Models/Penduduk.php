<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = "penduduk";

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'nik',
        'no_kk',
        'id_hubungan_kk',               // hubungan dalam kartu keluarga (1 = kepala keluarga)
        'id_rtm',                       // nomor rumah tangga
        'id_hubungan_rtm',              // hubungan dalam rumah tangga (1 = kepala rumah tangga, 2 = anggota)
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'id_agama',
        'id_pendidikan_terakhir',       // pendidikan pada kk
        'id_pendidikan_saat_ini',       // pendidikan yang sedang dijalani saat ini
        'id_pekerjaan',
        'id_status_perkawinan',
        'id_kewarganegaraan',
        'nik_ayah',
        'nik_ibu',
        'foto',
        'id_golongan_darah',
        'penduduk_tetap',               // apakah kependudukan bersifat tetap atau tidak
        'alamat',
        'telepon',
        'id_status_asuransi',
        'id_status_dasar',
        'id_kesehatan',
        'ket',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
         'penduduk_tetap' => 'boolean'
    ];
}
