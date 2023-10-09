<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelperPendudukKeluarga extends Model
{
    use HasFactory;

    protected $table = "helper_penduduk_keluarga";

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'no_kk',
        'nik_kepala'
    ];

    public function keluarga()
    {
        return $this->hasOne(Keluarga::class, 'id_helper_penduduk_keluarga');
    }
}
