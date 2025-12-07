<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    use HasFactory;

    // Tetapkan nama tabel sesuai database
    protected $table = 'kontrak';

    protected $fillable = [
        'lamaran_id',
        'file_kontrak_path',
        'signature_path',
        'signed_at',
        'status'
    ];

    public function lamaran()
    {
        return $this->belongsTo(Lamaran::class);
    }
}
