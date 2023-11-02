<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelperPendudukRtm extends Model
{
    use HasFactory;

    protected $table = "helper_penduduk_rtm";

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'no_rtm',
        'nik_kepala'
    ];

    public function rtm()
    {
        return $this->hasOne(Rtm::class, 'id_helper_penduduk_rtm');
    }

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'id_helper_penduduk_rtm');
    }
}
