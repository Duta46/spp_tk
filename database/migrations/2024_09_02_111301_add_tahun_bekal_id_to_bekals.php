<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTahunBekalIdToBekals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bekals', function (Blueprint $table) {
            $table->bigInteger('id_tahun_bekal')->unsigned()->nullable();
            $table->foreign('id_tahun_bekal')->references('id')->on('tahun_bekals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bekals', function (Blueprint $table) {
            //
        });
    }
}
