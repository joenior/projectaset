<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('ruangans')) {
            Schema::create('ruangans', function (Blueprint $table) {
                $table->id();
                $table->string('id_ruangans')->unique();
                $table->string('nama_ruangan');
                $table->text('deskripsi');
                $table->foreignId('lantai_id')->constrained()->onDelete('cascade');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ruangans');
    }
};