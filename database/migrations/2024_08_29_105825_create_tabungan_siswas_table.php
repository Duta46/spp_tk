<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabunganSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabungan_siswas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_petugas')->unsigned();
            $table->foreign('id_petugas')->references('id')->on('users');
            $table->bigInteger('id_siswa')->unsigned();
            $table->foreign('id_siswa')->references('id')->on('siswa')->onDelete('cascade');
            $table->integer('saldo');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabungan_siswas');
    }
}
