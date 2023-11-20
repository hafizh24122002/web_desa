<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rtm extends Model
{
    protected $table = "rtm";
    use HasFactory;

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id_helper_penduduk_rtm',
        'id_kelas_sosial',
        'bdt',
        'dtks',
        'tgl_daftar',
        'alamat',
        'id_dusun',
        'id_rt'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tgl_daftar' => 'datetime',
    ];

    public function helperPendudukRtm()
    {
        return $this->belongsTo(HelperPendudukRtm::class, 'id_helper_penduduk_rtm');
    }
}
