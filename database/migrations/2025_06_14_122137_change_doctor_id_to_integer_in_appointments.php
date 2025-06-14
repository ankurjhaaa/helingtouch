<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Step 1: Drop constraint only if it exists
        DB::statement('ALTER TABLE appointments DROP FOREIGN KEY IF EXISTS appointments_doctor_id_foreign');

        // Step 2: Change column to simple integer
        Schema::table('appointments', function (Blueprint $table) {
            $table->integer('doctor_id')->change(); // Add ->nullable() if you want
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->change();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }
};
