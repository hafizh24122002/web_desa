<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelperRt extends Model
{
    use HasFactory;

    protected $table = "helper_rt";

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'nik_kepala'
    ];

    public function wilayahRt()
    {
        return $this->hasOne(HelperRt::class, 'id_helper_rt');
    }

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'id_helper_rt');
    }
}
