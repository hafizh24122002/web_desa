<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendudukStatus extends Model
{
    use HasFactory;

    protected $table = "penduduk_status";
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
}
