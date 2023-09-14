<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    use HasFactory;

    protected $table = 'arsip_surat';

     /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'no_surat',
        'id_staf',
        'id_klasifikasi_surat',
        'keterangan',
        'filename',
        'json',
        'tanggal_surat',
        // 'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_surat' => 'date'
    ];

    /**
     * Get the staf associated with surat.
     */
    public function staf()
    {
        return $this->belongsTo(Staf::class, 'id_staf');
    }

    /**
     * Get the surat associated with surat.
     */
    public function surat()
    {
        return $this->belongsTo(Surat::class, 'id_klasifikasi_surat');
    }
}
