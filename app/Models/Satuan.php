<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = static::latest()->first();
            $model->id_satuan = str_pad(($latest ? $latest->id + 1 : 1), 2, '0', STR_PAD_LEFT);
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
}