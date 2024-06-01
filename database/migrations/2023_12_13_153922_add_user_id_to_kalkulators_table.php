<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kalkulators', function (Blueprint $table) {
            // Check if the column doesn't exist before adding
            if (!Schema::hasColumn('kalkulators', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kalkulators', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop the foreign key constraint first
            $table->dropColumn('user_id');   // Then drop the column
        });
    }
};
