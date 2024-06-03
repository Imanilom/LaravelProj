<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lahan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user'); // Kolom untuk menyimpan ID pengguna
            $table->string('nama_lahan')->nullable(); // Nama lahan (opsional)
            $table->string('jenis_tanaman')->nullable(); // Jenis tanaman (opsional)
            $table->decimal('luas_lahan', 10, 2)->nullable(); // Luas lahan (opsional)
            $table->string('lokasi')->nullable(); // Lokasi lahan (opsional)
            $table->text('catatan')->nullable(); // Catatan tambahan (opsional)
            $table->timestamps(); // Created_at dan updated_at
        
            // Foreign key untuk menghubungkan dengan tabel users
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lahans');
    }
};
