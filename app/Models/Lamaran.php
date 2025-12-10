<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'lowongan_id',
        'pelamar_id',
        'tanggal_daftar',
        'status',
        'catatan_admin',
        'nilai_administrasi',
        'nilai_psikotes',
        'nilai_wawancara',
        'total_nilai'
    ];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class);
    }

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'lowongan_id');
    }

    public function wawancara()
    {
        return $this->hasOne(Wawancara::class, 'lamaran_id'); 
    }
}
