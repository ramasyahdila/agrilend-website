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
        Schema::create('data_desa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_desa')->autoIncrement();
            $table->string('desa')->nullable(false);
            $table->unsignedBigInteger('id_kota')->nullable(false);

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
        Schema::dropIfExists('data_desa');
        
    }
};
