<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SasaranPaud extends Model
{
    use HasFactory;

    protected $table = 'sasaran_paud';

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id_kia',
        'tanggal_periksa',
        'id_posyandu',
        'kategori_usia',        // usia 2 - <3 tahun bernilai 1, uisa 3 - 6 tahun bernilai 2
        'januari',
        'februari',
        'maret',
        'april',
        'mei',
        'juni',
        'juli',
        'agustus',
        'september',
        'oktober',
        'november',
        'desember',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
         'tanggal_periksa' => 'date',
    ];

    /**
     * Get the kia associated with the sasaran_paud.
     */
    public function kia()
    {
        return $this->belongsTo(Penduduk::class, 'id_anak');
    }

    /**
     * Get the posyandu associated with the sasaran_paud.
     */
    public function posyandu()
    {
        return $this->belongsTo(Penduduk::class, 'id_posyandu');
    }
}
