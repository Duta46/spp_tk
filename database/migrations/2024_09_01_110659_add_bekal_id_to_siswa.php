<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBekalIdToSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->bigInteger('id_bekal')->unsigned();
            $table->foreign('id_bekal')->references('id')->on('bekals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            //
        });
    }
}
