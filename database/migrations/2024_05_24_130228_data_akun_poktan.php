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
        Schema::create('data_akun_poktan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_poktan')->autoIncrement();
            $table->string('username_poktan')->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('nama_poktan')->nullable(false);
            $table->string('alamat_poktan')->nullable(false);
            $table->unsignedBigInteger('id_desa')->nullable(false);
            $table->unsignedBigInteger('id_pemerintah')->nullable(false);
            $table->string('no_tlp')->nullable(false);

            $table->foreign('id_desa')->on('data_desa')->references('id_desa');
            $table->foreign('id_pemerintah')->on('data_akun_pemerintah')->references('id_pemerintah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_akun_poktan');
        
    }
};
