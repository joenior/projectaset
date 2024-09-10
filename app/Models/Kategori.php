<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kategori extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $fillable = ['id_kategoris', 'nama', 'deskripsi', 'user_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = static::latest()->first();
            $nextId = $latest ? $latest->id + 1 : 1;
            $model->id_kategoris = chr(64 + $nextId); // Convert number to alphabet (1 -> A, 2 -> B, etc.)
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }

    public function subkategoris()
    {
        return $this->hasMany(Subkategori::class, 'kategori_id');
    }
}