<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Step 1: Drop foreign key constraint
            $table->dropForeign(['doctor_id']);

            // Step 2: Change to normal integer (with or without nullable)
            $table->integer('doctor_id')->change(); // Add ->nullable() if needed
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Rollback: Convert back to unsignedBigInteger and add foreign key again
            $table->unsignedBigInteger('doctor_id')->change();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }
};

