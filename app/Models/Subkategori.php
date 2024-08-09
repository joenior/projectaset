<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkategori extends Model
{
    use HasFactory;

    protected $fillable = ['id_subkategori', 'nama', 'deskripsi', 'kategori_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = static::latest()->first();
            $model->id_subkategori = str_pad(($latest ? $latest->id_subkategori + 1 : 1), 2, '0', STR_PAD_LEFT);
        });
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function subdivisis()
    {
        return $this->hasMany(Subdivisi::class);
    }
}