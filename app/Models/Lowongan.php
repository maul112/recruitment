<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongans';

    protected $fillable = [
        'posisi',
        'deskripsi',
        'kualifikasi_pendidikan',
        'tanggal_buka',
        'tanggal_tutup',
        'dokumen_wajib',
        'kuota',
        'status',
        'created_by'
    ];
}
