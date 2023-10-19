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
     * Get the Penduduk that owns the LogPenduduk
     *
     * @return App\Models\BelongsTo
     */
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk');
    }

    /**
     * Get the Pindah that owns the LogPenduduk
     *
     * @return App\Models\BelongsTo
     */
    public function pindah()
    {
        return $this->belongsTo(Pindah::class, 'id_pindah');
    }

    /**
     * Get the Tamu associated with the LogPenduduk
     *
     * @return App\Models\HasOne
     */
    public function tamu()
    {
        return $this->hasOne(Tamu::class, 'id_log_penduduk_masuk');
    }
}
