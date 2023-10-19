<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPenduduk extends Model
{
    use HasFactory;

    protected $table = "log_penduduk";

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id_penduduk',
        'id_peristiwa',
        'meninggal_di',
        'jam_mati',
        'sebab',
        'penolong_mati',
        'no_akta_mati',
        'alamat_tujuan',
        'catatan',
        'id_pindah',
        'maksud_tujuan_kedatangan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lapor' => 'date',
        'tanggal_peristiwa' => 'date',
    ];

    /**
     * Get the penduduk that owns the LogPenduduk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk');
    }
}
