<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ArtikelView extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id_artikel',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
         
    ];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class);
    }
}
