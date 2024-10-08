<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\Ruangan;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Subkategori;
use App\Models\Subdivisi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Admin',
            'email'     => 'admin@example.com',
            'password'  => bcrypt('password'),
            'roles'     => 'admin'
        ]);

        User::create([
            'name'      => 'Unit',
            'email'     => 'unit@example.com',
            'password'  => bcrypt('password'),
            'roles'     => 'unit'
        ]);

        User::create([
            'name'      => 'Yayasan',
            'email'     => 'yayasan@example.com',
            'password'  => bcrypt('password'),
            'roles'     => 'yayasan'
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
            'id_kategoris' => 'A',
            'nama'         => 'Perabot',
            'deskripsi'    => 'Deskripsi dari kategori perabot',
            'user_id'      => 1
        ]);
        
        
        Subkategori::create([
            'nama'      => 'Kursi',
            'deskripsi' => 'Deskripsi dari subkategori A',
            'kategori_id' => 1 // Ensure this is a valid kategori_id
        ]);
        
        Subdivisi::create([
            'id_subdivisi' => '01',
            'nama'         => 'Berlengan',
            'deskripsi'    => 'Deskripsi dari subdivisi A',
            'subkategori_id' => 1 // Ensure this is a valid subkategori_id
        ]);

        Satuan::create([
            'id_satuan'    => '01',
            'nama'         => 'Unit',
            'deskripsi'    => 'Deskripsi dari satuan unit',
            'subdivisi_id' => 1, // Ensure this is a valid subdivisi_id
            'user_id'      => 1 // Ensure this is a valid user_id
        ]);
    }
}