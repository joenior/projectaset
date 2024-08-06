<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $fillable = ['id_gedungs', 'nama_gedung', 'deskripsi', 'user_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = static::latest()->first();
            $model->id_gedungs = 'G' . str_pad(($latest ? $latest->id + 1 : 1), 2, '0', STR_PAD_LEFT);
        });
    }

    public function lantais()
    {
        return $this->hasMany(Lantai::class);
    }
}