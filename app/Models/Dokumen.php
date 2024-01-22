<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumen';

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id_staf',
        'judul',
        'keterangan',
        'filename',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get the staf associated with staf.
     */
    public function staf()
    {
        return $this->belongsTo(Staf::class, 'id_staf');
    }

    public function views()
    {
        return $this->hasMany(DokumenDownload::class, 'id_dokumen');
    }
}
