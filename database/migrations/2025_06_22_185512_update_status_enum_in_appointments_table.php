<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Drop old status column
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Add new status enum + ispaid column
        Schema::table('appointments', function (Blueprint $table) {
            $table->enum('status', [
                'pending',
                'approved',
                'cancelled',
                'rescheduled',
                'completed',
                'no_show',
                'in_progress',
                'checked_in',
                'rejected'
            ])->default('pending');

            // ✅ New ispaid column
            $table->boolean('ispaid')->default(0)->after('status');
        });
    }

    public function down(): void
    {
        // Drop both status & ispaid
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['status', 'ispaid']);
        });

        // Re-add original status enum
        Schema::table('appointments', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'cancelled'])->default('pending');
        });
    }
};
