<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitToPengadaansTable extends Migration
{
    public function up()
    {
        Schema::table('pengadaans', function (Blueprint $table) {
            $table->string('unit')->after('quantity');
        });
    }

    public function down()
    {
        Schema::table('pengadaans', function (Blueprint $table) {
            $table->dropColumn('unit');
        });
    }
}