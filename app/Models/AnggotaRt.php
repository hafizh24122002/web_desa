<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaRt extends Model
{
    use HasFactory;

    protected $table = 'anggota_rt';

    protected $guarded = [
        
    ];

    public function rt()
    {
        return $this->belongsTo(Rt::class, 'id_no_rt', 'id');
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'nik', 'nik');
    }

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'no_kk', 'no_kk');
    }
}

