<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTahunPotabIdToPotabs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('potabs', function (Blueprint $table) {
            $table->bigInteger('id_tahun_potab')->unsigned()->nullable();
            $table->foreign('id_tahun_potab')->references('id')->on('tahun_potabs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('potabs', function (Blueprint $table) {
            //
        });
    }
}
