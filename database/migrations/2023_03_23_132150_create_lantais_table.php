<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create the table if it doesn't exist
        if (!Schema::hasTable('lantais')) {
            Schema::create('lantais', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }

        // Add the additional columns and constraints
        Schema::table('lantais', function (Blueprint $table) {
            if (!Schema::hasColumn('lantais', 'id_lantais')) {
                $table->string('id_lantais')->unique()->nullable();
            }
            if (!Schema::hasColumn('lantais', 'nama_lantai')) {
                $table->string('nama_lantai')->nullable();
            }
            if (!Schema::hasColumn('lantais', 'deskripsi')) {
                $table->text('deskripsi')->nullable();
            }
            if (!Schema::hasColumn('lantais', 'gedung_id')) {
                $table->unsignedBigInteger('gedung_id')->nullable();
            }
            if (!Schema::hasColumn('lantais', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('lantais', function (Blueprint $table) {
            if (Schema::hasColumn('lantais', 'id_lantais')) {
                $table->dropColumn('id_lantais');
            }
            if (Schema::hasColumn('lantais', 'nama_lantai')) {
                $table->dropColumn('nama_lantai');
            }
            if (Schema::hasColumn('lantais', 'deskripsi')) {
                $table->dropColumn('deskripsi');
            }
            if (Schema::hasColumn('lantais', 'gedung_id')) {
                $table->dropColumn('gedung_id');
            }
            if (Schema::hasColumn('lantais', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });

        // Drop the table if it exists
        Schema::dropIfExists('lantais');
    }
};