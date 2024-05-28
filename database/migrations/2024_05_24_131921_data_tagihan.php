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
        Schema::create('data_tagihan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tagihan')->autoIncrement();
            $table->unsignedBigInteger('id_pengajuan')->nullable(false);
            $table->unsignedBigInteger('id_status_tagihan')->nullable(false);

            $table->foreign('id_pengajuan')->on('data_pengajuan_modal')->references('id_pengajuan');
            $table->foreign('id_status_tagihan')->on('data_status_tagihan')->references('id_status_tagihan');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_tagihan');
        
    }
};
