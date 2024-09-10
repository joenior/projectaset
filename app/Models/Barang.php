<?php

namespace App\Models;

use App\Models\User;
use App\Models\Satuan;
use App\Models\Kategori;
use App\Models\Pengadaan;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\Ruangan;
use App\Models\Subkategori;
use App\Models\Subdivisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nama', 'deskripsi', 'harga', 'tanggal', 'penyusutan', 'kode_barang', 'gambar', 'user_id', 'kategori_id', 'satuan_id', 'gedung_id', 'lantai_id', 'ruangan_id', 'subkategori_id', 'subdivisi_id', 'status', 'umur_ekonomis'
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $kategori = Kategori::find($model->kategori_id);
            $subkategori = Subkategori::find($model->subkategori_id);
            $subdivisi = Subdivisi::find($model->subdivisi_id);
            $satuan = Satuan::find($model->satuan_id);

            if (!$kategori || !$subkategori || !$subdivisi || !$satuan) {
                throw new \Exception('Kategori, Subkategori, Subdivisi, atau Satuan tidak ditemukan.');
            }

            // Generate unique serial number
            $serial = str_pad(Barang::withTrashed()->max('id') + 1, 4, '0', STR_PAD_LEFT);

            // Generate kode_barang in the format A.01.01.01.0001
            $model->kode_barang = $kategori->id_kategoris . '.' . $subkategori->id_subkategori . '.' . $subdivisi->id_subdivisi . '.' . $satuan->id_satuan . '.' . $serial;
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

    public function subkategori()
    {
        return $this->belongsTo(Subkategori::class);
    }

    public function subdivisi()
    {
        return $this->belongsTo(Subdivisi::class);
    }

    public function riwayatPemindahan()
    {
        return $this->hasMany(RiwayatPemindahan::class);
    }
}