<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dusun extends Model
{
    use HasFactory;

    protected $table = 'dusun';

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'id_kepala_dusun',
        'no_telp_dusun',
        'jumlah_rt,'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

    /**
     * Get the staf associated with surat.
     */
    public function staf()
    {
        return $this->belongsTo(Staf::class, 'id_staf');
    }
}
