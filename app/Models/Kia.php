<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kia extends Model
{
    use HasFactory;

    protected $table = 'kia';

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'no_kia',
        'id_anak',
        'id_ibu',
        'perkiraan_lahir',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
         'perkiraan_lahir' => 'date'
    ];

    /**
     * Get the anak associated with the kia.
     */
    public function anak()
    {
        return $this->belongsTo(Penduduk::class, 'id_anak');
    }

    /**
     * Get the ibu associated with the kia.
     */
    public function ibu()
    {
        return $this->belongsTo(Penduduk::class, 'id_ibu');
    }
}
