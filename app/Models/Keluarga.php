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
        'no_kk',
        'nik_kepala',
        'id_kelas_sosial',
        'alamat',
        'tgl_dikeluarkan',
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
}
