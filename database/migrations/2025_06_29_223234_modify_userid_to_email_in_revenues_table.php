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
        Schema::table('revenues', function (Blueprint $table) {
            $table->dropColumn('userid'); // pehle hatao
            $table->string('email')->nullable(); // fir email add karo
        });
    }

    public function down(): void
    {
        Schema::table('revenues', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->integer('userid')->nullable(); // rollback ke liye wapas userid
        });
    }

};
