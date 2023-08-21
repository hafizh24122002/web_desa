<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KiaAnak extends Model
{
    use HasFactory;

    protected $table = 'kia_anak';

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id_posyandu',
        'id_kia',
        'tanggal_periksa',
        'status_gizi_anak',
        'umur',
        'hasil_status_tikar',
        'imunisasi_campak',
        'berat_badan',
        'tinggi_badan',
        'imunisasi_dasar',
        'pengukuran_berat_badan',
        'pengukuran_tinggi_badan',
        'konseling_gizi_ayah',
        'konseling_gizi_ibu',
        'kunjungan_rumah',
        'akses_air_bersih',
        'kepemilikan_jamban',
        'akta_lahir',
        'jaminan_kesehatan',
        'pengasuhan_paud',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_periksa' => 'date',
        'imunisasi_dasar' => 'boolean',
        'pengukuran_berat_badan' => 'boolean',
        'pengukuran_tinggi_badan' => 'boolean',
        'konseling_gizi_ayah' => 'boolean',
        'konseling_gizi_ibu' => 'boolean',
        'kunjungan_rumah' => 'boolean',
        'akses_air_bersih' => 'boolean',
        'kepemilikan_jamban' => 'boolean',
        'akta_lahir' => 'boolean',
        'jaminan_kesehatan' => 'boolean',
        'pengasuhan_paud' => 'boolean',
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
