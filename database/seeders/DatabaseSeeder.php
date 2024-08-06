<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\Ruangan;
use App\Models\Kategori;
use App\Models\Pengadaan;
use App\Models\Satuan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Admin User',
            'email'     => 'admin@example.com',
            'password'  => bcrypt('password'),
            'Roles'     => 'admin'
        ]);

        Gedung::create([
            'id_gedungs'   => 'G01',
            'nama_gedung'  => 'Gedung A',
            'deskripsi'    => 'Deskripsi Gedung A',
            'user_id'      => 1
        ]);
        
        Lantai::create([
            'id_lantais'   => 'L01',
            'nama_lantai'  => 'Lantai 1',
            'deskripsi'    => 'Deskripsi Lantai 1',
            'gedung_id'    => 1,
            'user_id'      => 1
        ]);
        
        Ruangan::create([
            'id_ruangans'  => 'R01',
            'nama_ruangan' => 'Ruangan 101',
            'deskripsi'    => 'Deskripsi Ruangan 101',
            'lantai_id'    => 1,
            'user_id'      => 1
        ]);
        
        Kategori::create([
            'id_kategoris' => 'K01',
            'nama'         => 'Elektronik',
            'deskripsi'    => 'Deskripsi dari kategori elektronik',
            'user_id'      => 1
        ]);
        
        Pengadaan::create([
            'id_pengadaans' => 'P01',
            'nama_pengadaan'=> 'Pengadaan Barang A',
            'deskripsi'     => 'Deskripsi pengadaan barang A',
            'quantity'      => 10,
            'tanggal_pengajuan' => now(),
            'user_id'       => 1,
            'gedung_id'     => 1,
            'lantai_id'     => 1,
            'ruangan_id'    => 1
        ]);
        
        Satuan::create([
            'nama'      => 'Unit',
            'deskripsi' => 'Deskripsi dari satuan unit',
            'user_id'   => 1
        ]);
    }
}