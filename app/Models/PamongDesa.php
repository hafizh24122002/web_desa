<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PamongDesa extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'nipd',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pangkat_golongan',
        'jabatan',
        'pendidikan_terakhir',
        'no_sk_pengangkatan',
        'no_sk_pemberhentian',
        'tanggal_sk_pemberhentian',
        'masa_jabatan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_sk_pemberhentian' => 'date',
    ];
}
