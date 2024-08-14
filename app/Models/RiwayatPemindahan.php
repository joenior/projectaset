<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPemindahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'gedung_id',
        'lantai_id',
        'ruangan_id',
        'tanggal_pemindahan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }

    public function lantai()
    {
        return $this->belongsTo(Lantai::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}