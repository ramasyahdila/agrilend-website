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
        Schema::create('data_akun_pemerintah', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pemerintah')->autoIncrement();
            $table->string('username_pemerintah')->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('nama_pemerintah')->nullable(false);
            $table->unsignedBigInteger('id_kota')->nullable(false);
            $table->string('no_tlp',12)->nullable(false);

            $table->foreign('id_kota')->on('data_kota')->references('id_kota');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_akun_pemerintah');
        
    }
};
