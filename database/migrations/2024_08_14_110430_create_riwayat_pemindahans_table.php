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
        Schema::create('riwayat_pemindahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained()->onDelete('cascade');
            $table->foreignId('gedung_id')->constrained()->onDelete('cascade');
            $table->foreignId('lantai_id')->constrained()->onDelete('cascade');
            $table->foreignId('ruangan_id')->constrained()->onDelete('cascade');
            $table->foreignId('previous_gedung_id')->nullable()->constrained('gedungs')->onDelete('cascade');
            $table->foreignId('previous_lantai_id')->nullable()->constrained('lantais')->onDelete('cascade');
            $table->foreignId('previous_ruangan_id')->nullable()->constrained('ruangans')->onDelete('cascade');
            $table->timestamp('tanggal_pemindahan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pemindahans');
    }
};