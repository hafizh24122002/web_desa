<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembangunan extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_kegiatan',
        'id_sumber_dana',
        'anggaran',
        'volume',
        'tahun_anggaran',
        'pelaksana_kegiatan',
        'waktu',
        'lokasi',
        'sumber_biaya_pemerintah',
        'sumber_biaya_provinsi',
        'sumber_biaya_kab_kota',
        'sumber_biaya_swadaya',
        'sumber_biaya_jumlah',
        'manfaat',
        'sifat_proyek',
        'gambar',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
         
    ];
}
