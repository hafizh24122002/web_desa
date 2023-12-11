<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = "artikel";

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id_staf',
        'judul',
        'isi',
        'id_cover',
        'is_active'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
         
    ];

    public function staf()
    {
        return $this->belongsTo(Staf::class, 'id_staf');
    }

    public function views()
    {
        return $this->hasMany(ArtikelView::class, 'id_artikel');
    }

    public function cover()
    {
        return $this->belongsTo(Image::class, 'id_cover');
    }
}
