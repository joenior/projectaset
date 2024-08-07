<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdivisi extends Model
{
    use HasFactory;

    protected $fillable = ['id_subdivisi', 'nama', 'deskripsi'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = static::latest()->first();
            $model->id_subdivisi = str_pad(($latest ? $latest->id + 1 : 1), 2, '0', STR_PAD_LEFT);
        });
    }
}