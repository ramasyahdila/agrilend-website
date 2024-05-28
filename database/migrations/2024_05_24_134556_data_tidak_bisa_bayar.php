<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_tidak_bisa_bayar', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tidak_bisa_bayar')->autoIncrement();
            $table->timestamp('tgl_kembali_bunga')->nullable();
            $table->integer('bunga')->nullable(false);
            $table->unsignedBigInteger('id_tagihan')->nullable(false);
            $table->unsignedBigInteger('id_metode_bayar')->nullable(false);

            $table->foreign('id_metode_bayar')->on('data_metode_bayar')->references('id_metode_bayar');
            $table->foreign('id_tagihan')->on('data_tagihan')->references('id_tagihan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_tidak_bisa_bayar');
        
    }
};
