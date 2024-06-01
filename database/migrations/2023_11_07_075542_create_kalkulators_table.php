<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kalkulators', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('komoditas');
            $table->string('varietas');
            $table->integer('jarak');
            $table->integer('luas');
            $table->date('date');

            // Foreign Key Relationship
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Use foreignId for conciseness and better type safety
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kalkulators');
    }
};
