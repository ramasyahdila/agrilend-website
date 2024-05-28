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
        Schema::create('data_laporan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_laporan')->autoIncrement();
            $table->unsignedBigInteger('id_poktan')->nullable(false);
            $table->string('laporan')->nullable(false);
            $table->unsignedBigInteger('id_status_laporan')->nullable(false);

            $table->foreign('id_poktan')->on('data_akun_poktan')->references('id_poktan');
            $table->foreign('id_status_laporan')->on('data_status_laporan')->references('id_status_laporan');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_laporan');
        
    }
};
