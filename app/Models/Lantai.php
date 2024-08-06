<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lantai extends Model
{
    use HasFactory;

    protected $fillable = ['id_lantais', 'nama_lantai', 'deskripsi', 'gedung_id', 'user_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = static::latest()->first();
            $model->id_lantais = 'L' . str_pad(($latest ? $latest->id + 1 : 1), 2, '0', STR_PAD_LEFT);
        });
    }

    public function ruangan()
    {
        return $this->hasMany(Ruangan::class);
    }

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }
}