<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $table = "visitor";

    protected $fillable = [
        'ip_address',
        'user_agent',
        'visited_at',
    ];

    // Define the relationship with the Article model
    public function article()
    {
        return $this->belongsTo(Artikel::class);
    }
}
