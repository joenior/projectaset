<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = ['id_ruangans', 'nama_ruangan', 'deskripsi', 'lantai_id', 'user_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = static::latest()->first();
            $model->id_ruangans = 'R' . str_pad(($latest ? $latest->id + 1 : 1), 2, '0', STR_PAD_LEFT);
        });
    }

    public function lantai()
    {
        return $this->belongsTo(Lantai::class);
    }
}