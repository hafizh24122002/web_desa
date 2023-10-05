<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WilayahDusun extends Model
{
    use HasFactory;

    protected $table = 'wilayah_dusun';

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'id_kepala_dusun',
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
        return $this->hasOne(Staf::class, 'id_staf');
    }
}
