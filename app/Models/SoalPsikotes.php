<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalPsikotes extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe', 'pertanyaan', 'pilihan_a', 'pilihan_b', 
        'pilihan_c', 'pilihan_d', 'kunci_jawaban', 'bobot'
    ];
}
