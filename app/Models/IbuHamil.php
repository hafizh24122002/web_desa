<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbuHamil extends Model
{
    use HasFactory;

    protected $table = 'ibu_hamil';

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id_posyandu',
        'id_kia',
        'tanggal_periksa',
        'status_kehamilan',
        'usia_kehamilan',
        'tanggal_melahirkan',
        'pemeriksaan_kehamilan',
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
        'tanggal_periksa' => 'date',
        'tanggal_melahirkan' => 'date',
        'pemeriksaan_kehamilan' => 'boolean',
        'konsumsi_pil_fe' => 'boolean',
        'pemeriksaan_nifas' => 'boolean',
        'konseling_gizi' => 'boolean',
        'kunjungan_rumah' => 'boolean',
        'akses_air_bersih' => 'boolean',
        'kepemilikan_jamban' => 'boolean',
        'jaminan_kesehatan' => 'boolean',
    ];

    /**
     * Get the posyandu associated with the ibuHamil.
     */
    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'id_posyandu');
    }

    /**
     * Get the kia associated with the ibuHamil.
     */
    public function kia()
    {
        return $this->belongsTo(Kia::class, 'id_kia');
    }
}
