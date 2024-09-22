<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranOutbondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_outbonds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_petugas')->unsigned();
            $table->foreign('id_petugas')->references('id')->on('users');
            $table->bigInteger('id_siswa')->unsigned();
            $table->foreign('id_siswa')->references('id')->on('siswa')->onDelete('cascade');
            $table->bigInteger('id_outbond')->unsigned();
            $table->foreign('id_outbond')->references('id')->on('outbonds');
            $table->integer('jumlah_bayar');
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
        Schema::dropIfExists('pembayaran_outbonds');
    }
}
