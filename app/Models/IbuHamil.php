<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbuHamil extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id_ibu_hamil',
        'id_posyandu',
        'id_kia',
        'status_kehamilan',
        'usia_kehamilan',
        'tanggal_melahirkan',
        'pemeriksaan_kelahiran',
        'konsumsi_pil_fe',
        'butir_pil_fe',
        'pemeriksaan_nifas',
        'konseling_gizi',
        'kunjungan_rumah',
        'akses_air_bersih',
        'kepemilikan_jamban',
        'jaminan_kesehatan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'pemeriksaan_kelahiran' => 'boolean',
        'konsumsi_pil_fe' => 'boolean',
        'pemeriksaan_nifas' => 'boolean',
        'konseling_gizi' => 'boolean',
        'kunjungan_rumah' => 'boolean',
        'akses_air_bersih' => 'boolean',
        'kepemilikan_jamban' => 'boolean',
        'jaminan_kesehatan' => 'boolean',
    ];
}
