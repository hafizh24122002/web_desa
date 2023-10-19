<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    protected $table = "tamu";
    public $timestamps = false;


    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id_log_penduduk_masuk',
        'id_log_penduduk_pergi',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        
    ];

    /**
     * Get the LogPenduduk that owns the Tamu
     *
     * @return App\Models\BelongsTo
     */
    public function logPenduduk()
    {
        return $this->belongsTo(logPenduduk::class, 'id_log_penduduk_pergi');
    }
}
