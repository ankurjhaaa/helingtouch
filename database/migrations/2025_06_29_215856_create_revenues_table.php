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
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->integer('userid')->nullable(); // user , doctor ya reception ka od 
            $table->string('status'); // seccess or cancke
            $table->string('paymenttype'); // debit or credit
            $table->string('paymentid')->nullable(); //razorpay ka id 
            $table->string('paymentmode'); // online ya cash
            $table->string('description')->nullable(); // kaaran 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenues');
    }
};
