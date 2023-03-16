<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuAgenda extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id_surat',
        'tipe',         // apakah berupa surat keluar atau surat masuk
        'nama',         // nama pamong yang mengirim/menerima surat
        'isi_singkat',
        'tanggal_surat',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_surat' => 'date',
    ];
}
