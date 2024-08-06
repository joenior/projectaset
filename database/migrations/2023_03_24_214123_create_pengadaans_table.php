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
        if (!Schema::hasTable('pengadaans')) {
            Schema::create('pengadaans', function (Blueprint $table) {
                $table->id();
                $table->string('id_pengadaans')->unique();
                $table->string('nama_pengadaan');
                $table->text('deskripsi');
                $table->integer('quantity');
                $table->timestamp('tanggal_pengajuan');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('gedung_id')->constrained()->onDelete('cascade');
                $table->foreignId('lantai_id')->constrained()->onDelete('cascade');
                $table->foreignId('ruangan_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengadaans');
    }
};