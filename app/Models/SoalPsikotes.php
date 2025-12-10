<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalPsikotes extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe',
        'durasi',
        'pertanyaan',
        'pilihan_a',
        'bobot_a',
        'pilihan_b',
        'bobot_b',
        'pilihan_c',
        'bobot_c',
        'pilihan_d',
        'bobot_d',
        'kunci_jawaban',
        'bobot',
    ];
}
