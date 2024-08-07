<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('gedung_id')->references('id')->on('gedungs')->onDelete('cascade');
            $table->foreign('lantai_id')->references('id')->on('lantais')->onDelete('cascade');
        });

        Schema::table('gedungs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('lantais', function (Blueprint $table) {
            $table->foreign('gedung_id')->references('id')->on('gedungs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['gedung_id']);
            $table->dropForeign(['lantai_id']);
        });

        Schema::table('gedungs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('lantais', function (Blueprint $table) {
            $table->dropForeign(['gedung_id']);
            $table->dropForeign(['user_id']);
        });
    }
}