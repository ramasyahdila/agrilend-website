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
        Schema::create('data_pengajuan_modal', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pengajuan')->autoIncrement();
            $table->unsignedBigInteger('id_petani')->nullable(false);
            $table->unsignedBigInteger('id_status_pengajuan')->nullable(false);
            $table->integer('jml_pinjam')->nullable(false);
            $table->integer('bunga')->nullable(false);
            $table->integer('jml_diterima')->nullable(false);
            $table->timestamp('tgl_pinjam')->nullable(false)->useCurrent();
            $table->timestamp('tgl_kembali')->nullable(false)->useCurrent();

            $table->foreign('id_petani')->on('data_akun_petani')->references('id_petani');
            $table->foreign('id_status_pengajuan')->on('data_status_pengajuan_modal')->references('id_status_pengajuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_pengajuan_modal');
        
    }
};