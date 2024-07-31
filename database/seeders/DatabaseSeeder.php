<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\Satuan;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name'      => 'Admin User',
            'email'     => 'admin@example.com',
            'password'  => bcrypt('password'),
            'Roles'     => 'admin'
        ]);

        Kategori::create([
            'nama'      => 'Elektronik',
            'deskripsi' => 'Deskripsi dari kategori elektronik',
            'user_id'   => 1
        ]);

        Lokasi::create([
            'nama_lokasi'   => 'Unit Usaha Perdagangan',
            'deskripsi'     => 'Unit Usaha Perdagangan',
            'user_id'       => 1
        ]);
        
        Satuan::create([
            'nama'      => 'Unit',
            'deskripsi' => 'Deskripsi dari satuan unit',
            'user_id'   => 1
        ]);
    }
}