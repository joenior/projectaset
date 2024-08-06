<?php

namespace App\Models;

use App\Models\User;
use App\Models\Satuan;
use App\Models\Kategori;
use App\Models\Pengadaan;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['kode_barang', 'gambar', 'nama', 'deskripsi', 'tanggal', 'harga', 'user_id', 'kategori_id', 'satuan_id', 'pengadaan_id', 'gedung_id', 'lantai_id', 'ruangan_id', 'status'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $gedung = Gedung::find($model->gedung_id);
            $lantai = Lantai::find($model->lantai_id);
            $ruangan = Ruangan::find($model->ruangan_id);
            $kategori = Kategori::find($model->kategori_id);
            $pengadaan = Pengadaan::latest()->first();

            // Generate unique serial number
            $serial = str_pad(Barang::max('id') + 1, 4, '0', STR_PAD_LEFT);

            $model->kode_barang = $gedung->id_gedungs . '.B' . str_pad(($model->id + 1), 2, '0', STR_PAD_LEFT) . '.' . $kategori->id_kategoris . '.' . $pengadaan->id_pengadaans . '.' . $serial;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class)->withDefault([
            'nama' => 'Tanpa Kategori'
        ]);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class)->withDefault([
            'nama' => 'Tanpa Satuan'
        ]);
    }

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class)->withDefault([
            'id_pengadaans' => 'Tanpa Pengadaan'
        ]);
    }

    public function gedung()
    {
        return $this->belongsTo(Gedung::class)->withDefault([
            'nama_gedung' => 'Tanpa Gedung'
        ]);
    }

    public function lantai()
    {
        return $this->belongsTo(Lantai::class)->withDefault([
            'nama_lantai' => 'Tanpa Lantai'
        ]);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class)->withDefault([
            'nama_ruangan' => 'Tanpa Ruangan'
        ]);
    }
}