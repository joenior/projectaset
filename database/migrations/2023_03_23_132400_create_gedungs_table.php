<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('gedungs')) {
            Schema::create('gedungs', function (Blueprint $table) {
                $table->id();
                $table->string('id_gedungs')->unique();
                $table->string('nama_gedung');
                $table->text('deskripsi');
                $table->unsignedBigInteger('user_id')->nullable(); // Make it nullable for now
                $table->timestamps();
            });
        }
    }
    public function down(): void
    {
        Schema::dropIfExists('gedungs');
    }
};