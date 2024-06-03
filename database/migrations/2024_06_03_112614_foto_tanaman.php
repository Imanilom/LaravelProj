<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoTanamanTable extends Migration
{
    public function up()
    {
        Schema::create('foto_tanaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lahan_id');
            $table->string('path_foto');
            $table->timestamp('tanggal_upload')->nullable();
            $table->timestamps();

            $table->foreign('lahan_id')->references('id')->on('lahan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('foto_tanaman');
    }
}
