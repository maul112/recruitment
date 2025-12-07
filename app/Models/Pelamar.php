<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pelamar extends Model
{
    protected $table = 'pelamars';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nik',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'pendidikan_terakhir',
        'prodi',
        'universitas',
        'cv_path',
        'ijazah_path',
        'transkrip_path',
        'pas_foto_path',
        'sertifikat_path',
        'status_verifikasi',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function lamarans()
    {
        return $this->hasMany(Lamaran::class);
    }
}
