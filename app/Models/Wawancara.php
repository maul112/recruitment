<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wawancara extends Model
{
    use HasFactory;

    protected $fillable = [
        'lamaran_id', 'tipe', 'jadwal', 'lokasi', 
        'nilai_komunikasi',
        'nilai_pengetahuan_teknis',
        'nilai_pengalaman_kerja',
        'nilai_problem_solving',
        'nilai_sikap_etika_kerja',
        'nilai_kepercayaan_diri',
        'nilai_adaptabilitas',
        'nilai_komentar',
        'nilai', 'komentar'
    ];

    public $timestamps = false;

    protected $casts = [
        'jadwal' => 'datetime',
        // Tambahkan casting untuk created_at, updated_at jika ada
    ];

    // Hubungan dengan Lamaran
    public function lamaran()
    {
        return $this->belongsTo(Lamaran::class);
    }
}
