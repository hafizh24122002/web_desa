<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanTerakhir extends Model
{
    use HasFactory;

    protected $table = "pendidikan_terakhir";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'nama'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
         
    ];

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'id_pendidikan_terakhir');
    }
}
