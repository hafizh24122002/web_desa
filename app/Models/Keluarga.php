<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

    protected $table = "keluarga";

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id_helper_penduduk_keluarga',
        'id_kelas_sosial',
        'tgl_daftar',
        'tgl_cetak_kk',
        'alamat',
        'id_dusun',
        'id_rt'
    ];

    /**
     * The attributes that should be cast
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tgl_daftar' => 'datetime',
        'tgl_cetak_kk' => 'datetime',
    ];

    public function helperPendudukKeluarga()
    {
        return $this->belongsTo(HelperPendudukKeluarga::class, 'id_helper_penduduk_keluarga');
    }
}
