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
        Schema::create('data_akun_petani', function (Blueprint $table) {
            $table->unsignedBigInteger('id_petani')->autoIncrement();
            $table->string('username_petani')->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('nik')->nullable(false);
            $table->string('nama_petani')->nullable(false);
            $table->date('ttl_petani')->nullable(false);
            $table->string('pekerjaan')->nullable(false);
            $table->string('alamat_petani')->nullable(false);
            $table->unsignedBigInteger('id_desa')->nullable(false);
            $table->string('no_tlp')->nullable(false);
            $table->unsignedBigInteger('id_poktan')->nullable(false);

            $table->foreign('id_poktan')->on('data_akun_poktan')->references('id_poktan');
            $table->foreign('id_desa')->on('data_desa')->references('id_desa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_akun_petani');
        
    }
};