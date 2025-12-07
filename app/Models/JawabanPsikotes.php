<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanPsikotes extends Model
{
    use HasFactory;

    protected $fillable = [
        'psikotes_id', 'soal_id', 'jawaban', 'benar', 'nilai'
    ];

    public function psikotes()
    {
        return $this->belongsTo(Psikotes::class);
    }

    public function soal()
    {
        return $this->belongsTo(SoalPsikotes::class, 'soal_id');
    }
}
