<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelperDusun extends Model
{
    use HasFactory;

    protected $table = "helper_dusun";

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'nik_kepala'
    ];

    public function wilayahDusun()
    {
        return $this->hasOne(WilayahDusun::class, 'id_helper_dusun');
    }

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'id_helper_dusun');
    }
}
