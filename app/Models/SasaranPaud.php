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
        'kategori_usia',        // usia 2 - <3 tahun bernilai 0, uisa 3 - 6 tahun bernilai 1
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
         'kategori_usia' => 'boolean',
         'januari' => 'boolean',
         'februari' => 'boolean',
         'maret' => 'boolean',
         'april' => 'boolean',
         'mei' => 'boolean',
         'juni' => 'boolean',
         'juli' => 'boolean',
         'agustus' => 'boolean',
         'september' => 'boolean',
         'oktober' => 'boolean',
         'november' => 'boolean',
         'desember' => 'boolean',
    ];

    /**
     * Get the kia associated with the sasaran_paud.
     */
    public function kia()
    {
        return $this->belongsTo(Penduduk::class, 'id_anak');
    }
}
