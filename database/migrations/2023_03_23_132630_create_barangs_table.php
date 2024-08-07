<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->decimal('harga', 10, 2);
            $table->foreignId('kategori_id')->constrained();
            $table->foreignId('gedung_id')->constrained();
            $table->foreignId('lantai_id')->constrained();
            $table->foreignId('ruangan_id')->constrained();
            $table->foreignId('satuan_id')->constrained();
            $table->foreignId('subkategori_id')->constrained();
            $table->foreignId('subdivisi_id')->constrained();
            $table->string('kode_barang')->unique();
            $table->timestamp('tanggal');
            $table->foreignId('user_id')->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};