<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->unsignedBigInteger('doctor_id')->change();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->bigInteger('doctor_id')->change(); // original type (if not unsigned)
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }
};
