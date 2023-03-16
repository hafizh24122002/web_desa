<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeraturanDesa extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'jenis_peraturan',
        'tanggal_ditetapkan',
        'uraian_singkat',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_ditetapkan' => 'date'
    ];
}
