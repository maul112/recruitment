<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psikotes extends Model
{
    use HasFactory;

    protected $fillable = [
        'lamaran_id', 'mulai_at', 'selesai_at', 
        'skor_kognitif', 'profil_kepribadian', 
        'rekomendasi', 'status'
    ];

    public function lamaran()
    {
        return $this->belongsTo(Lamaran::class);
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanPsikotes::class);
    }

    public function soal()
    {
        return $this->belongsToMany(SoalPsikotes::class, 'jawaban_psikotes', 'psikotes_id', 'soal_id');
    }
}
