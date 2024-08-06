<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pengadaan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = static::latest()->first();
            $model->id_pengadaans = 'P' . str_pad(($latest ? $latest->id + 1 : 1), 2, '0', STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Statuspengadaan()
    {
        return $this->hasMany(Statuspengadaan::class);
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