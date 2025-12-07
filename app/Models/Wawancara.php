<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wawancara extends Model
{
    use HasFactory;

    protected $fillable = [
        'lamaran_id', 'tipe', 'jadwal', 'lokasi', 
        'nilai', 'komentar'
    ];

    // Hubungan dengan Lamaran
    public function lamaran()
    {
        return $this->belongsTo(Lamaran::class);
    }
}
