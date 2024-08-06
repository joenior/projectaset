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
                $table->foreignId('gedung_id')->nullable()->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('lantais', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
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
                $table->dropForeign(['gedung_id']);
                $table->dropColumn('gedung_id');
            }
            if (Schema::hasColumn('lantais', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });

        // Drop the table if it exists
        Schema::dropIfExists('lantais');
    }
};